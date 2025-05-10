@extends('user.layouts.main')
@section('content')
<!-- Carousel Section -->
<div id="carouselExampleIndicators" class="carousel slide">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{asset('assets/images/slider/aaa.jpg')}}" class="d-block w-100" alt="..." style="height: 300px; object-fit: cover;">
        </div>
        <div class="carousel-item">
            <img src="{{asset('assets/images/slider/img-slide-1.jpg')}}" class="d-block w-100" alt="..." style="height: 500px; object-fit: cover;">
        </div>
        <div class="carousel-item">
            <img src="{{asset('assets/images/slider/img-slide-1.jpg')}}" class="d-block w-100" alt="..." style="height: 500px; object-fit: cover;">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<!-- Product Section -->
<section class="my-5">
    <div class="container">
        <h2 class="text-center mb-4">Featured Products</h2>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <img src="{{asset('assets/images/slider/img-slide-1.jpg')}}" class="card-img-top" alt="..." style="height: 150px; object-fit: cover;">
                    <div class="card-body text-center">
                        <h5 class="card-title">Kurta</h5>
                        <h3 class="card-price text-danger">RS 2000</h3>
                        <p class="card-text">One of the best quality.</p>
                        <a href="#" class="btn btn-primary w-100">Add to Cart</a>
                    </div>
                </div>
            </div>   
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <img src="{{asset('assets/images/slider/img-slide-1.jpg')}}" class="card-img-top" alt="..." style="height: 200px; object-fit: cover;">
                    <div class="card-body text-center">
                        <h5 class="card-title">Kurta</h5>
                        <h3 class="card-price text-danger">RS 2000</h3>
                        <p class="card-text">One of the best quality.</p>
                        <a href="#" class="btn btn-primary w-100">Add to Cart</a>
                    </div>
                </div>
            </div>   
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <img src="{{asset('assets/images/slider/img-slide-1.jpg')}}" class="card-img-top" alt="..." style="height: 200px; object-fit: cover;">
                    <div class="card-body text-center">
                        <h5 class="card-title">Kurta</h5>
                        <h3 class="card-price text-danger">RS 2000</h3>
                        <p class="card-text">One of the best quality.</p>
                        <a href="#" class="btn btn-primary w-100">Add to Cart</a>
                    </div>
                </div>
            </div>   
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <img src="{{asset('assets/images/slider/img-slide-1.jpg')}}" class="card-img-top" alt="..." style="height: 200px; object-fit: cover;">
                    <div class="card-body text-center">
                        <h5 class="card-title">Kurta</h5>
                        <h3 class="card-price text-danger">RS 2000</h3>
                        <p class="card-text">One of the best quality.</p>
                        <a href="#" class="btn btn-primary w-100">Add to Cart</a>
                    </div>
                </div>
            </div>   
        </div>
    </div>
</section>
@endsection