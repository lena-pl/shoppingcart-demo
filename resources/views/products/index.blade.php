@extends('layouts.master')

@section('content')
  <div class="container">
    <h1 class="text-center">Products</h1>
      <ul>
        @foreach($products as $product)
          <div class="col-sm-4 col-md-3 product-preview">
            <p class="text-center">
              <img src="http://placehold.it/230x130/fff/333" alt="Product Photo">
            </p>
            <h3 class="text-center">
              <a href="{{ route('products.show', $product->id) }}">
                {{ $product->name }} — ${{ $product->price }}
              </a>
            </h3>
            <p>{{ substr("$product->description", 0, 100) }}<span>…</span></p>
          </div>
        @endforeach
      </ul>
  </div>
@endsection
