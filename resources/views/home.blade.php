<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrendStyle - Fashion Store</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #3498db;
            --primary-dark: #2980b9;
            --secondary-color: #f8f9fa;
            --dark-color: #343a40;
            --light-color: #f8f9fa;
            --text-color: #333;
            --text-light: #777;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text-color);
            overflow-x: hidden;
        }
        
        /* Header Styles */
        .navbar {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 15px 0;
            transition: all 0.3s ease;
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 24px;
            color: var(--primary-color);
        }
        
        .nav-link {
            color: var(--dark-color);
            font-weight: 500;
            margin: 0 10px;
            transition: color 0.3s;
        }
        
        .nav-link:hover {
            color: var(--primary-color);
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 8px 20px;
            border-radius: 30px;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .btn-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
            transform: translateY(-2px);
        }
        
        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 8px 20px;
            border-radius: 30px;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            color: white;
            transform: translateY(-2px);
        }
        
        /* Hero Section */
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://images.unsplash.com/photo-1483985988355-763728e1935b?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            height: 80vh;
            display: flex;
            align-items: center;
            color: white;
            position: relative;
            overflow: hidden;
        }
        
        .hero-content {
            max-width: 600px;
            animation: fadeInUp 1s ease;
        }
        
        .hero-content h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }
        
        .hero-content p {
            font-size: 1.2rem;
            margin-bottom: 30px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Categories Section */
        .categories-section {
            padding: 80px 0;
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 50px;
            position: relative;
        }
        
        .section-title h2 {
            font-weight: 700;
            color: var(--dark-color);
            display: inline-block;
            padding-bottom: 10px;
        }
        
        .section-title h2::after {
            content: '';
            position: absolute;
            width: 70px;
            height: 3px;
            background-color: var(--primary-color);
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
        }
        
        .category-card {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            margin-bottom: 30px;
            position: relative;
        }
        
        .category-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }
        
        .category-img {
            height: 250px;
            overflow: hidden;
        }
        
        .category-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .category-card:hover .category-img img {
            transform: scale(1.1);
        }
        
        .category-info {
            padding: 20px;
            text-align: center;
            background-color: white;
        }
        
        .category-info h3 {
            font-weight: 600;
            margin-bottom: 10px;
        }
        
        .category-info a {
            color: var(--primary-color);
            font-weight: 500;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }
        
        .category-info a i {
            margin-left: 5px;
            transition: transform 0.3s;
        }
        
        .category-info a:hover i {
            transform: translateX(5px);
        }
        
        /* Products Section */
        .products-section {
            padding: 80px 0;
            background-color: var(--secondary-color);
        }
        
        .product-slider {
            position: relative;
            padding: 0 50px;
        }
        
        .product-card {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            margin: 0 15px;
            position: relative;
        }
        
        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }
        
        .product-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: var(--primary-color);
            color: white;
            padding: 5px 10px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 500;
            z-index: 1;
        }
        
        .product-img {
            height: 200px;
            overflow: hidden;
            position: relative;
        }
        
        .product-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .product-card:hover .product-img img {
            transform: scale(1.1);
        }
        
        .product-actions {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            display: flex;
            justify-content: center;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 10px 0;
            transform: translateY(100%);
            transition: transform 0.3s ease;
        }
        
        .product-card:hover .product-actions {
            transform: translateY(0);
        }
        
        .product-actions button {
            background: none;
            border: none;
            color: var(--dark-color);
            font-size: 18px;
            margin: 0 10px;
            cursor: pointer;
            transition: color 0.3s;
        }
        
        .product-actions button:hover {
            color: var(--primary-color);
        }
        
        .product-info {
            padding: 20px;
        }
        
        .product-info h3 {
            font-weight: 600;
            margin-bottom: 5px;
            font-size: 16px;
        }
        
        .product-info p {
            color: var(--text-light);
            font-size: 14px;
            margin-bottom: 10px;
        }
        
        .product-price {
            font-weight: 700;
            color: var(--primary-color);
            font-size: 18px;
        }
        
        .slick-prev, .slick-next {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            z-index: 1;
            transition: all 0.3s;
        }
        
        .slick-prev:hover, .slick-next:hover {
            background-color: var(--primary-color);
            color: white;
        }
        
        .slick-prev {
            left: 0;
        }
        
        .slick-next {
            right: 0;
        }
        
        .slick-prev::before, .slick-next::before {
            color: var(--dark-color);
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
        }
        
        .slick-prev::before {
            content: '\f053';
        }
        
        .slick-next::before {
            content: '\f054';
        }
        
        .slick-prev:hover::before, .slick-next:hover::before {
            color: white;
        }
        
        /* Footer Styles */
        .footer {
            background-color: var(--dark-color);
            color: white;
            padding: 70px 0 0;
        }
        
        .footer__about img {
            max-width: 150px;
            margin-bottom: 20px;
        }
        
        .footer__about p {
            color: #b7b7b7;
            margin-bottom: 30px;
        }
        
        .footer__widget h6 {
            color: white;
            font-weight: 700;
            margin-bottom: 20px;
            font-size: 18px;
        }
        
        .footer__widget ul {
            padding-left: 0;
            list-style: none;
        }
        
        .footer__widget ul li {
            margin-bottom: 12px;
        }
        
        .footer__widget ul li a {
            color: #b7b7b7;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .footer__widget ul li a:hover {
            color: var(--primary-color);
        }
        
        .footer__newslatter p {
            color: #b7b7b7;
            margin-bottom: 20px;
        }
        
        .footer__newslatter form {
            position: relative;
        }
        
        .footer__newslatter input {
            width: 100%;
            padding: 12px 20px;
            border: none;
            border-radius: 30px;
            background-color: #2e2e2e;
            color: white;
        }
        
        .footer__newslatter button {
            position: absolute;
            right: 5px;
            top: 5px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .footer__newslatter button:hover {
            background-color: var(--primary-dark);
        }
        
        .footer__copyright__text {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding: 20px 0;
            margin-top: 40px;
        }
        
        .footer__copyright__text p {
            color: #b7b7b7;
            margin-bottom: 0;
        }
        
        .fa-heart-o {
            color: var(--primary-color);
        }
        
        /* Responsive Styles */
        @media (max-width: 991px) {
            .hero-content h1 {
                font-size: 2.5rem;
            }
            
            .hero-content p {
                font-size: 1rem;
            }
        }
        
        @media (max-width: 767px) {
            .hero-section {
                height: 60vh;
            }
            
            .hero-content h1 {
                font-size: 2rem;
            }
            
            .section-title h2 {
                font-size: 1.8rem;
            }
            
            .footer__about, .footer__widget {
                margin-bottom: 30px;
            }
        }
        
        @media (max-width: 575px) {
            .hero-section {
                height: 50vh;
            }
            
            .hero-content h1 {
                font-size: 1.8rem;
            }
            
            .btn-primary, .btn-outline-primary {
                padding: 6px 15px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">TrendStyle</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Men</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Women</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">New Arrivals</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Sale</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <a href="#" class="btn btn-outline-primary me-2" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#registerModal">Sign Up</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content">
                <h1>Discover Your Perfect Style</h1>
                <p>Explore our latest collection of trendy fashion for men and women. Quality fabrics, perfect fits, and styles that make you stand out.</p>
                <a href="#" class="btn btn-primary me-2">Shop Now</a>
                <a href="#" class="btn btn-outline-light">Explore</a>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="categories-section">
        <div class="container">
            <div class="section-title">
                <h2>Shop By Category</h2>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="category-card">
                        <div class="category-img">
                            <img src="https://images.unsplash.com/photo-1591047139829-d91aecb6caea?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Men's Fashion">
                        </div>
                        <div class="category-info">
                            <h3>Men's Fashion</h3>
                            <a href="#">Shop Now <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="category-card">
                        <div class="category-img">
                            <img src="https://images.unsplash.com/photo-1487412947147-5cebf100ffc2?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Women's Fashion">
                        </div>
                        <div class="category-info">
                            <h3>Women's Fashion</h3>
                            <a href="#">Shop Now <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section class="products-section">
        <div class="container">
            <div class="section-title">
                <h2>Latest Products</h2>
            </div>
            <div class="product-slider">
                <!-- Product 1 -->
                <div class="product-card">
                    <span class="product-badge">New</span>
                    <div class="product-img">
                        <img src="https://images.unsplash.com/photo-1529374255404-311a2a4f1fd9?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="Product 1">
                        <div class="product-actions">
                            <button title="Add to Wishlist"><i class="far fa-heart"></i></button>
                            <button title="Quick View"><i class="far fa-eye"></i></button>
                            <button title="Add to Cart"><i class="fas fa-shopping-cart"></i></button>
                        </div>
                    </div>
                    <div class="product-info">
                        <h3>Men's Slim Fit Shirt</h3>
                        <p>Premium cotton fabric</p>
                        <div class="product-price">$49.99</div>
                    </div>
                </div>
                
                <!-- Product 2 -->
                <div class="product-card">
                    <span class="product-badge">Sale</span>
                    <div class="product-img">
                        <img src="https://images.unsplash.com/photo-1542272604-787c3835535d?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="Product 2">
                        <div class="product-actions">
                            <button title="Add to Wishlist"><i class="far fa-heart"></i></button>
                            <button title="Quick View"><i class="far fa-eye"></i></button>
                            <button title="Add to Cart"><i class="fas fa-shopping-cart"></i></button>
                        </div>
                    </div>
                    <div class="product-info">
                        <h3>Women's Summer Dress</h3>
                        <p>Lightweight and breathable</p>
                        <div class="product-price">$59.99 <span style="text-decoration: line-through; color: var(--text-light); font-size: 14px;">$79.99</span></div>
                    </div>
                </div>
                
                <!-- Product 3 -->
                <div class="product-card">
                    <div class="product-img">
                        <img src="https://images.unsplash.com/photo-1591047139829-d91aecb6caea?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="Product 3">
                        <div class="product-actions">
                            <button title="Add to Wishlist"><i class="far fa-heart"></i></button>
                            <button title="Quick View"><i class="far fa-eye"></i></button>
                            <button title="Add to Cart"><i class="fas fa-shopping-cart"></i></button>
                        </div>
                    </div>
                    <div class="product-info">
                        <h3>Men's Casual Jeans</h3>
                        <p>Stretch denim for comfort</p>
                        <div class="product-price">$39.99</div>
                    </div>
                </div>
                
                <!-- Product 4 -->
                <div class="product-card">
                    <span class="product-badge">New</span>
                    <div class="product-img">
                        <img src="https://images.unsplash.com/photo-1585487000160-6ebcfceb0d03?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="Product 4">
                        <div class="product-actions">
                            <button title="Add to Wishlist"><i class="far fa-heart"></i></button>
                            <button title="Quick View"><i class="far fa-eye"></i></button>
                            <button title="Add to Cart"><i class="fas fa-shopping-cart"></i></button>
                        </div>
                    </div>
                    <div class="product-info">
                        <h3>Women's Blazer</h3>
                        <p>Office and casual wear</p>
                        <div class="product-price">$89.99</div>
                    </div>
                </div>
                
                <!-- Product 5 -->
                <div class="product-card">
                    <div class="product-img">
                        <img src="https://images.unsplash.com/photo-1527719327859-c6ce80353573?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="Product 5">
                        <div class="product-actions">
                            <button title="Add to Wishlist"><i class="far fa-heart"></i></button>
                            <button title="Quick View"><i class="far fa-eye"></i></button>
                            <button title="Add to Cart"><i class="fas fa-shopping-cart"></i></button>
                        </div>
                    </div>
                    <div class="product-info">
                        <h3>Men's Leather Jacket</h3>
                        <p>Genuine leather</p>
                        <div class="product-price">$129.99</div>
                    </div>
                </div>
                
                <!-- Product 6 -->
                <div class="product-card">
                    <span class="product-badge">Hot</span>
                    <div class="product-img">
                        <img src="https://images.unsplash.com/photo-1583743814966-8936f5b7be1a?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="Product 6">
                        <div class="product-actions">
                            <button title="Add to Wishlist"><i class="far fa-heart"></i></button>
                            <button title="Quick View"><i class="far fa-eye"></i></button>
                            <button title="Add to Cart"><i class="fas fa-shopping-cart"></i></button>
                        </div>
                    </div>
                    <div class="product-info">
                        <h3>Women's Handbag</h3>
                        <p>Premium leather</p>
                        <div class="product-price">$79.99</div>
                    </div>
                </div>
                
                <!-- Product 7 -->
                <div class="product-card">
                    <div class="product-img">
                        <img src="https://images.unsplash.com/photo-1595950653106-6c9ebd614d3a?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="Product 7">
                        <div class="product-actions">
                            <button title="Add to Wishlist"><i class="far fa-heart"></i></button>
                            <button title="Quick View"><i class="far fa-eye"></i></button>
                            <button title="Add to Cart"><i class="fas fa-shopping-cart"></i></button>
                        </div>
                    </div>
                    <div class="product-info">
                        <h3>Men's Running Shoes</h3>
                        <p>Lightweight and comfortable</p>
                        <div class="product-price">$69.99</div>
                    </div>
                </div>
                
                <!-- Product 8 -->
                <div class="product-card">
                    <span class="product-badge">New</span>
                    <div class="product-img">
                        <img src="https://images.unsplash.com/photo-1543163521-1bf539c55dd2?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="Product 8">
                        <div class="product-actions">
                            <button title="Add to Wishlist"><i class="far fa-heart"></i></button>
                            <button title="Quick View"><i class="far fa-eye"></i></button>
                            <button title="Add to Cart"><i class="fas fa-shopping-cart"></i></button>
                        </div>
                    </div>
                    <div class="product-info">
                        <h3>Women's Sneakers</h3>
                        <p>Casual and stylish</p>
                        <div class="product-price">$59.99</div>
                    </div>
                </div>
                
                <!-- Product 9 -->
                <div class="product-card">
                    <div class="product-img">
                        <img src="https://images.unsplash.com/photo-1595341595379-cf1638b1c26b?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="Product 9">
                        <div class="product-actions">
                            <button title="Add to Wishlist"><i class="far fa-heart"></i></button>
                            <button title="Quick View"><i class="far fa-eye"></i></button>
                            <button title="Add to Cart"><i class="fas fa-shopping-cart"></i></button>
                        </div>
                    </div>
                    <div class="product-info">
                        <h3>Men's Watch</h3>
                        <p>Stainless steel</p>
                        <div class="product-price">$99.99</div>
                    </div>
                </div>
                
                <!-- Product 10 -->
                <div class="product-card">
                    <span class="product-badge">Sale</span>
                    <div class="product-img">
                        <img src="https://images.unsplash.com/photo-1523170335258-f5ed11844a49?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="Product 10">
                        <div class="product-actions">
                            <button title="Add to Wishlist"><i class="far fa-heart"></i></button>
                            <button title="Quick View"><i class="far fa-eye"></i></button>
                            <button title="Add to Cart"><i class="fas fa-shopping-cart"></i></button>
                        </div>
                    </div>
                    <div class="product-info">
                        <h3>Women's Jewelry Set</h3>
                        <p>Elegant and stylish</p>
                        <div class="product-price">$49.99 <span style="text-decoration: line-through; color: var(--text-light); font-size: 14px;">$69.99</span></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__logo">
                            <a href="#"><img src="https://via.placeholder.com/150x50?text=TrendStyle" alt=""></a>
                        </div>
                        <p>The customer is at the heart of our unique business model, which includes design.</p>
                    </div>
                </div>
                <div class="col-lg-2 offset-lg-1 col-md-3 col-sm-6">
                    <div class="footer__widget">
                        <h6>Shopping</h6>
                        <ul>
                            <li><a href="#">Clothing Store</a></li>
                            <li><a href="#">Trending Clothes</a></li>
                            <li><a href="#">Accessories</a></li>
                            <li><a href="#">Sale</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="footer__widget">
                        <h6>Shopping</h6>
                        <ul>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">Payment Methods</a></li>
                            <li><a href="#">Delivary</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 offset-lg-1 col-md-6 col-sm-6">
                    <div class="footer__widget">
                        <h6>NewLetter</h6>
                        <div class="footer__newslatter">
                            <p>Be the first to know about new arrivals, look books, sales & promos!</p>
                            <form action="#">
                                <input type="text" placeholder="Your email">
                                <button type="submit"><span class="icon_mail_alt"><i class="fas fa-paper-plane"></i></span></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="footer__copyright__text">
                        <p> Zishan Copyright ©
                            <script>
                                document.write(new Date().getFullYear());
                            </script> All rights reserved <i class="fa fa-heart-o" aria-hidden="true"></i>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Login to Your Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="loginEmail" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="loginEmail" required>
                        </div>
                        <div class="mb-3">
                            <label for="loginPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="loginPassword" required>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="rememberMe">
                            <label class="form-check-label" for="rememberMe">Remember me</label>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>
                    <div class="text-center mt-3">
                        <a href="#">Forgot password?</a>
                    </div>
                    <div class="text-center mt-3">
                        Don't have an account? <a href="#" data-bs-toggle="modal" data-bs-target="#registerModal" data-bs-dismiss="modal">Sign up</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Register Modal -->
    <div class="modal fade" id="registerModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create an Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="firstName" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastName" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="registerEmail" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="registerEmail" required>
                        </div>
                        <div class="mb-3">
                            <label for="registerPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="registerPassword" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirmPassword" required>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="agreeTerms" required>
                            <label class="form-check-label" for="agreeTerms">I agree to the <a href="#">Terms and Conditions</a></label>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Register</button>
                    </form>
                    <div class="text-center mt-3">
                        Already have an account? <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script>
        $(document).ready(function(){
            // Initialize product slider
            $('.product-slider').slick({
                dots: true,
                infinite: true,
                speed: 300,
                slidesToShow: 4,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 3000,
                responsive: [
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 576,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
            
            // Smooth scrolling for anchor links
            $('a[href*="#"]').on('click', function(e) {
                e.preventDefault();
                $('html, body').animate(
                    {
                        scrollTop: $($(this).attr('href')).offset().top,
                    },
                    500,
                    'linear'
                );
            });
            
            // Navbar background change on scroll
            $(window).scroll(function() {
                if ($(this).scrollTop() > 50) {
                    $('.navbar').addClass('scrolled');
                } else {
                    $('.navbar').removeClass('scrolled');
                }
            });
        });
    </script>
</body>
</html>