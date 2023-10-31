<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminDeliveryController extends Controller
{
    public function index()
    {
        $confirmedDeliveries = Order::all();

        return view('admin.delivery.index', compact('confirmedDeliveries'));
    }

    public function pending()
    {
        
        $confirmedDeliveries = Order::where('status', 'pending')->get();
    
        return view('admin.delivery.index', compact('confirmedDeliveries'));
    }
    
    public function confirmed()
    {
        
        $confirmedDeliveries = Order::where('status', 'confirmed')->get();
    
        return view('admin.delivery.index', compact('confirmedDeliveries'));
    }
    
    public function dispatched()
    {
        
        $confirmedDeliveries = Order::where('status', 'dispatched')->get();
    
        return view('admin.delivery.index', compact('confirmedDeliveries'));
    }
    
    public function delivered()
    {
        
        $confirmedDeliveries = Order::where('status', 'delivered')->get();
    
        return view('admin.delivery.index', compact('confirmedDeliveries'));
    }

    public function edit(Order $passport)
    {
        return view('admin.delivery.edit', compact('passport'));
    }

    public function update(Request $request, Order $passport)
    {
        // Update passport application status
        $request->validate([
            'status' => 'required|in:pending,confirmed,dispatched,delivered',
        ]);

        $passport->update(['status' => $request->input('status')]);

        return redirect()->route('admin.delivery.index')->with('message', 'Delivery updated successfully.');
    }
}
