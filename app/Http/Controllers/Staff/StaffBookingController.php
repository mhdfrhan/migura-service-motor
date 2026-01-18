<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;

class StaffBookingController extends Controller
{
    public function index()
    {
        return view('staff.bookings.index');
    }

    public function show(string $id)
    {
        return view('staff.bookings.show', compact('id'));
    }
}
