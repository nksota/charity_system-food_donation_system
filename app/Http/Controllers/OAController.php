<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class OAController extends Controller
{
    public function list()
    {
        $orphanages = User::where('type', 3)->get();
        return view('admin.orphanage.list', compact('orphanages'));
    }

    public function create()
    {
        return view('admin.orphanage.add');
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
        $user->type = 3;
        $user->save();

        return redirect()->route('admin.orphanage.list')->with('message', 'Orphanage created successfully');
    }
    
    public function edit($user_id)
    {
        $user = User::findOrFail($user_id);
        return view('admin.orphanage.edit', compact('user'));
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
            return redirect()->route('admin.orphanage.edit', $user->id)
                ->withErrors($validator)
                ->withInput();
        }

        // Update the user's data
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Save the updated user data
        $user->save();

        return redirect()->route('admin.orphanage.list')->with('message', 'Orphanage updated successfully');
    }
    public function destroy(int $orphanage_id)
    {
            // Find the user by ID
        $user = User::find($orphanage_id);

        // Check if the user exists
        if ($user) {
            // Use a database transaction for safety
            DB::transaction(function () use ($user) {
                // Delete associated admin information if it exists
                $orphanages = $user->orphanages;
                if ($orphanages) {
                    $orphanages->each(function ($orphanage) {
                        $orphanage->delete();
                    });
                }

                // Delete the user
                $user->delete();
            });
                // Redirect or respond accordingly
                return redirect()->back()->with('message', 'Orphanage deleted successfully.');
            } else {
                // Handle the case where the user doesn't exist
                return redirect()->back()->with('error', 'Something went wrong.');
            }
        
    }
}
