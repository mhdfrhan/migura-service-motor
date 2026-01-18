<?php

namespace App\Http\Controllers;

use App\Models\ServicePackage;

class HomeController extends Controller
{
    public function index()
    {
        $packages = ServicePackage::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('base_price')
            ->take(3)
            ->get();

        return view('home', compact('packages'));
    }

    public function promoLoyalty()
    {
        return view('promo-loyalty');
    }

    public function chatbot()
    {
        return view('chatbot');
    }
}
