<!-- resources/views/products/show.blade.php -->
@extends('components.main')

@section('content')
<div class="container">
    <!-- Product Details -->
    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset($product->image) }}" class="img-fluid" alt="{{ $product->name }}">
        </div>
        <div class="col-md-6">
            <h1>{{ $product->name }}</h1>
            <p class="h4">${{ number_format($product->price, 2) }}</p>
            <p>{{ $product->description }}</p>
        </div>
    </div>

    <!-- Related Products -->
    <h3 class="mt-5">Related Products</h3>
    <div class="row">
        @foreach($relatedProducts as $related)
        <div class="col-md-3 mb-4">
            <div class="card">
                <img src="{{ asset($related->image) }}" class="card-img-top" alt="{{ $related->name }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $related->name }}</h5>
                    <p class="card-text">${{ number_format($related->price, 2) }}</p>
                    <a href="{{ route('products.show', $related) }}" class="btn btn-primary">View Product</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection