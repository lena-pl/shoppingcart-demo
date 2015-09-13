<?php

namespace App\Http\Controllers;

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

        $existingProduct = $order->products()->where('product_id', $product->id)->first();
        if ($existingProduct) {
            $existingProduct->pivot->quantity += 1;
            $existingProduct->pivot->save();
        } else {
            $quantity = 1;
            $order->products()->attach($product->id, ['quantity' => $quantity]);
        }

        return redirect()->route('cart');
    }

    public function removeProduct(Request $request)
    {
        $order = Auth::user()->cart();

        $product_id = $request->input('product_id');
        $product = Product::findOrFail($product_id);

        $order->products()->detach($product->id);

        return redirect()->route('cart');
    }

    public function updateQuantities(Request $request)
    {
        $quantities = $request->input('quantity');

        $products = [];
        foreach($quantities as $product_id => $quantity) {
            if ($quantity > 0) {
                $products[$product_id] = ['quantity' => $quantity];
            }
        }

        $order = Auth::user()->cart();
        $order->products()->sync($products);

        return redirect()->route('cart');
    }
}
