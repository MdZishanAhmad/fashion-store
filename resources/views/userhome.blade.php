<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fashion Store</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        :root {
            --primary-color: #007bff;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background: var(--primary-color);
            color: white;
            padding: 1rem;
            text-align: center;
            animation: fadeInDown 1s ease-out;
        }

        .auth-buttons {
            position: absolute;
            top: 1rem;
            right: 1rem;
        }

        .auth-buttons a {
            color: white;
            margin-left: 1rem;
            text-decoration: none;
            font-weight: bold;
        }

        .section-title {
            text-align: center;
            margin: 2rem 0 1rem;
            font-size: 2rem;
        }

        .slider {
            overflow: hidden;
            white-space: nowrap;
            animation: slide 30s linear infinite;
        }

        .product-card {
            display: inline-block;
            width: 250px;
            margin: 0 10px;
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            background-color: #fff;
            animation: fadeInUp 1.2s ease-out;
        }

        .product-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .product-card .p-3 {
            text-align: center;
        }

        @keyframes slide {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-100%);
            }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .footer {
            background: #222;
            color: #ddd;
            padding: 40px 0;
            margin-top: 40px;
        }

        .footer__widget h6, .footer__about p {
            color: #fff;
        }
    </style>
</head>

<body>
    <header>
        <h1>Welcome to Our Fashion Store</h1>
        <p>Explore the latest in Men's and Women's Fashion</p>
        <div class="auth-buttons">
            <a href="/login">Login</a>
            <a href="/register">Sign Up</a>
        </div>
    </header>

    <div class="section-title">Latest Products</div>
    <div class="slider d-flex">
        @foreach($latestProducts as $product)
        <div class="product-card">
            <img src="{{ asset('storage/' . $product->photo) }}" alt="{{ $product->name }}">
            <div class="p-3">
                <h5>{{ $product->name }}</h5>
                <p>Rs. {{ $product->price }}</p>
            </div>
        </div>
        @endforeach
    </div>

    {{-- {!! view('footer') !!} --}}

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
