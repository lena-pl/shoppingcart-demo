@extends('layouts.master')

@section('content')
  <div class="jumbotron">
    <div class="container">
      <h1>Payment Successful</h1>
    </div>
  </div>
  <div class="container">
    <p>Your purchase of <strong>${{ $order->total_price }}</strong> has been processed.</p>
    <p>Your payment reference is {{ $order->payment_reference }}.</p>
  </div>
@endsection
