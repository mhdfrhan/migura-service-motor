<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminBookingController extends Controller
{
    public function index()
    {
        return view('admin.bookings.index');
    }

    public function show(string $id)
    {
        return view('admin.bookings.show');
    }
}
