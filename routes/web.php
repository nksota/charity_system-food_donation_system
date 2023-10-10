<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AAController;
use App\Http\Controllers\DAController;
use App\Http\Controllers\OAController;
use App\Http\Controllers\VAController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\OrphanageController;
use App\Http\Controllers\VolunteerController;

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


/*------------------------------------------

--------------------------------------------

All Volunteer Routes List

--------------------------------------------

--------------------------------------------*/

Route::middleware(['auth', 'user-access:volunteer'])->group(function () {

  
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

});

/*------------------------------------------

--------------------------------------------

All Admin Routes List

--------------------------------------------

--------------------------------------------*/

Route::middleware(['auth', 'user-access:admin'])->group(function () {

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

});


/*------------------------------------------

--------------------------------------------

Logout Rout

--------------------------------------------

--------------------------------------------*/

Route::get('/logout', [App\Http\Controllers\LogoutController::class, 'perform'])->name('logout.perform');