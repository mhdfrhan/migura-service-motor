<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminBookingController;
use App\Http\Controllers\Admin\AdminServiceController;
use App\Http\Controllers\Admin\AdminPaymentController;
use App\Http\Controllers\Admin\AdminCustomerController;
use App\Http\Controllers\Admin\AdminLocationController;
use App\Http\Controllers\Admin\AdminReportController;
use App\Http\Controllers\Admin\AdminSettingController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminStaffController;
use App\Http\Controllers\Admin\AdminActivityLogController;
use App\Http\Controllers\Admin\PromoCodeController;

Route::prefix('admin')
	->middleware(['auth', 'admin'])
	->name('admin.')
	->group(function () {

		Route::get('/', [AdminDashboardController::class, 'index'])
			->name('dashboard');

		Route::get('/bookings', [AdminBookingController::class, 'index'])
			->name('bookings.index');

		Route::get('/bookings/{id}', [AdminBookingController::class, 'show'])
			->name('bookings.show');

		Route::get('/services', [AdminServiceController::class, 'index'])
			->name('services.index');

		Route::get('/payments', [AdminPaymentController::class, 'index'])
			->name('payments.index');

		Route::get('/customers', [AdminCustomerController::class, 'index'])
			->name('customers.index');

		Route::get('/locations', [AdminLocationController::class, 'index'])
			->name('locations.index');

		Route::get('/reports', [AdminReportController::class, 'index'])
			->name('reports.index');

		Route::get('/settings', [AdminSettingController::class, 'index'])
			->name('settings.index');

		Route::get('/admins', [AdminUserController::class, 'index'])
			->name('admins.index');

		Route::get('/staff-performance', [AdminStaffController::class, 'performance'])
			->name('staff-performance');

		Route::get('/activity-logs', [AdminActivityLogController::class, 'index'])
			->name('activity-logs.index');

		Route::get('/promo-codes', [PromoCodeController::class, 'index'])
			->name('promo-codes.index');

		Route::get('/payment-methods', function () {
			return view('admin.payment-methods.index');
		})->name('payment-methods.index');
	});
