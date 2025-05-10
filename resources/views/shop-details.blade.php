@include('components.header')

<style>
    .product-details-container {
        padding: 30px 0;
    }
    
    .product-gallery {
        position: sticky;
        top: 20px;
        background: #fff;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    
    .main-product-image {
        width: 100%;
        height: 400px;
        object-fit: contain;
        margin-bottom: 15px;
        border: 1px solid #eee;
        border-radius: 5px;
        padding: 10px;
    }
    
    .product-info {
        background: #fff;
        padding: 25px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    
    .product-title {
        font-size: 28px;
        font-weight: 600;
        margin-bottom: 15px;
        color: #333;
    }
    
    .product-price {
        font-size: 24px;
        font-weight: 700;
        color: #e53935;
        margin-bottom: 20px;
    }
    
    .product-old-price {
        text-decoration: line-through;
        color: #999;
        font-size: 18px;
        margin-left: 10px;
    }
    
    .product-description {
        margin-bottom: 25px;
        color: #555;
        line-height: 1.6;
    }
    
    .product-meta {
        margin-bottom: 25px;
    }
    
    .product-meta p {
        margin-bottom: 8px;
        color: #666;
    }
    
    .product-meta strong {
        color: #333;
        width: 120px;
        display: inline-block;
    }
    
    .quantity-selector {
        display: flex;
        align-items: center;
        margin-bottom: 25px;
    }
    
    .quantity-input {
        width: 70px;
        text-align: center;
        margin-right: 15px;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }
    
    .add-to-cart-btn {
        background: #3f51b5;
        color: white;
        border: none;
        padding: 12px 25px;
        border-radius: 4px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .add-to-cart-btn:hover {
        background: #303f9f;
    }
    
    .product-tabs {
        margin-top: 40px;
    }
    
    .nav-tabs .nav-link {
        color: #555;
        font-weight: 600;
        border: none;
        padding: 12px 20px;
    }
    
    .nav-tabs .nav-link.active {
        color: #3f51b5;
        border-bottom: 3px solid #3f51b5;
        background: transparent;
    }
    
    .tab-content {
        padding: 20px;
        border: 1px solid #eee;
        border-top: none;
        border-radius: 0 0 5px 5px;
    }
    
    .related-products-title {
        font-size: 22px;
        font-weight: 600;
        margin: 40px 0 20px;
        text-align: center;
    }
    
    /* Responsive adjustments */
    @media (max-width: 767.98px) {
        .product-gallery {
            position: static;
            margin-bottom: 30px;
        }
        
        .main-product-image {
            height: 300px;
        }
        
        .product-title {
            font-size: 24px;
        }
        
        .product-price {
            font-size: 20px;
        }
    }
</style>

<!-- Product Details Section -->
<section class="product-details-container">
    <div class="container">
        <div class="row">
            <!-- Product Image Gallery -->
            <div class="col-lg-6">
                <div class="product-gallery">
                    <img src="{{ asset($product->photo) }}" 
                         class="main-product-image" 
                         alt="{{ $product->name }}"
                         id="mainProductImage">
                </div>
            </div>
            
            <!-- Product Information -->
            <div class="col-lg-6">
                <div class="product-info">
                    <h1 class="product-title">{{ $product->name }}</h1>
                    
                    <div class="product-price">
                        ${{ number_format($product->price, 2) }}
                        @if($product->compare_price)
                        <span class="product-old-price">${{ number_format($product->compare_price, 2) }}</span>
                        @endif
                    </div>
                    
                    <div class="product-description">
                        <p>{{ $product->description }}</p>
                    </div>
                    
                    <div class="product-meta">
                        <p><strong>SKU:</strong> {{ $product->sku ?? 'N/A' }}</p>
                        <p><strong>Availability:</strong> 
                            <span style="color: {{ $product->stock > 0 ? '#4CAF50' : '#F44336' }}">
                                {{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}
                            </span>
                        </p>
                        <p><strong>Category:</strong> {{ $product->category->name ?? 'Uncategorized' }}</p>
                    </div>
                    
                    @if($product->stock > 0)
                    <form action="{{ route('addToCart', $product->id) }}" method="POST">
                        @csrf
                        <div class="quantity-selector">
                            <input type="number" 
                                   name="quantity" 
                                   id="quantity" 
                                   class="quantity-input" 
                                   min="1" 
                                   max="{{ $product->stock }}" 
                                   value="1">
                            <button type="submit" class="add-to-cart-btn">
                                <i class="fa fa-shopping-cart"></i> Add to Cart
                            </button>
                        </div>
                    </form>
                    @else
                    <button class="btn btn-secondary" disabled>Out of Stock</button>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Product Tabs -->
        <div class="product-tabs">
            <ul class="nav nav-tabs" id="productTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab">Description</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="details-tab" data-toggle="tab" href="#details" role="tab">Details</a>
                </li>
            </ul>
            
            <div class="tab-content" id="productTabsContent">
                <div class="tab-pane fade show active" id="description" role="tabpanel">
                    {!! $product->long_description ?? '<p>No detailed description available.</p>' !!}
                </div>
                <div class="tab-pane fade" id="details" role="tabpanel">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Product Specifications</h5>
                            <ul class="list-unstyled">
                                <li><strong>Brand:</strong> {{ $product->brand ?? 'N/A' }}</li>
                                <li><strong>Weight:</strong> {{ $product->weight ?? 'N/A' }}</li>
                                <li><strong>Dimensions:</strong> {{ $product->dimensions ?? 'N/A' }}</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h5>Shipping Info</h5>
                            <ul class="list-unstyled">
                                <li>Free shipping on orders over $50</li>
                                <li>Delivery in 3-5 business days</li>
                                <li>30-day return policy</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Products Section -->
@if(isset($relatedProducts) && $relatedProducts->count() > 0)
<section class="related-products">
    <div class="container">
        <h3 class="related-products-title">You May Also Like</h3>
        <div class="row">
            @foreach($relatedProducts as $related)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card product-card">
                    <img src="{{ asset($related->photo) }}" class="card-img-top" alt="{{ $related->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $related->name }}</h5>
                        <p class="card-text">${{ number_format($related->price, 2) }}</p>
                        <a href="{{ route('product.details', $related->id) }}" class="btn btn-outline-primary btn-sm">View Details</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@include('components.footer')