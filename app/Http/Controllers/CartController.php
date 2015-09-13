<?php

namespace App\Http\Controllers;

use Input;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Order;
use App\Product;
use Auth;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $order = Auth::user()->cart();
        $products = $order->products;

        return view('cart.index', compact('order', 'products'));
    }

    public function addProduct(Request $request)
    {
        $order = Auth::user()->cart();

        $product_id = $request->input('product_id');
        $product = Product::findOrFail($product_id);

        $order->products()->attach($product->id);
        $order->save();

        return redirect()->route('cart');
    }
}
