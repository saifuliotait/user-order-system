<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function users()
    {
        return User::all();
    }

    public function getOrders($userId)
    {
        $user = User::find($userId);

        if ($user) {
            return $user->orders;
        }

        return [];
    }
}
