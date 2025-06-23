<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuoteStack - Your Personal Quote Collection</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
                        url('https://source.unsplash.com/1600x900/?library,books') no-repeat center center;
            background-size: cover;
            color: white;
            padding: 100px 0;
        }
        .feature-card {
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            height: 100%;
            transition: transform 0.3s;
        }
        .feature-card:hover {
            transform: translateY(-5px);
        }
        .footer {
            background: #333;
            color: white;
            padding: 40px 0;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="fas fa-quote-right mr-2"></i>QuoteStack
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Features</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-link nav-link border-0 bg-transparent">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container text-center">
            <h1 class="display-4 mb-4">Welcome to QuoteStack</h1>
            <p class="lead mb-5">Your personal space to collect, organize, and share inspiring quotes</p>
            @auth
                <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg mr-3">
                    <i class="fas fa-columns mr-2"></i>Go to Dashboard
                </a>
            @else
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg mr-3">
                    <i class="fas fa-user-plus mr-2"></i>Get Started
                </a>
                <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg">
                    <i class="fas fa-sign-in-alt mr-2"></i>Login
                </a>
            @endauth
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Why Choose QuoteStack?</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="feature-card text-center">
                        <i class="fas fa-layer-group fa-3x mb-3 text-primary"></i>
                        <h3>Organize Collections</h3>
                        <p>Create personalized collections of your favorite quotes and organize them with tags.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="feature-card text-center">
                        <i class="fas fa-share-alt fa-3x mb-3 text-primary"></i>
                        <h3>Share Insights</h3>
                        <p>Share your favorite quotes with friends and discover quotes from others.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="feature-card text-center">
                        <i class="fas fa-mobile-alt fa-3x mb-3 text-primary"></i>
                        <h3>Access Anywhere</h3>
                        <p>Access your quote collection from any device, anytime, anywhere.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5><i class="fas fa-quote-right mr-2"></i>QuoteStack</h5>
                    <p>Your personal quote collection and management platform.</p>
                </div>
                <div class="col-md-6 text-md-right">
                    <ul class="list-inline">
                        <li class="list-inline-item"><a href="#" class="text-white">About</a></li>
                        <li class="list-inline-item"><a href="#" class="text-white">Privacy</a></li>
                        <li class="list-inline-item"><a href="#" class="text-white">Terms</a></li>
                        <li class="list-inline-item"><a href="#" class="text-white">Contact</a></li>
                    </ul>
                </div>
            </div>
            <hr class="bg-light">
            <div class="text-center">
                <p class="mb-0">&copy; {{ date('Y') }} QuoteStack. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
