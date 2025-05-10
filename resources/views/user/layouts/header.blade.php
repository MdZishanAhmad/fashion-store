<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fashion Store Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        /* Navbar Styling */
        .navbar {
            background: linear-gradient(135deg, #0a7fd9, #f95f44);
        }

        .navbar-brand {
            font-weight: bold;
            color: white;
            font-size: 1.5rem;
        }

        .navbar-nav .nav-link {
            color: rgb(255, 255, 255);
            font-weight: 500;
            transition: 0.3s;
        }

        .navbar-nav .nav-link:hover {
            color: #ffc107;
        }

        .btn-custom {
            border-radius: 20px;
            padding: 5px 15px;
        }

        .btn-login {
            background-color: #007bff;
            color: white;
        }

        .btn-cart {
            background-color: #ffc107;
            color: black;
        }

        /* Footer Styling */
        footer {
            background-color: #222;
            color: white;
            padding: 10px 0;
            position: fixed;
            width: 100%;
            bottom: 0;
        }

        footer a {
            color: #ffc107;
            margin: 0 9px;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">FSM</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/shop">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle"  role="button" data-bs-toggle="dropdown">
                            Categories
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/shop/men">Men</a></li>
                            <li><a class="dropdown-item" href="/shop/women">Women</a></li>
                            <li><a class="dropdown-item" href="/shop/kids">Kids</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/contact">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/about">About</a>
                    </li>
                </ul>
                <!-- Search Form -->
                <form class="d-flex me-3">
                    <input class="form-control me-2" type="search" placeholder="Search">
                    <button class="btn btn-outline-light" style="width: 100px" type="submit"><i class="fa fa-search"></i></button>
                </form>
                <!-- Login and Cart -->
                <a href="{{route('login')}}" class="btn btn-custom btn-login me-2"><i class="fa fa-user"></i> Login</a>
                <a href="#" class="btn btn-custom btn-cart"><i class="fa fa-shopping-cart"></i> Cart</a>
            </div>
        </div>
    </nav>
    
    
        
    
    

    

    