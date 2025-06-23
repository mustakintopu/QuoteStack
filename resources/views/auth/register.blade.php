<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - QuoteStack</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>
    body {
      background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
      min-height: 100vh;
      display: flex;
      align-items: center;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      color: #333;
      padding: 2rem 0;
    }
    .register-card {
      background: white;
      border-radius: 15px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      padding: 2rem;
      width: 100%;
      max-width: 480px;
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
    .logo-section h2 {
      font-weight: 700;
      color: #2c3e50;
      margin-bottom: 0.5rem;
    }
    .logo-section p {
      color: #6c757d;
      font-size: 0.95rem;
    }
    .form-control {
      border-radius: 8px;
      padding: 0.75rem 1rem;
      border: 1px solid #ddd;
      font-size: 0.95rem;
    }
    .form-control:focus {
      box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
      border-color: #80bdff;
    }
    .input-group-text {
      background: transparent;
      border-right: none;
      padding-right: 0;
    }
    .form-control.with-icon {
      border-left: none;
      padding-left: 0;
    }
    .btn-register {
      border-radius: 8px;
      padding: 0.75rem 1.5rem;
      font-weight: 600;
      width: 100%;
      background: #007bff;
      border: none;
      transition: all 0.3s ease;
    }
    .btn-register:hover {
      background: #0056b3;
      transform: translateY(-1px);
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
    .form-label {
      font-weight: 500;
      color: #495057;
      margin-bottom: 0.5rem;
    }
    .home-link {
      display: block;
      text-align: center;
      margin-top: 1.5rem;
      color: #6c757d;
      text-decoration: none;
      transition: color 0.3s ease;
    }
    .home-link:hover {
      color: #007bff;
    }
    .alert {
      border-radius: 8px;
      font-size: 0.9rem;
    }
    .alert-danger {
      background-color: #fff5f5;
      border-color: #ffd7d7;
      color: #dc3545;
    }
    .password-strength {
      font-size: 0.8rem;
      margin-top: 0.5rem;
      color: #6c757d;
    }
    .form-floating {
      position: relative;
    }
  </style>
</head>
<body>
  <div class="register-card">
    <div class="logo-section">
      <i class="fas fa-quote-right"></i>
      <h2>Join QuoteStack</h2>
      <p>Create your account and start sharing your favorite quotes</p>
    </div>

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

    <form method="POST" action="{{ route('register') }}">
      @csrf
      <div class="mb-3">
        <div class="input-group">
          <span class="input-group-text"><i class="fas fa-user"></i></span>
          <input name="name" id="name" type="text" class="form-control with-icon" placeholder="Enter your full name" value="{{ old('name') }}" required autocomplete="name" autofocus />
      </div>
      </div>

      <div class="mb-3">
        <div class="input-group">
          <span class="input-group-text"><i class="fas fa-envelope"></i></span>
          <input name="email" id="email" type="email" class="form-control with-icon" placeholder="Enter your email address" value="{{ old('email') }}" required autocomplete="email" />
        </div>
      </div>

      <div class="mb-3">
        <div class="input-group">
          <span class="input-group-text"><i class="fas fa-lock"></i></span>
          <input name="password" id="password" type="password" class="form-control with-icon" placeholder="Choose a password" required autocomplete="new-password" />
        </div>
        <div class="password-strength">
          Password must be at least 8 characters long and include letters and numbers
        </div>
      </div>

      <div class="mb-4">
        <div class="input-group">
          <span class="input-group-text"><i class="fas fa-lock"></i></span>
          <input name="password_confirmation" id="password_confirmation" type="password" class="form-control with-icon" placeholder="Confirm your password" required autocomplete="new-password" />
        </div>
      </div>

      <button type="submit" class="btn btn-primary btn-register">
        <i class="fas fa-user-plus me-2"></i>Create Account
      </button>

      <div class="divider">
        <span class="bg-white px-2">or</span>
      </div>

      <div class="text-center">
        <p class="mb-0">Already have an account?</p>
        <a href="{{ route('login') }}" class="btn btn-outline-primary mt-2">
          <i class="fas fa-sign-in-alt me-2"></i>Sign In
        </a>
      </div>

      <a href="{{ route('home') }}" class="home-link">
        <i class="fas fa-home me-1"></i>Back to Home
      </a>
    </form>
  </div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
