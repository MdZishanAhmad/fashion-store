<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $product->name }} - Product Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }
        
        .product-container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 30px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            animation: fadeIn 0.8s ease-in-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .product-image {
            position: relative;
            overflow: hidden;
            border-radius: 12px;
            height: 500px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f5f5f5;
            transition: all 0.3s ease;
        }
        
        .product-image:hover {
            transform: scale(1.02);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        
        .product-image img {
            max-height: 100%;
            max-width: 100%;
            object-fit: contain;
            transition: transform 0.5s ease;
        }
        
        .product-image:hover img {
            transform: scale(1.05);
        }
        
        .product-details {
            padding: 0 30px;
        }
        
        .product-title {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 15px;
            color: #2c3e50;
            position: relative;
            display: inline-block;
        }
        
        .product-title::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 60px;
            height: 3px;
            background: linear-gradient(90deg, #3498db, #9b59b6);
            border-radius: 3px;
        }
        
        .product-category {
            display: inline-block;
            background: #e0f7fa;
            color: #00838f;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            margin-bottom: 20px;
        }
        
        .product-price {
            font-size: 2rem;
            font-weight: 700;
            color: #e74c3c;
            margin: 20px 0;
        }
        
        .product-description {
            color: #555;
            line-height: 1.8;
            margin-bottom: 30px;
        }
        
        .quantity-selector {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
        }
        
        .quantity-btn {
            width: 40px;
            height: 40px;
            border: 1px solid #ddd;
            background: #f8f9fa;
            font-size: 1.2rem;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .quantity-btn:hover {
            background: #e9ecef;
        }
        
        .quantity-input {
            width: 70px;
            height: 40px;
            text-align: center;
            border: 1px solid #ddd;
            border-left: none;
            border-right: none;
            font-size: 1.1rem;
        }
        
        .add-to-cart-btn {
            background: linear-gradient(135deg, #3498db, #9b59b6);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .add-to-cart-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(52, 152, 219, 0.4);
        }
        
        .add-to-cart-btn:active {
            transform: translateY(1px);
        }
        
        .stock-info {
            margin-top: 20px;
            font-size: 0.9rem;
        }
        
        .in-stock {
            color: #27ae60;
        }
        
        .out-of-stock {
            color: #e74c3c;
        }
        
        @media (max-width: 768px) {
            .product-container {
                padding: 20px;
                margin: 20px auto;
            }
            
            .product-image {
                height: 350px;
                margin-bottom: 30px;
            }
            
            .product-details {
                padding: 0;
            }
            
            .product-title {
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="product-container">
            <div class="row">
                <!-- Product Image -->
                <div class="col-lg-6">
                    <div class="product-image">
                        <img src="{{ asset($product->photo) }}" alt="{{ $product->name }}" class="img-fluid">
                    </div>
                </div>
                
                <!-- Product Details -->
                <div class="col-lg-6">
                    <div class="product-details">
                        <h1 class="product-title">{{ $product->name }}</h1>
                        <span class="product-category">{{ $product->category }}</span>
                        
                        
                        <div class="product-price">RS {{ number_format($product->price, 2) }}</div>
                        
                        <p class="product-description">{{ $product->description }}</p>
                        
                        <form action="{{ route('addToCart', $product->id) }}" method="POST">
                            @csrf
                            <div class="quantity-selector">
                                <button type="button" class="quantity-btn minus">-</button>
                                <input type="number" name="quantity" class="quantity-input" value="1" min="1" max="{{ $product->quantity }}">
                                <button type="button" class="quantity-btn plus">+</button>
                            </div>
                            
                            <button type="submit" class="add-to-cart-btn" {{ $product->quantity <= 0 ? 'disabled' : '' }}>
                                <i class="fas fa-shopping-cart"></i> Add to Cart
                            </button>
                            
                            <div class="stock-info">
                                @if($product->quantity > 0)
                                    <span class="in-stock"><i class="fas fa-check-circle"></i> In Stock ({{ $product->quantity }} available)</span>
                                @else
                                    <span class="out-of-stock"><i class="fas fa-times-circle"></i> Out of Stock</span>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Quantity selector functionality
        document.querySelector('.minus').addEventListener('click', function() {
            const input = document.querySelector('.quantity-input');
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
            }
        });
        
        document.querySelector('.plus').addEventListener('click', function() {
            const input = document.querySelector('.quantity-input');
            const max = parseInt(input.getAttribute('max'));
            if (parseInt(input.value) < max) {
                input.value = parseInt(input.value) + 1;
            }
        });
        
        // Input validation
        document.querySelector('.quantity-input').addEventListener('change', function() {
            const max = parseInt(this.getAttribute('max'));
            const min = parseInt(this.getAttribute('min'));
            let value = parseInt(this.value);
            
            if (isNaN(value)) value = min;
            if (value < min) value = min;
            if (value > max) value = max;
            
            this.value = value;
        });
    </script>
</body>
</html>