<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
    rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Local CSS files -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/elegant-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slicknav.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- In your <head> section -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"/>
{{-- resources/views/components/header.blade.php --}}
<meta name="csrf-token" content="{{ csrf_token() }}">

    
    <style>
        body {
            background-color: #fff;
            font-family: 'Nunito Sans', sans-serif;
        }
        .header__logo img {
    max-height: 60px;
    width: auto;
    object-fit: contain;
}
.footer__logo img {
    max-height: 60px;
    width: fit-content;
    object-fit: contain;
    margin-bottom: 15px;
}

.footer__about {
    margin-bottom: 20px;
}
        .header {
            background-color: #fff;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            padding: 15px 0;
        }
        
        .header__nav__option {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        
        .header__nav__option a {
            color: #333;
            transition: all 0.3s ease;
        }
        
        .header__nav__option a:hover {
            color: #007bff;
            transform: translateY(-2px);
        }
        
        .user-dropdown {
            position: relative;
        }
        
        .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #007bff;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        font-weight: bold;
        cursor: pointer;
        border: 2px solid #f8f9fa;
        transition: all 0.3s ease;
    }
    
    .user-avatar:hover {
        border-color: #007bff;
        transform: scale(1.05);
        background-color: #0056b3;
    }
        
        .dropdown-menu-custom {
            position: absolute;
            right: 0;
            left: auto;
            min-width: 220px;
            padding: 10px 0;
            margin: 10px 0 0;
            border: none;
            border-radius: 8px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            display: none;
            background-color: #fff;
        }
        
        .dropdown-menu-custom.show {
            display: block;
            animation: fadeIn 0.3s ease;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .dropdown-header {
            padding: 10px 15px;
            font-weight: 600;
            color: #333;
            border-bottom: 1px solid #f1f1f1;
            display: flex;
            align-items: center;
        }
        
        .dropdown-header i {
            margin-right: 10px;
            color: #007bff;
        }
        
        .dropdown-item {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            color: #555;
            transition: all 0.2s ease;
            text-decoration: none;
        }
        
        .dropdown-item i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
            color: #666;
        }
        
        .dropdown-item:hover {
            background-color: #f8f9fa;
            color: #007bff;
        }
        
        .dropdown-item:hover i {
            color: #007bff;
        }
        
        .dropdown-divider {
            height: 1px;
            margin: 5px 0;
            background-color: #f1f1f1;
        }
        
        .logout-btn {
            background: none;
            border: none;
            width: 100%;
            text-align: left;
            padding: 10px 15px;
            color: #555;
        }
        
        .logout-btn:hover {
            color: #dc3545;
        }
        
        .logout-btn i {
            color: #dc3545;
        }
        
        /* Responsive adjustments */
        @media (max-width: 991px) {
            .header__nav__option {
                gap: 15px;
            }
            
            .user-avatar {
                width: 35px;
                height: 35px;
            }
        }
        
        @media (max-width: 767px) {
            .dropdown-menu-custom {
                position: fixed;
                right: 20px;
                left: auto;
                width: 90%;
                max-width: 280px;
            }
        }
    </style>

    <script>
        // Enhanced dropdown functionality
        document.addEventListener('DOMContentLoaded', function() {
            const userDropdown = document.getElementById('userDropdown');
            const dropdownMenu = document.getElementById('dropdownMenu');
            
            // Toggle dropdown on avatar click
            userDropdown.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                dropdownMenu.classList.toggle('show');
            });
            
            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.user-dropdown')) {
                    dropdownMenu.classList.remove('show');
                }
            });
            
            // Close dropdown on escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    dropdownMenu.classList.remove('show');
                }
            });
            
            // Close dropdown when clicking on a dropdown item (except logout)
            document.querySelectorAll('.dropdown-item:not(.logout-btn)').forEach(item => {
                item.addEventListener('click', function() {
                    dropdownMenu.classList.remove('show');
                });
            });
        });
    </script> 
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
</head>
<!-- Before </body> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
    <header class="header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-3">
                    <div class="header__logo">
                        <a href="{{route('user.index')}}"><img src="{{ asset('img/logo.png') }}" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li class="active"><a href="{{route('user.index')}}">Home</a></li>
                            <li><a href="{{route('shop')}}">Shop</a></li>
                            <li><a href="{{route('orders.index')}}">Order</a></li>
                            <li><a href="{{route('contact')}}">Contacts</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="header__nav__option">
                        <a href="#" class="search-switch"><i class="fas fa-search"></i></a>
                        {{-- <a href="#"><i class="far fa-heart"></i></a> --}}
                        <a href="{{route('shopping-cart')}}"><i class="fas fa-shopping-cart"></i> </a>
                        
                        <!-- User Dropdown -->
                       
                            
                            <div class="user-dropdown text-center">
                                <div class="user-avatar" id="userDropdown">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                
                                <div class="dropdown-menu-custom text-center" id="dropdownMenu">
                                    <div class="dropdown-header text-center">
                                        <i class="fas fa-user-circle"></i>
                                        {{ Auth::user()->name }}
                                    </div>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{route('user.profile')}}">
                                        <i class="fas fa-user"></i>  Profile
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-cog"></i> Settings
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <form method="Get" action="{{ route('logout') }}">
                                        @csrf
                                        <button class="dropdown-item logout-btn" type="submit">
                                            <i class="fas fa-sign-out-alt"></i> Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                            
                    
                </div>
            </div>
            <div class="canvas__open"><i class="fa fa-bars"></i></div>
        </div>
    </header>
    <div>
    </div>
  <div class="bodycontainer">
    @yield('user-body')
  </div>
 <footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer__about">
                    <div class="footer__logo">
                        <a href="#"><img src="{{ asset('img/logo.png') }}" alt=""></a>
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
                            <button type="submit"><span class="icon_mail_alt"></span></button>
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
                        </script>2020
                        All rights reserved <i class="fa fa-heart-o" aria-hidden="true"></i>
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Footer Section End -->

<!-- Search Begin -->
<div class="search-model">
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="search-close-switch">+</div>
        <form class="search-model-form">
            <input type="text" id="search-input" placeholder="Search here.....">
        </form>
    </div>
</div>
<!-- Search End -->

<!-- Js Plugins -->
<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('js/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('js/jquery.countdown.min.js') }}"></script>
<script src="{{ asset('js/jquery.slicknav.js') }}"></script>
<script src="{{ asset('js/mixitup.min.js') }}"></script>
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
</body>

</html>