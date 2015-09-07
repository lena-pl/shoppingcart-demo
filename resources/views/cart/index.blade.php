@extends('layouts.master')

@section('content')
  <div class="container">
    <h1>Shopping Cart</h1>
    <table class="table">
      <thead>
      <tr>
        <th>Product Name</th>
        <th><span class="pull-right">Price</span></th>
        <th><span class="pull-right">Quantity</span></th>
        <th><span class="pull-right">Total</span></th>
      </tr>
      </thead>
      <tbody>
        @foreach($products as $product)
          <tr>
            <td>
              <a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a>
            </td>
            <td><span class="pull-right">${{ number_format($product->price, 2) }}</span></td>
            <td><span class="pull-right">{{ $product->pivot->quantity }}</span></td>
            <td><span class="pull-right">${{ number_format($product->price * $product->pivot->quantity, 2) }}</span></td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
