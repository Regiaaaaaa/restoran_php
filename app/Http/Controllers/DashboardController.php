<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Menu;
use App\Models\Table;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('total_price');
        $totalMenuItems = Menu::count();
        

        $recentOrders = Order::with('orderItems.menu')->latest()->take(5)->get();

        return view('dashboard', compact(
            'totalOrders',
            'totalRevenue',
            'totalMenuItems',
            'recentOrders'
        ));
    }

    
}