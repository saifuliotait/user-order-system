<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function totalRevenue()
    {
        $orders = Order::all();
        $totalRevenue = 0;

        foreach ($orders as $order) {
            $totalRevenue += $order->quantity * $order->unit_price;
        }

        return $totalRevenue;
    }

    public function generateReport()
    {
        // Retrieve all users
        $users = User::all();

        // Initialize an empty array to store the report data
        $report = [];

        // Loop through each user
        foreach ($users as $user) {
            // Retrieve all orders for the user
            $orders = $user->orders()->get();

            // Loop through each order
            foreach ($orders as $order) {

                // Calculate total revenue, average order value, and total orders for the user
                $totalRevenue = $user->orders()->sum('total_amount');
                $totalOrders = $user->orders()->count();
                $avgOrderValue = $totalRevenue / $totalOrders;

                // Add sales data to the report
                $report[] = [
                    'user_id' => $user->id,
                    'user_name' => $user->name,
                    'user_email' => $user->email,
                    'total_revenue' => $totalRevenue,
                    'avg_order_value' => $avgOrderValue,
                    'total_orders' => $totalOrders,
                ];
            }
        }

        return $report;
    }
}
