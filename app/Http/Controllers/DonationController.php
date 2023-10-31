<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DonationController extends Controller
{
    public function index()
    {
        $donations = Donation::all();
        return view('admin.donations.index', compact('donations'));
    }
    public function indexD()
    {
         // Fetch only the current user's donations
         $donations = auth()->user()->donations;
        return view('donor.donations.index', compact('donations'));
    }

    public function create()
    {
        return view('admin.donations.create');
    }

    public function createD()
    {
        return view('donor.donations.create');
    }

    public function store(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Assuming you want to upload images
            'quantity' => 'required|integer|min:1'
        ]);

        if ($request->hasFile('image')) {
            $profileImage = $request->file('image');
            $profileImageName = time() . '.' . $profileImage->getClientOriginalExtension();
            $profileImage->storeAs('public/donations', $profileImageName);
            $imagePath = 'storage/donations/' . $profileImageName;
        } else {
            // If no image is uploaded, set $imagePath to null or any default value you prefer.
            $imagePath = null;
        }
         // Set the status to "Available"
        $validatedData['status'] = 'Available';

          // Add the image path to the validated data
        $validatedData['image'] = $imagePath;

        $validatedData['user_id'] = auth()->user()->id;
        // Create a new donation record
        Donation::create($validatedData);

        return redirect()->route('donations.index')->with('message', 'Donation added successfully');
    }

    public function storeD(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Assuming you want to upload images
            'quantity' => 'required|integer|min:1'
        ]);

        if ($request->hasFile('image')) {
            $profileImage = $request->file('image');
            $profileImageName = time() . '.' . $profileImage->getClientOriginalExtension();
            $profileImage->storeAs('public/donations', $profileImageName);
            $imagePath = 'storage/donations/' . $profileImageName;
        } else {
            // If no image is uploaded, set $imagePath to null or any default value you prefer.
            $imagePath = null;
        }
         // Set the status to "Available"
        $validatedData['status'] = 'Available';

          // Add the image path to the validated data
        $validatedData['image'] = $imagePath;

        $validatedData['user_id'] = auth()->user()->id;
        // Create a new donation record
        Donation::create($validatedData);

        return redirect()->route('donor.donations.index')->with('message', 'Donation added successfully');
    }

    public function edit(Donation $donation)
    {
        return view('admin.donations.edit', compact('donation'));
    }
    public function editD($id)
    {
        $donation = Donation::findOrFail($id);
        
        // Check if the user is authorized to edit this donation (e.g., if they are the owner)
        if (auth()->user()->id !== $donation->user_id) {
            abort(403); // Unauthorized access
        }
        return view('donor.donations.edit', compact('donation'));
    }

    public function update(Request $request, $id)
    {
           // Validate the input data
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Assuming you want to upload images
                'quantity' => 'required|integer|min:1',
                'status' => 'required|in:Available,Taken',
            ]);

            // Find the donation record by ID
            $donation = Donation::findOrFail($id);

            // Handle image update and save the image path
            $imagePath = $donation->image; // Get the existing image path

            if ($request->hasFile('image')) {
                $profileImage = $request->file('image');
                $profileImageName = time() . '.' . $profileImage->getClientOriginalExtension();
                $profileImage->storeAs('public/donations', $profileImageName);
                $imagePath = 'storage/donations/' . $profileImageName;
            }

            // Update the donation record
            $donation->update([
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'quantity' => $validatedData['quantity'],
                'status' => $validatedData['status'],
                'image' => $imagePath, // Update the image path
            ]);

        return redirect()->route('donations.index')->with('message', 'Donation updated successfully');
    }

    public function updateD(Request $request, $id)
    {
           // Validate the input data
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Assuming you want to upload images
                'quantity' => 'required|integer|min:1',
                'status' => 'required|in:Available,Taken',
            ]);

            // Find the donation record by ID
            $donation = Donation::findOrFail($id);

            // Handle image update and save the image path
            $imagePath = $donation->image; // Get the existing image path

            if ($request->hasFile('image')) {
                $profileImage = $request->file('image');
                $profileImageName = time() . '.' . $profileImage->getClientOriginalExtension();
                $profileImage->storeAs('public/donations', $profileImageName);
                $imagePath = 'storage/donations/' . $profileImageName;
            }

            // Update the donation record
            $donation->update([
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'quantity' => $validatedData['quantity'],
                'status' => $validatedData['status'],
                'image' => $imagePath, // Update the image path
            ]);

        return redirect()->route('donor.donations.index')->with('message', 'Donation updated successfully');
    }

    public function destroy(Donation $donation)
    {
        // Delete the donation image file (if it exists)
        if ($donation->image) {
            Storage::delete($donation->image);
        }

        // Delete the donation record
        $donation->delete();

        return redirect()->route('donations.index')->with('message', 'Donation deleted successfully');
    }
    public function destroyD(Donation $donation)
    {
        // Delete the donation image file (if it exists)
        if ($donation->image) {
            Storage::delete($donation->image);
        }

        // Delete the donation record
        $donation->delete();

        return redirect()->route('donor.donations.index')->with('message', 'Donation deleted successfully');
    }

     // Display a list of donations
     public function indexO()
     {
         $donations = Donation::where('status', 'Available')->get();
         return view('orphanage.donation.index', compact('donations'));
     }
  
     // View a specific donation
     public function viewO($id)
     {
         $donation = Donation::findOrFail($id);
         return view('orphanage.donation.view', compact('donation'));
     }

     public function addToCart(Donation $donation) {
        // Get the currently authenticated user
        $user = auth()->user();
    
        // Check if the donation is already in the user's cart
        $existingCartItem = Cart::where('user_id', $user->id)
            ->where('donation_id', $donation->id)
            ->first();
    
        if ($existingCartItem) {
            // If the donation is already in the cart, increase its quantity
            $existingCartItem->increment('quantity');
        } else {
            // If the donation is not in the cart, create a new cart item
            Cart::create([
                'user_id' => $user->id,
                'donation_id' => $donation->id,
                'quantity' => 1,
            ]);

            // Update the status of the donation to "Taken"
            $donation->update(['status' => 'Taken']);

        }
    
        // Redirect back to the donation list or cart view
        return redirect()->route('orphanage.cart.cart')->with('message', 'Added to Cart!');
    }
    

}
