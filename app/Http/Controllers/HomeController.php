<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Donation;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()

    {
        $volunteer = auth()->user();

        // Retrieve orders that belong to the volunteer based on volunteer_id
        $volunteerOrders = Order::where('volunteer_id', $volunteer->id)->get();
        $orderCount = Order::where('volunteer_id', $volunteer->id)->count();

        return view('home', compact('volunteerOrders', 'orderCount'));

    } 

  

    /**

     * Show the application dashboard.

     *

     * @return \Illuminate\Contracts\Support\Renderable

     */

    public function adminHome()

    {
        $latestOrders = Order::latest()->limit(10)->get();
        $orderCount = Order::count();
        $userCount = User::count();
        $donationCount = Donation::count();

        return view('adminHome', compact('orderCount', 'userCount', 'donationCount', 'latestOrders'));

    }

  

    /**

     * Show the application dashboard.

     *

     * @return \Illuminate\Contracts\Support\Renderable

     */

    public function donorHome()

    {
        $user = auth()->user();
        $userCount = User::where('type', 3)->count();
        $donationCount = Donation::where('user_id', $user->id)->count();

        return view('donorHome', compact('userCount', 'donationCount'));

    }


        /**

     * Show the application dashboard.

     *

     * @return \Illuminate\Contracts\Support\Renderable

     */

     public function orphanageHome()

     {
         // Get the currently authenticated user (volunteer)
         $volunteer = auth()->user();

         // Count the orders that belong to the volunteer based on volunteer_id
         $orderCount = Order::where('user_id', $volunteer->id)->count();
         $donationCount = Donation::count();
         return view('orphanageHome', compact('orderCount', 'donationCount'));
 
     }


}
