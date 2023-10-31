<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeliveryController extends Controller
{
    public function index()
    {
        $confirmedDeliveries = Order::where('volunteer_id', auth()->user()->id)
            ->where('status', 'confirmed')
            ->get();

        return view('volunteer.delivery.index', compact('confirmedDeliveries'));
    }

    public function pending()
    {
        
        $confirmedDeliveries = Order::where('status', 'pending')->get();
    
        return view('volunteer.delivery.index', compact('confirmedDeliveries'));
    }
    
    public function confirmed()
    {
        
        $confirmedDeliveries = Order::where('status', 'confirmed')->get();
    
        return view('volunteer.delivery.index', compact('confirmedDeliveries'));
    }
    
    public function dispatched()
    {
        
        $confirmedDeliveries = Order::where('status', 'dispatched')->get();
    
        return view('volunteer.delivery.index', compact('confirmedDeliveries'));
    }
    
    public function delivered()
    {
        
        $confirmedDeliveries = Order::where('status', 'delivered')->get();
    
        return view('volunteer.delivery.index', compact('confirmedDeliveries'));
    }

    public function edit(Order $passport)
    {
        return view('volunteer.delivery.edit', compact('passport'));
    }

    public function update(Request $request, Order $passport)
    {
        // Update passport application status
        $request->validate([
            'status' => 'required|in:pending,confirmed,dispatched,delivered',
        ]);

        $passport->update(['status' => $request->input('status')]);

        return redirect()->route('volunteer.delivery.index')->with('message', 'Delivery updated successfully.');
    }
}
