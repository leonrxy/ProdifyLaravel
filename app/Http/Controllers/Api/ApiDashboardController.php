<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use App\Traits\ApiResponse;

class ApiDashboardController extends Controller
{
    use ApiResponse;
    public function index()
    {
        $totalUsers = User::count();
        $totalProducts = Product::count();

        return $this->successResponse([
            'total_users' => $totalUsers,
            'total_products' => $totalProducts,
        ], 'Dashboard data retrieved successfully');
    }
}
