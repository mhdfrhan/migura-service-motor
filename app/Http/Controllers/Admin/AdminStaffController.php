<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminStaffController extends Controller
{
    public function performance()
    {
        return view('admin.staff.performance');
    }
}
