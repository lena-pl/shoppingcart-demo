@extends('layouts.master')

@section('content')
  <div class="container">
    <h1>Shopping Cart</h1>

    {!! Form::open(['route' => 'cart.update']) !!}
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
        @forelse($products as $product)
          <tr>
            <td>
              <a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a>
                {{--
                {!! Form::open(['route' => 'cart.remove', 'class' => 'form-inline', 'style' => 'display: inline-block;']) !!}
                  {!! Form::hidden('product_id', $product->id) !!}
                  <button class="btn btn-link text-danger"><span class="glyphicon glyphicon-remove"></span>
                    Remove
                  </button>
                {!! Form::close() !!}
                --}}
            </td>
            <td><span class="pull-right">${{ number_format($product->price, 2) }}</span></td>
            <td><span class="pull-right">
              {!! Form::number('quantity[' . $product->id . ']', $product->pivot->quantity, ['class' => 'text-right', 'style' => 'width: 50px']) !!}
            </span></td>
            <td><span class="pull-right">${{ number_format($product->price * $product->pivot->quantity, 2) }}</span></td>
          </tr>
        @empty
          <tr>
            <td colspan="4" class="text-center text-muted">Your cart is empty.</td>
          </tr>
        @endforelse
          <tr>
            <td colspan="3"><span class="pull-right"><strong>Subtotal</strong></span></td>
            <td><span class="pull-right"><strong>${{ number_format($order->subtotal(), 2) }}</strong></span></td>
          </tr>
      </tbody>
    </table>
    <div class="row">
      <button class="btn btn-primary pull-right"><span class="glyphicon glyphicon-refresh"></span> Update Quantities</button>
    </div>
    {!! Form::close() !!}

    <div class="row">
      {!! Form::open(['route' => 'pxpay.purchase']) !!}
        <button class="btn btn-success pull-right"><span class="glyphicon glyphicon-shopping-cart"></span> Proceed to Payment</button>
      {!! Form::close() !!}
    </div>
  </div>
@endsection
