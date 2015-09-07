<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Order;
use Auth;

class CartController extends Controller
{
    public function index()
    {
        $order = Order::where('user_id', Auth::user()->id)->firstOrFail();
        $products = $order->products;

        return view('cart.index', compact('order', 'products'));
    }
}
