@extends('components.header')
@section('title', 'fsm-shop page')

@section('user-body')
<style>
    /* Product Card Styles */
    .product-card {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        height: 100%;
        position: relative;
    }
    
    .product-card:hover {
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        transform: translateY(-5px);
    }
    
    /* Product Image */
    .product-image {
        position: relative;
        overflow: hidden;
        border-radius: 8px 8px 0 0;
        height: 250px;
    }
    
    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .product-card:hover .product-image img {
        transform: scale(1.1);
    }
    
    /* Product Overlay */
    .product-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: all 0.3s ease;
    }
    
    .product-card:hover .product-overlay {
        opacity: 1;
    }
    
    /* Product Actions */
    .product-actions {
        display: flex;
        gap: 10px;
    }
    
    .action-btn {
        width: 40px;
        height: 40px;
        background: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #333;
        text-decoration: none;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }
    
    .action-btn:hover {
        background: #e53935;
        color: #fff;
    }
    
    /* Product Info */
    .product-info {
        padding: 15px;
    }
    
    .product-title {
        margin-bottom: 10px;
        font-size: 1rem;
        font-weight: 600;
    }
    
    .product-title a {
        color: #333;
        text-decoration: none;
        transition: color 0.3s ease;
    }
    
    .product-title a:hover {
        color: #e53935;
    }
    
    /* Product Price */
    .product-price {
        margin-bottom: 10px;
    }
    
    .current-price {
        font-size: 1.1rem;
        font-weight: 700;
        color: #e53935;
    }
    
    .old-price {
        font-size: 0.9rem;
        color: #999;
        text-decoration: line-through;
        margin-left: 8px;
    }
    
    /* Product Rating */
    .product-rating {
        color: #ffc107;
        font-size: 0.9rem;
    }
    
    /* Quick Add to Cart Animation */
    @keyframes addToCart {
        0% { transform: scale(1); }
        50% { transform: scale(1.2); }
        100% { transform: scale(1); }
    }
    
    .adding-to-cart {
        animation: addToCart 0.3s ease;
    }
    
    /* Loading Spinner */
    .loading-spinner {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255,255,255,0.8);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        display: none;
    }
    
    .loading-spinner.active {
        display: flex;
    }
    
    .spinner {
        width: 40px;
        height: 40px;
        border: 4px solid #f3f3f3;
        border-top: 4px solid #e53935;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .product-image {
            height: 200px;
        }
        
        .action-btn {
            width: 35px;
            height: 35px;
        }
    }
    </style>
    <section class="shop spad" style="margin-top: -1rem">
        <div class="container">
            <div class="row">
                <!-- Sidebar -->
                <div class="col-lg-3">
                    <div class="shop__sidebar">
                        <div class="shop__sidebar__search">
                            <form action="{{ route('shop') }}" method="GET">
                                <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <button type="submit"><span class="icon_search"></span></button>
                            </form>
                        </div>
                        <div class="shop__sidebar__accordion">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseOne">Categories</a>
                                    </div>
                                    <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__categories">
                                                <ul>
                                                    @forelse ($categories as $parent)
                                                        <li>
                                                            <a href="{{ route('shop', ['category' => $parent->id]) }}" class="parent-category">
                                                                {{ $parent->category }}
                                                            </a>
                                                            @if ($parent->children->count())
                                                                <ul class="sub-categories">
                                                                    @foreach ($parent->children as $child)
                                                                        <li>
                                                                            <a href="{{ route('shop', ['category' => $child->id]) }}">
                                                                                {{ $child->category }}
                                                                            </a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            @endif
                                                        </li>
                                                    @empty
                                                        <li>No categories found.</li>
                                                    @endforelse
                                                </ul>
                                            </div>
                                        </div>
                                        
                                    </div>

                                </div> <!-- card -->
                            </div> <!-- accordion -->
                        </div>
                    </div>
                </div>

                <!-- Product Grid -->
                <div class="col-lg-9">
                    <div class="shop__product__option">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="shop__product__option__left">
                                    <p>Showing {{ $products->firstItem() ?? 0 }}–{{ $products->lastItem() ?? 0 }} of {{ $products->total() }} results</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="shop__product__option__right">
                                    <p>Sort by Price:</p>
                                    <select name="sort" onchange="this.form.submit()">
                                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                                        <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name: A to Z</option>
                                        <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name: Z to A</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Products -->
                    {{-- <div class="row">
                        @foreach ($products as $product)
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <a href="{{ route('product.details', $product->id) }}">
                                        <div class="product__item__pic"
                                            style="background-image: url('{{ asset($product->photo) }}'); background-size: cover; background-position: center; height: 300px;">
                                            <ul class="product__hover">
                                                {{-- Optionally add wishlist/zoom buttons here --}}
                                            {{-- </ul>
                                        </div>
                                    </a>
                                    <div class="product__item__text">
                                        <h6>{{ $product->name }}</h6>
                                        <a href="{{ route('shopping-cart') }}" class="add-cart">+ Add To Cart</a>
                                        <div class="rating">
                                            @for ($i = 0; $i < 5; $i++)
                                                <i class="fa fa-star{{ $i < $product->rating ? '' : '-o' }}"></i>
                                            @endfor
                                        </div>
                                        <h5>Rs {{ number_format($product->price, 2) }}</h5>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div> --}} 
                    <!-- Products -->
<!-- Products -->
<div class="row">
    @foreach ($products as $product)
        <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
            <div class="product-card">
                <div class="product-image">
                    <a href="{{ route('product.details', $product->id) }}">
                        <img src="{{ asset($product->photo) }}" alt="{{ $product->name }}" class="img-fluid">
                    </a>
                    <div class="product-overlay">
                        <div class="product-actions">
                            <a href="{{ route('product.details', $product->id) }}" class="action-btn">
                                <i class="fas fa-eye"></i>
                            </a>
                            <form action="{{ route('addToCart', $product->id) }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="action-btn">
                                    <i class="fas fa-shopping-cart"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="product-info">
                    <h5 class="product-title">
                        <a href="{{ route('product.details', $product->id) }}">{{ $product->name }}</a>
                    </h5>
                    <div class="product-price">
                        <span class="current-price">Rs {{ number_format($product->price, 2) }}</span>
                        @if($product->compare_price)
                            <span class="old-price">Rs {{ number_format($product->compare_price, 2) }}</span>
                        @endif
                    </div>
                    <div class="product-rating">
                        @for ($i = 0; $i < 5; $i++)
                            <i class="fas fa-star{{ $i < $product->rating ? '' : '-o' }}"></i>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

                    <!-- Pagination -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="product__pagination">
                                {{ $products->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add to cart functionality
            const addToCartForms = document.querySelectorAll('.add-to-cart-form');
            
            addToCartForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const button = this.querySelector('button');
                    button.classList.add('adding-to-cart');
                    
                    // Show loading spinner
                    const spinner = document.querySelector('.loading-spinner');
                    if (spinner) spinner.classList.add('active');
                    
                    // Submit form
                    fetch(this.action, {
                        method: 'POST',
                        body: new FormData(this),
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Remove loading state
                        button.classList.remove('adding-to-cart');
                        if (spinner) spinner.classList.remove('active');
                        
                        // Show success message
                        if (data.success) {
                            // You can add a toast notification here
                            alert('Product added to cart successfully!');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        button.classList.remove('adding-to-cart');
                        if (spinner) spinner.classList.remove('active');
                        alert('Error adding product to cart. Please try again.');
                    });
                });
            });
        });
        </script>
@endsection
