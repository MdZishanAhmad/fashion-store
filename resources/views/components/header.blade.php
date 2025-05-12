<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FSM</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
    rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    
    <style>
        body {
            background-color: #fff;
            font-family: 'Nunito Sans', sans-serif;
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
            object-fit: cover;
            cursor: pointer;
            border: 2px solid #f8f9fa;
            transition: all 0.3s ease;
        }
        
        .user-avatar:hover {
            border-color: #007bff;
            transform: scale(1.05);
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
</head>

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
                        <a href="./index.html"><img src="img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li class="active"><a href="{{route('user.index')}}">Home</a></li>
                            <li><a href="{{route('shop')}}">Shop</a></li>
                            <li><a href="#">Pages</a>
                                <ul class="dropdown">
                                    <li><a href="{{route('shopping-cart')}}">Shopping Cart</a></li>
                                    <li><a href="{{route('checkout')}}">Check Out</a></li>
                                </ul>
                            </li>
                            {{-- <li><a href="./blog.html">Blog</a></li> --}}
                            <li><a href="{{route('contact')}}">Contacts</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="header__nav__option">
                        <a href="#" class="search-switch"><i class="fas fa-search"></i></a>
                        <a href="#"><i class="far fa-heart"></i></a>
                        <a href="#"><i class="fas fa-shopping-cart"></i> <span>0</span></a>
                        
                        <!-- User Dropdown -->
                        <div class="user-dropdown text-center">
                            <img src="{{ asset('img/zihsan.png') }}" alt="User" class="user-avatar" id="userDropdown">
                            
                            <div class="dropdown-menu-custom text-center" id="dropdownMenu">
                                <div class="dropdown-header text-center">
                                    <i class="fas fa-user-circle"></i>
                                    {{ Auth::user()->name }}
                                    {{ Auth::user()->id }}
                                </div>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user-edit"></i> Edit Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cog"></i> Settings
                                </a>
                                <div class="dropdown-divider"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item logout-btn" type="submit">
                                        <i class="fas fa-sign-out-alt"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="canvas__open"><i class="fa fa-bars"></i></div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    
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