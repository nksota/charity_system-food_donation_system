<?php

use App\Models\Cart;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AAController;
use App\Http\Controllers\DAController;
use App\Http\Controllers\OAController;
use App\Http\Controllers\VAController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TwoFAController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\OrphanageController;
use App\Http\Controllers\VolunteerController;
use App\Http\Controllers\AdminDeliveryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('2fa', [TwoFAController::class, 'index'])->name('2fa.index');
Route::post('2fa', [TwoFAController::class, 'store'])->name('2fa.post');
Route::get('2fa/reset', [TwoFAController::class, 'resend'])->name('2fa.resend');

/*------------------------------------------

--------------------------------------------

All Volunteer Routes List

--------------------------------------------

--------------------------------------------*/

Route::middleware(['auth', 'user-access:volunteer'])->group(function () {

    /**
     * Complete profile
     */
    Route::get('/volunteer/dashboard', [VolunteerController::class, 'index'])->name('volunteer.dashboard');
    Route::post('/volunteer/dashboard', [VolunteerController::class, 'store']);

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    /**
     * Profile edit
     */
    Route::get('/volunteer/profile/profile', [VolunteerController::class, 'editProfile'])->name('volunteer.profile.profile');
    Route::put('/volunteer/profile/profile', [VolunteerController::class, 'updateProfile'])->name('volunteer.profile.update');
    //update details in admins table
    Route::get('/volunteer/profile/profile', [VolunteerController::class, 'editProfile'])->name('volunteer.profile.profile');
    Route::put('/volunteer/profile/profile', [VolunteerController::class, 'updateProfile'])->name('volunteer.profile.update');

    /*
    Volunteer Delivery
    */
    Route::get('/volunteer/delivery', [DeliveryController::class, 'index'])->name('volunteer.delivery.index');
    Route::get('/volunteer/delivery/pending', [DeliveryController::class, 'pending'])->name('volunteer.delivery.pending');
    Route::get('/volunteer/delivery/confirmed', [DeliveryController::class, 'confirmed'])->name('volunteer.delivery.confirmed');
    Route::get('/volunteer/delivery/dispatched', [DeliveryController::class, 'dispatched'])->name('volunteer.delivery.dispatched');
    Route::get('/volunteer/delivery/delivered', [DeliveryController::class, 'delivered'])->name('volunteer.delivery.delivered');

    // Edit volunteer status
    Route::get('/volunteer/delivery/edit/{passport}', [DeliveryController::class, 'edit'])->name('volunteer.delivery.edit');
    Route::put('/volunteer/delivery/{passport}', [DeliveryController::class, 'update'])->name('volunteer.delivery.update');
   

});

/*------------------------------------------

--------------------------------------------

All Admin Routes List

--------------------------------------------

--------------------------------------------*/

