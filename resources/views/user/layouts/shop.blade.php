@extends('user.layouts.main')

@section('content')

    <!-- Product Section -->
    <section class="my-5">
        <div class="container">
            <div class="row d-flex flex-wrap justify-content-center">
                @if (isset($cat))
                    
                <h1>{{ Str::upper($cat)}}</h1>
                @else
                <h1>Available Products</h1>

                @endif

                @if ($products->isNotEmpty())
                   



                    @foreach ($products as $product)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card custom-card"> 
                                <div class="card-body text-center">
                                    <!-- Image -->
                                    <div class="card-img-top img-fluid mx-auto">
                                        <img src="{{ asset('storage/' . $product->photo) }}" class="img-fluid"
                                            alt="{{ $product->name }}">
                                    </div>

                                    <!-- Product Details -->
                                    <h5 class="card-title mt-3">{{ $product->name }}</h5>
                                    <h3 class="card-price">RS {{ number_format($product->price, 2) }}</h3>
                                    <h5 class="card-text">Qty: {{ $product->quantity }}</h5>
                                    <h5 class="card-text">Category: {{ $product->category }}</h5>

                                    <!-- View Details Button -->
                                    <a href="{{ route('products.details', $product->id) }}" class="btn btn-outline-primary">
                                        <i class="fa fa-shopping-cart"></i> View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12 text-center">
                        <h4>No products available.</h4>
                    </div>
                @endif
            </div>
        </div>
    </section>

@endsection
