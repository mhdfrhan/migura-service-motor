<?php

namespace App\Http\Controllers;

class PaymentController extends Controller
{
    public function index()
    {
        return view('payment.index');
    }

    public function confirm()
    {
        return view('payment.confirm');
    }

    public function status()
    {
        return view('payment.status');
    }
}

