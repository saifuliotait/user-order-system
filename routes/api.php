<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('users', [UserController::class, 'users']);
Route::get('user-orders/{id}', [UserController::class, 'getOrders']);
Route::get('total-revenue', [OrderController::class, 'totalRevenue']);
Route::get('generate-report', [OrderController::class, 'generateReport']);
