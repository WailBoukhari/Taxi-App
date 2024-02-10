<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\PassengerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ScheduledRideController;
use Illuminate\Support\Facades\Route;











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
    return view('home');
});
Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

Route::middleware(['auth', 'role:Passenger'])->group(function () {
    Route::get('/passenger/dashboard', [PassengerController::class, 'dashboard'])->name('passenger.dashboard');
    Route::get('/passenger/frequent-routes', [PassengerController::class, 'frequentRoutes'])->name('passenger.frequent-routes');
    Route::get('/passenger/reservation', [ReservationController::class, 'index'])->name('reservations.index');
    Route::delete('/reservations/{reservation}', [ReservationController::class, 'cancel'])->name('reservations.cancel');


});

Route::middleware(['auth', 'role:Driver'])->group(function () {
    Route::get('/driver/dashboard', [DriverController::class, 'dashboard'])->name('driver.dashboard');
    Route::get('/driver/complete-account', [DriverController::class, 'completeAccountForm'])
        ->name('driver.complete-account-form');
    Route::post('/driver/complete-account', [DriverController::class, 'completeAccount'])
        ->name('driver.complete-account');
    Route::get('/driver/driver-profile', [DriverController::class, 'driverProfile'])
        ->name('driver.driver-profile');
    Route::get('/driver/edit-profile', [DriverController::class, 'editProfileForm'])
        ->name('driver.edit-profile');
    Route::post('/driver/update-profile', [DriverController::class, 'updateProfile'])
        ->name('driver.update-profile');
    Route::get('driver/driver-schedule', [ScheduledRideController::class, 'indexSchedule'])->name('driver.schedule.index');

    Route::get('/schedules/create', [ScheduledRideController::class, 'createSchedule'])->name('driver.schedule.create');

    Route::post('/schedules/store', [ScheduledRideController::class, 'storeSchedule'])->name('driver.schedule.store');

    Route::get('/schedules/edit', [ScheduledRideController::class, 'editSchedule'])->name('driver.schedule.edit');

    Route::post('/schedules/{id}', [ScheduledRideController::class, 'updateSchedule'])->name('driver.schedule.update');

    Route::delete('/schedules/{id}', [ScheduledRideController::class, 'destroySchedule'])->name('driver.schedule.destroy');
    
});
Route::post('/scheduled-rides/{ride}/favorite', [ScheduledRideController::class, 'favoriteScheduledRide'])
    ->name('scheduled-rides.favorite');
Route::get('/search-frequent-route/{departure_city}/{destination_city}', [ScheduledRideController::class, 'searchFrequentRoute'])->name('search-frequent-route');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware(['auth'])->group(function () {
    Route::get('/scheduled-ride', [ScheduledRideController::class, 'showSearchResults'])->name('scheduled-ride');


    Route::get('/scheduled-rides/{ride}/confirm-booking', [ReservationController::class, 'confirmBooking'])
        ->name('scheduled-rides.confirm-booking');

    Route::post('/scheduled-rides/{ride}/receipt', [ScheduledRideController::class, 'viewReceipt'])
        ->name('scheduled-rides.view-receipt');

});


Route::resource('bookings', BookingController::class);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
