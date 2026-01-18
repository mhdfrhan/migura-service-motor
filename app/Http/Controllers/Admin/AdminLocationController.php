<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminLocationController extends Controller
{
    public function index()
    {
        return view('admin.locations.index');
    }
}
