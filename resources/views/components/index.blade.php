<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trendy Threads | Premium Fashion Store</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        :root {
            --primary: #ff4e5b;
            --secondary: #2b2d42;
            --light: #f8f9fa;
            --dark: #212529;
            --transition: all 0.3s ease;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #fef6f6;
            overflow-x: hidden;
        }

        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 1.8rem;
            color: var(--secondary);
        }

        .hero {
            min-height: 100vh;
            background: linear-gradient(rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.7)), 
                        url('https://images.unsplash.com/photo-1489987707025-afc232f7ea0f?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80') no-repeat center center/cover;
            display: flex;
            align-items: center;
            position: relative;
        }

        .hero-content {
            max-width: 600px;
        }

        .hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: 3.5rem;
            font-weight: 700;
            color: var(--secondary);
            animation: fadeInUp 1s ease forwards;
        }

        .hero p {
            font-size: 1.2rem;
            color: #555;
            animation: fadeInUp 1s ease forwards 0.3s;
        }

        .btn-custom {
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            transition: var(--transition);
        }

        .btn-primary-custom {
            background-color: var(--primary);
            border: none;
        }

        .btn-primary-custom:hover {
            background-color: #e03e4a;
            transform: translateY(-3px);
        }

        .btn-outline-custom {
            border: 2px solid var(--secondary);
            color: var(--secondary);
        }

        .btn-outline-custom:hover {
            background-color: var(--secondary);
            color: white;
            transform: translateY(-3px);
        }

        /* Floating Animation for Products */
        .floating {
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
        }

        /* Features Section */
        .feature-card {
            border: none;
            border-radius: 10px;
            overflow: hidden;
            transition: var(--transition);
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        /* Testimonials */
        .testimonial-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        /* Footer */
        .footer {
            background-color: var(--secondary);
            color: white;
        }

        /* Animations */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .hero h1 { font-size: 2.5rem; }
            .hero p { font-size: 1rem; }
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">Trendy Threads</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#products">Products</a></li>
                    <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
                    <li class="nav-item"><a class="nav-link" href="#testimonials">Reviews</a></li>
                </ul>
                <div class="ms-lg-3 mt-3 mt-lg-0">
                    <a href="#login" class="btn btn-outline-dark btn-sm me-2">Login</a>
                    <a href="#signup" class="btn btn-dark btn-sm">Sign Up</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero py-5" id="home">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="hero-content">
                        <h1 class="mb-4">Elevate Your Style with Premium Fashion</h1>
                        <p class="mb-4">Discover the latest trends in clothing, designed for comfort and elegance. Shop now and get <strong>30% off</strong> on your first order!</p>
                        <div class="d-flex gap-3">
                            <a href="#shop" class="btn btn-primary-custom btn-custom">Shop Now</a>
                            <a href="#sale" class="btn btn-outline-custom btn-custom">Summer Sale</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <img src="https://images.unsplash.com/photo-1542272604-787c3835535d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1026&q=80" 
                         alt="Fashion Model" 
                         class="img-fluid floating rounded shadow">
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5 bg-white" id="features">
        <div class="container">
            <div class="text-center mb-5">
                <h2>Why Choose Us?</h2>
                <p class="text-muted">We offer the best in fashion and comfort</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card card h-100 p-4 text-center">
                        <i class="fas fa-tshirt fa-3x mb-3 text-primary"></i>
                        <h4>Premium Quality</h4>
                        <p class="text-muted">Our fabrics are sourced from the best suppliers for maximum comfort.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card card h-100 p-4 text-center">
                        <i class="fas fa-truck fa-3x mb-3 text-primary"></i>
                        <h4>Fast Delivery</h4>
                        <p class="text-muted">Get your order delivered within 2-3 business days.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card card h-100 p-4 text-center">
                        <i class="fas fa-exchange-alt fa-3x mb-3 text-primary"></i>
                        <h4>Easy Returns</h4>
                        <p class="text-muted">Not satisfied? Return within 30 days for a full refund.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section class="py-5 bg-light" id="products">
        <div class="container">
            <div class="text-center mb-5">
                <h2>Trending Now</h2>
                <p class="text-muted">Check out our latest collection</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card product-card h-100">
                        <img src="https://images.unsplash.com/photo-1529374255404-311a2a4f1fd9?ixlib=rb-4.0.3&auto=format&fit=crop&w=776&q=80" 
                             class="card-img-top" 
                             alt="Men's Jacket">
                        <div class="card-body">
                            <h5 class="card-title">Men's Premium Jacket</h5>
                            <p class="card-text text-muted">Waterproof and stylish for all seasons.</p>
                            <p class="h5 text-primary">$89.99</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card product-card h-100">
                        <img src="https://images.unsplash.com/photo-1591047139829-d91aecb6caea?ixlib=rb-4.0.3&auto=format&fit=crop&w=736&q=80" 
                             class="card-img-top" 
                             alt="Women's Dress">
                        <div class="card-body">
                            <h5 class="card-title">Elegant Women's Dress</h5>
                            <p class="card-text text-muted">Perfect for parties and formal occasions.</p>
                            <p class="h5 text-primary">$59.99</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card product-card h-100">
                        <img src="https://images.unsplash.com/photo-1542272604-787c3835535d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1026&q=80" 
                             class="card-img-top" 
                             alt="Casual T-Shirt">
                        <div class="card-body">
                            <h5 class="card-title">Unisex Casual Tee</h5>
                            <p class="card-text text-muted">Soft cotton for everyday comfort.</p>
                            <p class="h5 text-primary">$29.99</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="#shop-all" class="btn btn-primary btn-lg">View All Products</a>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-5" id="testimonials">
        <div class="container">
            <div class="text-center mb-5">
                <h2>What Our Customers Say</h2>
                <p class="text-muted">Real reviews from happy shoppers</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://randomuser.me/api/portraits/women/32.jpg" 
                                 class="rounded-circle me-3" 
                                 width="60" 
                                 alt="Customer">
                            <div>
                                <h5 class="mb-0">Sarah Johnson</h5>
                                <div class="text-warning">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <p>"The dress I bought fits perfectly and looks even better in person. Highly recommend!"</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://randomuser.me/api/portraits/men/75.jpg" 
                                 class="rounded-circle me-3" 
                                 width="60" 
                                 alt="Customer">
                            <div>
                                <h5 class="mb-0">Michael Chen</h5>
                                <div class="text-warning">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                            </div>
                        </div>
                        <p>"Fast shipping and great quality. Will definitely shop here again."</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://randomuser.me/api/portraits/women/63.jpg" 
                                 class="rounded-circle me-3" 
                                 width="60" 
                                 alt="Customer">
                            <div>
                                <h5 class="mb-0">Emma Davis</h5>
                                <div class="text-warning">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <p>"Love the designs! The fabric is so comfortable. 10/10!"</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-5 bg-primary text-white">
        <div class="container text-center">
            <h2 class="mb-4">Ready to Upgrade Your Wardrobe?</h2>
            <p class="mb-4">Join thousands of happy customers and get exclusive deals.</p>
            <a href="#signup" class="btn btn-light btn-lg me-2">Sign Up Now</a>
            <a href="#shop" class="btn btn-outline-light btn-lg">Shop Now</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <h5 class="mb-3">Trendy Threads</h5>
                    <p>Premium fashion for everyone. Quality, comfort, and style in one place.</p>
                    <div class="social-icons mt-3">
                        <a href="#" class="text-white me-2"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white me-2"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white me-2"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-pinterest"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
                    <h5>Shop</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">Men</a></li>
                        <li><a href="#" class="text-white">Women</a></li>
                        <li><a href="#" class="text-white">Kids</a></li>
                        <li><a href="#" class="text-white">Accessories</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
                    <h5>Help</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">FAQs</a></li>
                        <li><a href="#" class="text-white">Shipping</a></li>
                        <li><a href="#" class="text-white">Returns</a></li>
                        <li><a href="#" class="text-white">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h5>Newsletter</h5>
                    <p>Subscribe for updates and exclusive offers.</p>
                    <form class="mt-3">
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Your Email">
                            <button class="btn btn-light" type="submit">Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>
            <hr class="my-4 bg-light">
            <div class="text-center">
                <p class="mb-0">&copy; 2023 Trendy Threads. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS & Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS for Animations -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Smooth scroll for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    document.querySelector(this.getAttribute('href')).scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });

            // Animate elements on scroll
            const animateOnScroll = () => {
                const elements = document.querySelectorAll('.feature-card, .product-card, .testimonial-card');
                elements.forEach(element => {
                    const elementPosition = element.getBoundingClientRect().top;
                    const windowHeight = window.innerHeight;
                    
                    if (elementPosition < windowHeight - 100) {
                        element.style.opacity = '1';
                        element.style.transform = 'translateY(0)';
                    }
                });
            };

            window.addEventListener('scroll', animateOnScroll);
            animateOnScroll(); // Run once on load
        });
    </script>
</body>
</html>