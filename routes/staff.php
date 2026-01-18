<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Staff\StaffDashboardController;
use App\Http\Controllers\Staff\StaffBookingController;

Route::prefix('staff')
	->middleware(['auth', 'staff'])
	->name('staff.')
	->group(function () {

		Route::get('/', [StaffDashboardController::class, 'index'])
			->name('dashboard');

		Route::get('/bookings', [StaffBookingController::class, 'index'])
			->name('bookings.index');

	Route::get('/bookings/{id}', [StaffBookingController::class, 'show'])
		->name('bookings.show');

	Route::get('/reviews', \App\Livewire\Staff\MyReviews::class)
		->name('reviews');
});

