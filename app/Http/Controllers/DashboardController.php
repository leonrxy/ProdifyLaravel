<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'userCount' => \App\Models\User::count(),
            'productCount' => \App\Models\Product::count(),
        ]);
    }
}
