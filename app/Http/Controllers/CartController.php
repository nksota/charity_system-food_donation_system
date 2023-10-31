<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Donation;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        // Get the items in the user's cart
        $cart = Cart::where('user_id', auth()->user()->id)->get();
    
        return view('orphanage.cart.cart', compact('cart'));
    }

    public function removeFromCart(Donation $donation)
    {
        $user = auth()->user();

        // Find the cart item
        $cartItem = Cart::where('user_id', $user->id)
                       ->where('donation_id', $donation->id)
                       ->first();
    
        if ($cartItem) {
            // Update the status of the donation to "Available"
            $donation->update(['status' => 'Available']);
    
            // Delete the cart item
            $cartItem->delete();
    
            // Provide user feedback
            session()->flash('message', 'Claim removed from the cart.');
        } else {
            session()->flash('error', 'Claim not found in the cart.');
        }
    
        return redirect()->route('orphanage.cart.cart');
    }
    
}
