<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class PromoCodeController extends Controller
{
    public function index()
    {
        return view('admin.promo-codes.index');
    }
}
