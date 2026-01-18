<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminActivityLogController extends Controller
{
    public function index()
    {
        return view('admin.activity-logs.index');
    }
}
