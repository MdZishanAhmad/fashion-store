@extends('components.header')
@section('title', 'Product Details')

@section('user-body')
    <style>
        :root {
            --primary: #2c3e50;
            --secondary: #3498db;
            --accent: #e74c3c;
            --light: #f8f9fa;
            --dark: #343a40;
            --success: #27ae60;
            --warning: #f39c12;
            --info: #17a2b8;
            --border-radius: 8px;
            --box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            color: #333;
            line-height: 1.6;
        }

        .breadcrumb-nav {
            padding: 15px 0;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .breadcrumb {
            background: transparent;
            padding: 0;
            margin: 0;
        }

        .breadcrumb-item a {
            color: var(--secondary);
            text-decoration: none;
            transition: var(--transition);
        }

        .breadcrumb-item a:hover {
            color: var(--primary);
            text-decoration: underline;
        }

        .breadcrumb-item.active {
            color: var(--dark);
        }

        .product-container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 30px;
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .product-image-container {
            position: relative;
            overflow: hidden;
            border-radius: var(--border-radius);
            height: 500px;
            background: #f9f9f9;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
        }

        .product-image-container:hover {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .product-main-image {
            max-height: 100%;
            max-width: 100%;
            object-fit: contain;
            transition: transform 0.5s ease;
        }

        .product-image-container:hover .product-main-image {
            transform: scale(1.03);
        }

        .product-thumbnails {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }

        .thumbnail {
            width: 70px;
            height: 70px;
            border: 2px solid #ddd;
            border-radius: 5px;
            cursor: pointer;
            transition: var(--transition);
            object-fit: cover;
        }

        .thumbnail:hover,
        .thumbnail.active {
            border-color: var(--secondary);
        }

        .product-details {
            padding-left: 30px;
        }

        .product-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 10px;
            color: var(--primary);
            position: relative;
        }

        .product-title::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 60px;
            height: 3px;
            background: linear-gradient(90deg, var(--secondary), var(--accent));
            border-radius: 3px;
        }

        .product-meta {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            gap: 15px;
        }

        .product-rating {
            display: flex;
            align-items: center;
            color: var(--warning);
        }

        .product-rating i {
            margin-right: 5px;
        }

        .product-review-count {
            color: #666;
            font-size: 0.9rem;
        }

        .product-category {
            display: inline-block;
            background: #e0f2fe;
            color: #0369a1;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .product-price-container {
            margin: 25px 0;
        }

        .current-price {
            font-size: 2rem;
            font-weight: 700;
            color: var(--accent);
            margin-right: 10px;
        }

        .original-price {
            font-size: 1.2rem;
            text-decoration: line-through;
            color: #999;
        }

        .discount-badge {
            background-color: var(--accent);
            color: white;
            padding: 3px 10px;
            border-radius: 5px;
            font-size: 0.9rem;
            font-weight: 600;
            margin-left: 10px;
        }

        .product-description {
            color: #555;
            line-height: 1.8;
            margin-bottom: 25px;
        }

        /* Size Selector Styles */
        .size-selector {
            margin: 20px 0;
        }

        .size-option {
            width: 40px;
            /* Reduced from 50px */
            height: 40px;
            /* Reduced from 50px */
            border: 1px solid #ddd;
            /* Thinner border */
            border-radius: 4px;
            /* Changed from circle to slightly rounded */
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition);
            font-weight: 600;
            background: white;
            font-size: 0.85rem;
            /* Smaller font */
        }

        .size-options {
            display: flex;
            gap: 8px;
            /* Reduced gap between sizes */
            flex-wrap: wrap;
            margin-top: 8px;
        }

        /* In the responsive section */
        @media (max-width: 576px) {
            .size-option {
                width: 36px;
                /* Even smaller on mobile */
                height: 36px;
                font-size: 0.8rem;
            }
        }

        .size-option:hover {
            border-color: var(--secondary);
            color: var(--secondary);
        }

        .size-option.selected {
            background-color: var(--secondary);
            color: white;
            border-color: var(--secondary);
        }

        .size-option.unavailable {
            background-color: #f8f9fa;
            color: #ccc;
            cursor: not-allowed;
            text-decoration: line-through;
        }

        .product-actions {
            margin-top: 30px;
        }

        .quantity-selector {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .quantity-btn {
            width: 40px;
            height: 40px;
            border: 1px solid #ddd;
            background: #f8f9fa;
            font-size: 1.1rem;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .quantity-btn:hover {
            background: #e9ecef;
        }

        .quantity-input {
            width: 60px;
            height: 40px;
            text-align: center;
            border: 1px solid #ddd;
            border-left: none;
            border-right: none;
            font-size: 1rem;
            font-weight: 500;
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .btn-primary {
            background-color: var(--secondary);
            border: none;
            padding: 12px 30px;
            border-radius: 50px;
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 10px rgba(52, 152, 219, 0.3);
        }

        .btn-primary:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(52, 152, 219, 0.4);
        }

        .btn-outline {
            background: transparent;
            border: 2px solid var(--secondary);
            padding: 10px 25px;
            border-radius: 50px;
            color: var(--secondary);
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-outline:hover {
            background-color: rgba(52, 152, 219, 0.1);
            transform: translateY(-2px);
        }

        .stock-info {
            margin-top: 20px;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .in-stock {
            color: var(--success);
        }

        .out-of-stock {
            color: var(--accent);
        }

        .delivery-info {
            margin-top: 30px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: var(--border-radius);
        }

        .delivery-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .delivery-item i {
            margin-right: 10px;
            color: var(--secondary);
        }

        /* Product Tabs */
        .product-tabs {
            margin-top: 50px;
        }

        .nav-tabs {
            border-bottom: 2px solid #eee;
        }

        .nav-tabs .nav-link {
            border: none;
            color: #666;
            font-weight: 600;
            padding: 12px 20px;
            margin-right: 5px;
            transition: var(--transition);
        }

        .nav-tabs .nav-link:hover {
            color: var(--secondary);
            background: rgba(52, 152, 219, 0.1);
        }

        .nav-tabs .nav-link.active {
            color: var(--secondary);
            background: transparent;
            border-bottom: 3px solid var(--secondary);
        }

        .tab-content {
            padding: 25px;
            background: white;
            border-radius: 0 0 var(--border-radius) var(--border-radius);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        /* Related Products */
        .section-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 30px;
            position: relative;
            text-align: center;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: linear-gradient(90deg, var(--secondary), var(--accent));
        }

        .related-products {
            margin-top: 60px;
            padding: 40px 0;
            background: #f9f9f9;
            border-radius: var(--border-radius);
        }

        .product-card {
            background: white;
            border-radius: var(--border-radius);
            overflow: hidden;
            transition: var(--transition);
            box-shadow: var(--box-shadow);
            margin-bottom: 25px;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .product-card-image {
            height: 200px;
            overflow: hidden;
            position: relative;
            background: #f9f9f9;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .product-card-image img {
            max-height: 100%;
            max-width: 100%;
            object-fit: contain;
            transition: transform 0.5s ease;
        }

        .product-card:hover .product-card-image img {
            transform: scale(1.05);
        }

        .product-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background: var(--accent);
            color: white;
            padding: 3px 10px;
            border-radius: 3px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .product-card-body {
            padding: 15px;
        }

        .product-card-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 10px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .product-card-price {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--accent);
            margin-bottom: 8px;
        }

        .product-card-rating {
            color: var(--warning);
            font-size: 0.9rem;
            margin-bottom: 10px;
        }

        .product-card-actions {
            display: flex;
            justify-content: space-between;
        }

        .btn-sm {
            padding: 8px 15px;
            font-size: 0.85rem;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .product-image-container {
                height: 400px;
            }
        }

        @media (max-width: 768px) {
            .product-container {
                padding: 20px;
            }

            .product-image-container {
                height: 350px;
                margin-bottom: 20px;
            }

            .product-details {
                padding-left: 0;
            }

            .product-title {
                font-size: 1.6rem;
            }

            .current-price {
                font-size: 1.6rem;
            }

            .action-buttons {
                flex-direction: column;
                gap: 10px;
            }

            .btn-primary,
            .btn-outline {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 576px) {
            .product-image-container {
                height: 280px;
            }

            .product-thumbnails {
                justify-content: center;
            }

            .size-option {
                width: 40px;
                height: 40px;
                font-size: 0.9rem;
            }
        }
    </style>

    <!-- Breadcrumb Navigation -->
    <nav class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a
                        href="{{ route('category', $product->category_id) }}">{{ $product->category->category }}</a></li>
                <li class="breadcrumb-item active">{{ $product->name }}</li>
            </ol>
        </div>
    </nav>

    <!-- Main Product Section -->
    <div class="container">
        <div class="product-container">
            <div class="row">
                <!-- Product Images -->
                <div class="col-lg-6">
                    <div class="product-image-container">
                        <img src="{{ asset($product->photo) }}" alt="{{ $product->name }}" class="product-main-image"
                            id="mainImage">
                    </div>
                    <div class="product-thumbnails">
                        <img src="{{ asset($product->photo) }}" alt="Thumbnail 1" class="thumbnail active"
                            onclick="changeImage(this, '{{ asset($product->photo) }}')">
                        @if ($product->photo2)
                            <img src="{{ asset($product->photo2) }}" alt="Thumbnail 2" class="thumbnail"
                                onclick="changeImage(this, '{{ asset($product->photo2) }}')">
                        @endif
                        @if ($product->photo3)
                            <img src="{{ asset($product->photo3) }}" alt="Thumbnail 3" class="thumbnail"
                                onclick="changeImage(this, '{{ asset($product->photo3) }}')">
                        @endif
                    </div>
                </div>

                <!-- Product Details -->
                <div class="col-lg-6">
                    <div class="product-details">
                        <h1 class="product-title">{{ $product->name }}</h1>

                        <div class="product-meta">

                            <span class="product-category">{{ $product->category->category }}</span>
                        </div>

                        <div class="product-price-container">
                            <span class="current-price">RS {{ number_format($product->price, 2) }}</span>
                            @if ($product->original_price > $product->price)
                                <span class="original-price">RS {{ number_format($product->original_price, 2) }}</span>
                                <span class="discount-badge">Save
                                    {{ number_format(100 - ($product->price / $product->original_price) * 100, 0) }}%</span>
                            @endif
                        </div>

                        <!-- Size Selector -->

                        <div class="size-selector">
                            <h5 style="margin-bottom: 8px; font-size: 1rem;">Select Size</h5>
                            <div class="size-options">
                                <div class="size-option selected" data-size="36">36</div>
                                <div class="size-option" data-size="38">38</div>
                                <div class="size-option" data-size="40">40</div>
                                <div class="size-option" data-size="42">42</div>
                                <div class="size-option" data-size="44">44</div>
                            </div>
                            <input type="hidden" name="size" id="selected-size" value="36">
                        </div>

                        <form action="{{ route('addToCart', $product->id) }}" method="POST" class="product-actions">
                            @csrf
                            <input type="hidden" name="size" id="form-selected-size" value="36">

                            <div class="quantity-selector">
                                <label for="quantity" class="form-label">Quantity:</label>
                                <div class="d-flex align-items-center">
                                    <button type="button" class="quantity-btn minus">-</button>
                                    <input type="number" name="quantity" class="quantity-input" value="1"
                                        min="1" max="{{ $product->quantity }}">
                                    <button type="button" class="quantity-btn plus">+</button>
                                </div>
                            </div>

                            <div class="stock-info">
                                @if ($product->quantity > 0)
                                    <i class="fas fa-check-circle in-stock"></i>
                                    <span class="in-stock">In Stock ({{ $product->quantity }} available)</span>
                                @else
                                    <i class="fas fa-times-circle out-of-stock"></i>
                                    <span class="out-of-stock">Out of Stock</span>
                                @endif
                            </div>

                            <div class="action-buttons mt-4">
                                <button type="submit" class="btn-primary" {{ $product->quantity <= 0 ? 'disabled' : '' }}>
                                    <i class="fas fa-shopping-cart"></i> Add to Cart
                                </button>
                            </div>
                        </form>


                    </div>
                </div>
            </div>

            <!-- Product Tabs -->
            <div class="product-tabs">
                <ul class="nav nav-tabs" id="productTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="description-tab" data-bs-toggle="tab"
                            data-bs-target="#description" type="button" role="tab">Description</button>
                    </li>

                </ul>
                <div class="tab-content" id="productTabsContent">
                    <div class="tab-pane fade show active" id="description" role="tabpanel">
                        <h4>Product Details</h4>
                        <p class="product-description">{{ $product->description }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products Section -->
        <div class="related-products">
            <h2 class="section-title">Related Products</h2>
            <div class="row">
                @foreach ($relatedProducts as $relatedProduct)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="product-card">
                            <div class="product-card-image">
                                <img src="{{ asset($relatedProduct->photo) }}" alt="{{ $relatedProduct->name }}">
                                @if ($relatedProduct->original_price > $relatedProduct->price)
                                    <span class="product-badge">Sale</span>
                                @endif
                            </div>
                            <div class="product-card-body">
                                <h3 class="product-card-title">{{ $relatedProduct->name }}</h3>
                                <div class="product-card-price">
                                    RS {{ number_format($relatedProduct->price, 2) }}
                                    @if ($relatedProduct->original_price > $relatedProduct->price)
                                        <small class="text-muted text-decoration-line-through">RS
                                            {{ number_format($relatedProduct->original_price, 2) }}</small>
                                    @endif
                                </div>
                                <div class="product-card-actions">
                                    <a href="{{ route('product.details', $relatedProduct->id) }}"
                                        class="btn btn-sm btn-outline-primary">View Details</a>
                                    <button class="btn btn-sm btn-primary">Add to Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        // Quantity selector functionality
        document.addEventListener('DOMContentLoaded', function() {
            const minusBtn = document.querySelector('.minus');
            const plusBtn = document.querySelector('.plus');
            const quantityInput = document.querySelector('.quantity-input');

            minusBtn.addEventListener('click', function() {
                let value = parseInt(quantityInput.value);
                if (value > 1) {
                    quantityInput.value = value - 1;
                }
            });

            plusBtn.addEventListener('click', function() {
                let value = parseInt(quantityInput.value);
                let max = parseInt(quantityInput.getAttribute('max'));
                if (value < max) {
                    quantityInput.value = value + 1;
                }
            });

            // Size selector functionality
            const sizeOptions = document.querySelectorAll('.size-option');
            sizeOptions.forEach(option => {
                option.addEventListener('click', function() {
                    if (!this.classList.contains('unavailable')) {
                        // Remove selected class from all options
                        sizeOptions.forEach(opt => opt.classList.remove('selected'));

                        // Add selected class to clicked option
                        this.classList.add('selected');

                        // Update hidden input value
                        const selectedSize = this.getAttribute('data-size');
                        document.getElementById('selected-size').value = selectedSize;
                        document.getElementById('form-selected-size').value = selectedSize;
                    }
                });
            });

            // Change main product image when thumbnail is clicked
            function changeImage(element, newImageSrc) {
                // Update main image
                document.getElementById('mainImage').src = newImageSrc;

                // Update active thumbnail
                document.querySelectorAll('.thumbnail').forEach(thumb => {
                    thumb.classList.remove('active');
                });
                element.classList.add('active');
            }
        });
    </script>
@endsection
