<!DOCTYPE html>
<html lang="en">
<head>
    <title>Forgot Password</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/style-preset.css">
    <style>
        .auth-main {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8fafc;
        }
        .auth-form {
            width: 100%;
            max-width: 400px;
            margin: auto;
        }
        @media (max-width: 576px) {
            .auth-form {
                max-width: 95vw;
                padding: 1rem;
            }
            .card {
                margin: 1rem 0;
            }
        }
    </style>
</head>
<body>
    <div class="auth-main">
        <div class="auth-wrapper v3">
            <div class="auth-form">
                <div class="auth-header text-center mb-4">
                    <a href="#"><img src="../assets/images/logo-dark.svg" alt="Logo" style="max-width:120px;"></a>
                </div>
                <div class="card my-4 shadow">
                    <div class="card-body">
                        <h3 class="mb-3 text-center"><b>Forgot Password</b></h3>
                        <p class="text-muted text-center mb-4">Enter your email address and we'll send you a link to reset your password.</p>
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <label class="form-label">Email Address</label>
                                <input type="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       name="email"
                                       placeholder="Enter your email address"
                                       value="{{ old('email') }}"
                                       required autofocus>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="d-grid mt-3">
                                <button type="submit" class="btn btn-primary">Send Reset Link</button>
                            </div>
                        </form>
                        <div class="mt-4 text-center">
                            <a href="{{ route('login') }}" class="text-primary">Back to Login</a>
                        </div>
                    </div>
                </div>
                <div class="auth-footer row text-center">
                    <div class="col my-1">
                        <p class="m-0 small">