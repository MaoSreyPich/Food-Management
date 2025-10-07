<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #000000ff, #6794e2ff);
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .register-container {
      width: 100%;
      max-width: 450px;
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
      border-color: #6a11cb;
      box-shadow: 0 0 0 0.25rem rgba(106, 17, 203, 0.25);
    }
    .btn-primary {
      background: linear-gradient(90deg, #6a11cb, #2575fc);
      border: none;
      border-radius: 10px;
      padding: 12px;
      font-size: 1rem;
      font-weight: 600;
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 15px rgba(37, 117, 252, 0.4);
    }
    .form-check-label a {
      color: #2575fc;
      text-decoration: none;
      font-weight: 600;
      transition: color 0.2s ease;
    }
    .form-check-label a:hover {
      color: #6a11cb;
    }
    .text-center a {
      color: #2575fc;
      font-weight: 600;
      text-decoration: none;
      transition: color 0.2s ease;
    }
    .text-center a:hover {
      color: #6a11cb;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>

  <div class="register-container">
    <h2 class="text-center mb-4">Create Account ✨</h2>
    <form action="{{ route('add') }}" method="POST">
      @csrf
      <!-- Full Name -->
      <div class="mb-3">
        <label for="name" class="form-label fw-semibold">Full Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name" required>
      </div>
      
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

      <!-- Confirm Password -->
      <div class="mb-3">
        <label for="password_confirmation" class="form-label fw-semibold">Confirm Password</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm password" required>
      </div>
      
      <!-- Terms & Conditions -->
      <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" id="terms" required>
        <label class="form-check-label" for="terms">
          I agree to the <a href="#">Terms & Conditions</a>
        </label>
      </div>

      <!-- Submit Button -->
      <div class="d-grid">
        <button type="submit" class="btn btn-primary">Register</button>
      </div>
    </form>

    <p class="text-center mt-4">
      Already have an account? <a href="/">Login</a>
    </p>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
