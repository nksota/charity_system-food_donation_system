<?php

namespace App\Http\Controllers;

use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class VolunteerController extends Controller
{
    public function index()
    {
        return view('volunteer.dashboard');
    }

    public function store(Request $request)
    {
               // Validate the submitted data
               $request->validate([
                'dob' => 'required|date',
                'phone' => 'required|string',
                'address' => 'required|string',
                'city' => 'required|string',
                'profile' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'gender' => 'required|in:Male,Female,Other',
            ]);
            
            // Get the authenticated user
            $user = auth()->user();

            if ($request->hasFile('profile')) {
                $profileImage = $request->file('profile');
                $profileImageName = time() . '.' . $profileImage->getClientOriginalExtension();
                $profileImage->storeAs('public/profiles', $profileImageName);
        
                if (!$user->admin) {
                    $admin = new Volunteer($request->except('profile'));
                    $admin->profile = $profileImageName;
                    $user->admins()->save($admin);

                    // Update the 'status' field in the 'users' table to 'yes'
                    $user->status = 'yes';
                    $user->save();
                } else {
                    $user->admin->update($request->except('profile') + ['profile' => $profileImageName]);
                }
            }
              
            // Redirect to the user's dashboard or another appropriate page
            return redirect()->route('home')->with('message', 'Profile updated successfully.');
    }

    public function editProfile(Request $request)
    {
        // Determine the currently active tab or set a default tab
        $redirectToTab = 'timeline'; // Assuming 'timeline' is the default tab
        $user = Auth::user();
        $volunteer = Volunteer::where('user_id', $user->id)->first();


        return view('volunteer.profile.profile', compact('user', 'volunteer', 'redirectToTab'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $volunteer = Auth::user()->volunteers()->firstOrNew([]);

        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            //dd($validator->errors());
            return redirect()->route('volunteer.profile.profile')
                ->withErrors($validator)
                ->withInput();
        }

        // Update user data
        if ($request->filled('name')) {
            $user->name = $request->input('name');
        }
        
        if ($request->filled('email')) {
            $user->email = $request->input('email');
        }

        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        $user->save();
        // Update admin data
        if ($request->filled('city')) {
            $volunteer->city = $request->input('city');
        }
        if ($request->filled('phone')) {
            $volunteer->phone = $request->input('phone');
        }
        if ($request->filled('address')) {
            $volunteer->address = $request->input('address');
        }

        $volunteer->save();

        // Redirect back to the same tab
        $redirectToTab = $request->input('tab');

        return redirect()->route('volunteer.profile.profile', ['tab' => $redirectToTab])->with('message', 'Profile updated successfully.');
    }

}