Route::middleware(['auth', 'user-access:admin'])->group(function () {

    /**
     * Complete Profile
     */
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/dashboard', [AdminController::class, 'store']);

    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');

    /**
     * Profile edit
     */
    Route::get('/admin/profile/profile', [AdminController::class, 'editProfile'])->name('admin.profile.profile');
    Route::put('/admin/profile/profile', [AdminController::class, 'updateProfile'])->name('admin.profile.update');
    //update details in admins table
    Route::get('/admin/profile/profile', [AdminController::class, 'editProfile'])->name('admin.profile.profile');
    Route::put('/admin/profile/profile', [AdminController::class, 'updateProfile'])->name('admin.profile.update');

    /**
     * Add Users
     */
    //Admin
    Route::get('/admin/admin/list', [AAController::class, 'list'])->name('admin.admin.list');
    Route::get('/admin/admin/add', [AAController::class, 'create']);
    Route::post('/admin/admin/add', [AAController::class, 'store'])->name('admin.admin.store');
    Route::get('/admin/admin/{id}/edit', [AAController::class, 'edit'])->name('admin.admin.edit');
    Route::put('/admin/admin/{id}', [AAController::class, 'update'])->name('admin.admin.update');
    Route::get('admin/admin/{admin_id}/delete', [AAController::class, 'destroy']);
   //Volunteer
    Route::get('/admin/volunteer/list', [VAController::class, 'list'])->name('admin.volunteer.list');
    Route::get('/admin/volunteer/add', [VAController::class, 'create']);
    Route::post('/admin/volunteer/add', [VAController::class, 'store'])->name('admin.volunteer.store');
    Route::get('/admin/volunteer/{id}/edit', [VAController::class, 'edit'])->name('admin.volunteer.edit');
    Route::put('/admin/volunteer/{id}', [VAController::class, 'update'])->name('admin.volunteer.update');
    Route::get('admin/volunteer/{volunteer_id}/delete', [VAController::class, 'destroy']);
   //Donor
    Route::get('/admin/donor/list', [DAController::class, 'list'])->name('admin.donor.list');
    Route::get('/admin/donor/add', [DAController::class, 'create']);
    Route::post('/admin/donor/add', [DAController::class, 'store'])->name('admin.donor.store');
    Route::get('/admin/donor/{id}/edit', [DAController::class, 'edit'])->name('admin.donor.edit');
    Route::put('/admin/donor/{id}', [DAController::class, 'update'])->name('admin.donor.update');
    Route::get('admin/donor/{donor_id}/delete', [DAController::class, 'destroy']);
   //Orphanage
    Route::get('/admin/orphanage/list', [OAController::class, 'list'])->name('admin.orphanage.list');
    Route::get('/admin/orphanage/add', [OAController::class, 'create']);
    Route::post('/admin/orphanage/add', [OAController::class, 'store'])->name('admin.orphanage.store');
    Route::get('/admin/orphanage/{id}/edit', [OAController::class, 'edit'])->name('admin.orphanage.edit');
    Route::put('/admin/orphanage/{id}', [OAController::class, 'update'])->name('admin.orphanage.update');
    Route::get('admin/orphanage/{orphanage_id}/delete', [OAController::class, 'destroy']);

    /**
     * Donations CRUD
     */

     Route::get('admin/donations', [DonationController::class, 'index'])->name('donations.index');
     Route::get('admin/donations/create', [DonationController::class, 'create'])->name('donations.create');
     Route::post('admin/donations', [DonationController::class, 'store'])->name('donations.store');
     Route::get('admin/donations/{donation}/edit', [DonationController::class, 'edit'])->name('donations.edit');
     Route::put('admin/donations/{donation}', [DonationController::class, 'update'])->name('donations.update');
     Route::delete('admin/donations/{donation}', [DonationController::class, 'destroy'])->name('donations.destroy');

    /*
    Order Delivery
    */
    Route::get('/admin/delivery', [AdminDeliveryController::class, 'index'])->name('admin.delivery.index');
    Route::get('/admin/delivery/pending', [AdminDeliveryController::class, 'pending'])->name('admin.delivery.pending');
    Route::get('/admin/delivery/confirmed', [AdminDeliveryController::class, 'confirmed'])->name('admin.delivery.confirmed');
    Route::get('/admin/delivery/dispatched', [AdminDeliveryController::class, 'dispatched'])->name('admin.delivery.dispatched');
    Route::get('/admin/delivery/delivered', [AdminDeliveryController::class, 'delivered'])->name('admin.delivery.delivered');
    // Edit
    Route::get('/admin/delivery/edit/{passport}', [AdminDeliveryController::class, 'edit'])->name('admin.delivery.edit');
    Route::put('/admin/delivery/{passport}', [AdminDeliveryController::class, 'update'])->name('admin.delivery.update');
   

});

  

/*------------------------------------------

--------------------------------------------

All Donor Routes List

--------------------------------------------

--------------------------------------------*/

