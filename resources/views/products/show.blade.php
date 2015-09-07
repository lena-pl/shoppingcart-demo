@extends('layouts.master')

@section('content')
  <div class="container">
    <ol class="breadcrumb">
      <li><a href="{{ route('home') }}">Home</a></li>
      <li><a href="{{ route('products.index') }}">Products</a></li>
      <li class="active">{{ $product->name }}</li>
    </ol>

    <div class="col-md-6">
      <img src="http://placehold.it/500x350" alt="Product Photo">
    </div>
    <div class="col-md-6 product-desc">
      <h1>{{ $product->name }}</h1>
      <p class="lead">${{ $product->price }}</p>
      <p>{{ $product->description }}</p>
      @if(Auth::check())
        <a class="btn btn-success" href="{{ route('cart') }}"><span class="glyphicon glyphicon-shopping-cart"></span> Add to Cart</a>
      @else
        <p class="lead">Please <a href="{{ route('auth.login') }}">log in</a> to purchase this product.</p>
      @endif
    </div>
  </div>
@endsection
