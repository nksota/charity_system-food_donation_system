<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class VAController extends Controller
{
    public function list()
    {
        $volunteers = User::where('type', 0)->get();
        return view('admin.volunteer.list', compact('volunteers'));
    }

    public function create()
    {
        return view('admin.volunteer.add');
    }

    public function store(Request $request)
    {
        // Validate user input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|min:8',
        ]);

        // Create a new user
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
       
        // Automatically assign the role
        $user->type = 0;
        $user->save();

        return redirect()->route('admin.volunteer.list')->with('message', 'Volunteer created successfully');
    }
    
    public function edit($user_id)
    {
        $user = User::findOrFail($user_id);
        return view('admin.volunteer.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        // Validate the form fields
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.volunteer.edit', $user->id)
                ->withErrors($validator)
                ->withInput();
        }

        // Update the user's data
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Save the updated user data
        $user->save();

        return redirect()->route('admin.volunteer.list')->with('message', 'Volunteer updated successfully');
    }
    public function destroy(int $volunteer_id)
    {
            // Find the user by ID
        $user = User::find($volunteer_id);

        // Check if the user exists
        if ($user) {
            // Use a database transaction for safety
            DB::transaction(function () use ($user) {
                // Delete associated admin information if it exists
                $volunteers = $user->volunteers;
                if ($volunteers) {
                    $volunteers->each(function ($volunteer) {
                        $volunteer->delete();
                    });
                }

                // Delete the user
                $user->delete();
            });
                // Redirect or respond accordingly
                return redirect()->back()->with('message', 'Volunteer deleted successfully.');
            } else {
                // Handle the case where the user doesn't exist
                return redirect()->back()->with('error', 'Something went wrong.');
            }
        
    }
}
