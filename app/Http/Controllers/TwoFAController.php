<?php

namespace App\Http\Controllers;

use App\Models\UserCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TwoFAController extends Controller
{
        /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view('2fa');
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function store(Request $request)
    {
        $request->validate([
            'code'=>'required',
        ]);
  
        $find = UserCode::where('user_id', auth()->user()->id)
                        ->where('code', $request->code)
                        ->where('updated_at', '>=', now()->subMinutes(2))
                        ->first();
  
                        if (!is_null($find)) {
                            Session::put('user_2fa', auth()->user()->id); // Set the user's ID in the session
                            $user = auth()->user();
                            if ($user->status === 'no') {
                                // Registration is incomplete, redirect to the respective complete registration page
                                if ($user->type === 'admin') {
                                    return redirect()->route('admin.dashboard');
                                } elseif ($user->type === 'donor') {
                                    return redirect()->route('donor.dashboard');
                                } elseif ($user->type === 'volunteer') {
                                    return redirect()->route('volunteer.dashboard');
                                } elseif ($user->type === 'orphanage') {
                                    return redirect()->route('orphanage.dashboard');
                                }
                            } else {
                                // User has completed registration, redirect to the dashboard
                                if ($user->type === 'admin') {
                                    return redirect()->route('admin.home');
                                } elseif ($user->type === 'donor') {
                                    return redirect()->route('donor.home');
                                } elseif ($user->type === 'orphanage') {
                                    return redirect()->route('orphanage.home');
                                } else {
                                    return redirect()->route('home');
                                }
                            }
                        }
  
        return back()->with('error', 'You entered wrong code.');
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function resend()
    {
        auth()->user()->generateCode();
  
        return back()->with('message', 'We sent you code on your email.');
    }
}
