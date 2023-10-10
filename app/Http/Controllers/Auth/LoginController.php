<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)

    {   

        $input = $request->all();

     

        $this->validate($request, [

            'email' => 'required|email',

            'password' => 'required',

        ]);

     
        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
        {
            $user = Auth::user();

            if ($user->status === 'no') {
                // Registration is incomplete, redirect to the respective complete registration page
                if ($user->type === 'admin') {
                    return redirect()->route('admin.dashboard');
                } else if ($user->type === 'donor') {
                    return redirect()->route('donor.dashboard');
                }
                else if ($user->type === 'volunteer') {
                    return redirect()->route('volunteer.dashboard');
                }
                else if ($user->type === 'orphanage') {
                    return redirect()->route('orphanage.dashboard');
                }
            } else {

            if (auth()->user()->type == 'admin') {
                return redirect()->route('admin.home');
            }else if (auth()->user()->type == 'donor') {
                return redirect()->route('donor.home');
            }else if (auth()->user()->type == 'orphanage') {
                return redirect()->route('orphanage.home');
            }else{
                return redirect()->route('home');
            }
        }
        }else{
            return redirect()->route('login')
                ->with('error','Email-Address And Password Are Wrong.');
        }
    }
    
}
