<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\SalesOrder;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSales = SalesOrder::sum('total');
        $totalOrders = SalesOrder::count();
        $lowStock = Product::where('quantity', '<', 5)->get();

        return view('dashboard.index', compact('totalSales', 'totalOrders', 'lowStock'));
    }
}
