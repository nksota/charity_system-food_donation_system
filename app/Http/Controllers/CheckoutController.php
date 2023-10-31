<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Volunteer;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        // Get the donations in the cart
        $cart = Cart::where('user_id', auth()->user()->id)->get();

        // Get all available volunteers for selection
        $volunteers = User::where('type', 'volunteer')->get();

        return view('orphanage.checkout.checkout', compact('cart', 'volunteers'));
    }

    public function processCheckout(Request $request)
    {
        // Validate the request data
        $request->validate([
            'location' => 'required|string',
            'volunteer' => 'required|exists:users,id',
        ]);

        // Handle the checkout logic here
        // For example, create a new order record with the provided location and volunteer
        // Remove the donations from the cart

        // Example code to create an order record (adjust this to your database structure)
        $order = new Order();
        $order->user_id = auth()->user()->id;
        $order->location = $request->input('location');
        $order->volunteer_id = $request->input('volunteer');
        $order->save();

        // Optionally, remove the donations from the cart
        $cart = Cart::where('user_id', auth()->user()->id)->get();
        foreach ($cart as $cartItem) {
            $cartItem->delete();
        }

        // Redirect to the orders page or other appropriate page
        return redirect()->route('orphanage.orders')->with('message', 'Checkout successful. Your order is confirmed!');
    }


}
