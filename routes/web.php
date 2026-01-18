<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/promosi-loyalitas', [HomeController::class, 'promoLoyalty'])->name('promo.loyalty');
Route::view('/about', 'about')->name('about');
Route::get('/locations', \App\Livewire\LocationsPage::class)->name('locations');

// Legal Pages
Route::view('/terms', 'terms')->name('terms');
Route::view('/privacy', 'privacy')->name('privacy');

/*
|--------------------------------------------------------------------------
| Authenticated User
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Booking
    Route::get('/booking', [BookingController::class, 'index'])
        ->name('booking.index');

    Route::get('/booking/confirm', [BookingController::class, 'confirm'])
        ->name('booking.confirm');

    Route::get('/my-orders', \App\Livewire\MyOrders::class)
        ->name('my-orders');

    Route::get('/booking/{id}', [BookingController::class, 'show'])
        ->name('booking.show');

    // Review
    Route::get('/booking/{bookingId}/review', \App\Livewire\ReviewForm::class)
        ->name('booking.review');

    Route::get('/home-service', [BookingController::class, 'homeService'])
        ->name('home-service');

    // Payment (Midtrans)
    Route::get('/payment', [PaymentController::class, 'index'])
        ->name('payment.index');

    Route::get('/payment/confirm', [PaymentController::class, 'confirm'])
        ->name('payment.confirm');

    Route::get('/payment/status', [PaymentController::class, 'status'])
        ->name('payment.status');

    // Other
    Route::get('/notifications', [DashboardController::class, 'notifications'])
        ->name('notifications');

    Route::get('/loyalty-points', [DashboardController::class, 'loyaltyPoints'])
        ->name('loyalty.points');

    Route::get('/chatbot', \App\Livewire\ChatbotPage::class)
        ->name('chatbot');

    // Profile
    Route::get('/profile', [ProfileController::class, 'index'])
        ->name('profile');

    Route::get('/profile/edit', fn() => view('profile.edit'))
        ->name('profile.edit');

    // Payment Methods
    Route::get('/payment-methods', fn() => view('payment-methods'))
        ->name('payment-methods');

    // Help & Support
    Route::get('/help-support', fn() => view('help-support'))
        ->name('help-support');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/staff.php';