Route::middleware(['auth', 'user-access:donor'])->group(function () {

    Route::get('/donor/dashboard', [DonorController::class, 'index'])->name('donor.dashboard');
    Route::post('/donor/dashboard', [DonorController::class, 'store']);

    Route::get('/donor/home', [HomeController::class, 'donorHome'])->name('donor.home');

        /**
     * Profile edit
     */
    Route::get('/donor/profile/profile', [DonorController::class, 'editProfile'])->name('donor.profile.profile');
    Route::put('/donor/profile/profile', [DonorController::class, 'updateProfile'])->name('donor.profile.update');
    //update details in admins table
    Route::get('/donor/profile/profile', [DonorController::class, 'editProfile'])->name('donor.profile.profile');
    Route::put('/donor/profile/profile', [DonorController::class, 'updateProfile'])->name('donor.profile.update');

      /**
     * Donations CRUD
     */

     Route::get('donor/donations', [DonationController::class, 'indexD'])->name('donor.donations.index');
     Route::get('donor/donations/create', [DonationController::class, 'createD'])->name('donor.donations.create');
     Route::post('donor/donations', [DonationController::class, 'storeD'])->name('donor.donations.store');
     Route::get('donor/donations/{donation}/edit', [DonationController::class, 'editD'])->name('donor.donations.edit');
     Route::put('donor/donations/{donation}', [DonationController::class, 'updateD'])->name('donor.donations.update');
     Route::delete('donor/donations/{donation}', [DonationController::class, 'destroyD'])->name('donor.donations.destroy');

     //Orphanage
    Route::get('/donor/orphanage/list', [DonorController::class, 'list'])->name('donor.orphanage.list');
});


/*------------------------------------------

--------------------------------------------

All Orphanage Routes List

--------------------------------------------

--------------------------------------------*/

Route::middleware(['auth', 'user-access:orphanage'])->group(function () {

    Route::get('/orphanage/dashboard', [OrphanageController::class, 'index'])->name('orphanage.dashboard');
    Route::post('/orphanage/dashboard', [OrphanageController::class, 'store']);

    Route::get('/orphanage/home', [HomeController::class, 'orphanageHome'])->name('orphanage.home');

            /**
     * Profile edit
     */
    Route::get('/orphanage/profile/profile', [OrphanageController::class, 'editProfile'])->name('orphanage.profile.profile');
    Route::put('/orphanage/profile/profile', [OrphanageController::class, 'updateProfile'])->name('orphanage.profile.update');
    //update details in admins table
    Route::get('/orphanage/profile/profile', [OrphanageController::class, 'editProfile'])->name('orphanage.profile.profile');
    Route::put('/orphanage/profile/profile', [OrphanageController::class, 'updateProfile'])->name('orphanage.profile.update');

    /**
     * Donations Display
     */
    // Display a list of donations
    Route::get('/orphanage/donations', [DonationController::class, 'indexO'])->name('donations.index');

    // View a specific donation
    Route::get('/orphanage/donations/{id}', [DonationController::class, 'viewO'])->name('donations.view');
    // Add a donation to the cart
    Route::post('/donations/{donation}/add-to-cart', [DonationController::class, 'addToCart'])->name('donations.add-to-cart');
 

    // Routes for managing the cart
    Route::get('/orphanage/cart', [CartController::class, 'index'])->name('orphanage.cart.cart');
    Route::post('/orphanage/cart/add/{donation_id}', [CartController::class, 'addToCart'])->name('orphanage.cart.add');
    Route::get('/orphanage/cart/view', [CartController::class, 'viewCart'])->name('orphanage.cart.view');
    Route::delete('/orphanage/cart/remove/{donation}', [CartController::class, 'removeFromCart'])->name('orphanage.cart.remove');
    
    //Checkout routes
    Route::get('/orphanage/checkout', [CheckoutController::class, 'index'])->name('orphanage.checkout');
    Route::post('/orphanage/checkout', [CheckoutController::class, 'processCheckout'])->name('orphanage.checkout.process');

    //Orders
    Route::get('/orphanage/orders', [OrderController::class, 'index'])->name('orphanage.orders');


});


/*------------------------------------------

--------------------------------------------

Logout Rout

--------------------------------------------

--------------------------------------------*/

Route::get('/logout', [App\Http\Controllers\LogoutController::class, 'perform'])->name('logout.perform');