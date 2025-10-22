<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #fffaf5;
      color: #333;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .register-container {
      width: 100%;
      max-width: 420px;
      padding: 30px;
      background: #fff;
      border-radius: 15px;
      box-shadow: 0 8px 25px rgba(0,0,0,0.15);
      animation: fadeIn 0.8s ease-in-out;
    }
    .register-container h2 {
      font-weight: 700;
      color: #333;
    }
    .form-control {
      border-radius: 10px;
      padding: 12px;
      border: 1px solid #ddd;
      transition: all 0.3s ease;
    }
    .form-control:focus {
       border-color: #ff5900ff;
      box-shadow: 0 0 0 0.25rem #ff5900ff(106, 17, 203, 0.25);
    }
    .btn-primary {
     background: linear-gradient(90deg, #ff5900ff, #ff5900ff);
      border: none;
      border-radius: 10px;
      padding: 12px;
      font-size: 1rem;
      font-weight: 600;
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .btn-primary:hover {
      transform: translateY(-2px);
     box-shadow: 0 6px 15px rgba(255, 120, 18, 0.4);
    }
    .text-center a {
      color: #fc6225ff;
      text-decoration: none;
      font-weight: 600;
      transition: color 0.2s ease;
    }
    .text-center a:hover {
       color: #ff5e00ff;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>

  <div class="register-container">
    <h2 class="text-center mb-4">Welcome Back 👋</h2>
    <form action="{{ route('checkLogin') }}" method="POST">
      @csrf
      <!-- Email -->
      <div class="mb-3">
        <label for="email" class="form-label fw-semibold">Email address</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
      </div>

      <!-- Password -->
      <div class="mb-3">
        <label for="password" class="form-label fw-semibold">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
      </div>

      <!-- Submit Button -->
      <div class="d-grid">
        <button type="submit" class="btn btn-primary">Login</button>
      </div>
    </form>

    <p class="text-center mt-4">
      Don’t have an account? <a href="/register">Register</a>
    </p>
  </div>
@if(session('success'))
  <div class="alert alert-success text-center">
      {{ session('success') }}
  </div>
@endif

@if ($errors->any())
  <div class="alert alert-danger text-center">
      {{ $errors->first() }}
  </div>
@endif

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
