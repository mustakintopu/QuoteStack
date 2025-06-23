<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - QuoteStack</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .login-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            max-width: 400px;
            width: 100%;
            margin: 0 auto;
        }
        .logo-section {
            text-align: center;
            margin-bottom: 2rem;
        }
        .logo-section i {
            font-size: 2.5rem;
            color: #007bff;
            margin-bottom: 1rem;
        }
        .form-control {
            border-radius: 8px;
            padding: 0.75rem 1rem;
            border: 1px solid #ddd;
        }
        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }
        .btn-login {
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            width: 100%;
        }
        .input-group-text {
            background: transparent;
            border-right: none;
        }
        .form-control.with-icon {
            border-left: none;
        }
        .divider {
            text-align: center;
            margin: 1.5rem 0;
            position: relative;
        }
        .divider::before {
            content: "";
            position: absolute;
            left: 0;
            top: 50%;
            width: 45%;
            height: 1px;
            background: #ddd;
        }
        .divider::after {
            content: "";
            position: absolute;
            right: 0;
            top: 50%;
            width: 45%;
            height: 1px;
            background: #ddd;
        }
        .home-link {
            display: block;
            text-align: center;
            margin-top: 1.5rem;
            color: #6c757d;
            text-decoration: none;
        }
        .home-link:hover {
            color: #007bff;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="login-container">
        <div class="logo-section">
            <i class="fas fa-quote-right"></i>
            <h2 class="mb-4">Welcome Back!</h2>
        </div>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                <input name="email" type="email" class="form-control with-icon" placeholder="Enter your email" value="{{ old('email') }}" required autofocus>
            </div>
        </div>
        <div class="mb-4">
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                <input name="password" type="password" class="form-control with-icon" placeholder="Enter your password" required>
            </div>
        </div>
        <button class="btn btn-primary btn-login mb-3" type="submit">
            <i class="fas fa-sign-in-alt me-2"></i>Sign In
        </button>

        <div class="divider">
            <span class="bg-white px-2">or</span>
        </div>

        <div class="text-center">
            <p class="mb-0">Don't have an account?</p>
            <a href="{{ route('register') }}" class="btn btn-outline-primary mt-2">
                <i class="fas fa-user-plus me-2"></i>Create Account
            </a>
        </div>

        <a href="{{ route('home') }}" class="home-link">
            <i class="fas fa-home me-1"></i>Back to Home
        </a>
    </form>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</div>
</body>
</html>
