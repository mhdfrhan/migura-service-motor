<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function notifications()
    {
        return view('notifications');
    }

    public function loyaltyPoints()
    {
        return view('loyalty-points');
    }
}

