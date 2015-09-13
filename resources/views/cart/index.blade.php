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
      </tbody>
    </table>
    <button class="btn btn-primary pull-right">Update Quantities</button>
    {!! Form::close() !!}
  </div>
@endsection
