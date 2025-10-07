<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Food Management</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="{{ url('/dashboard') }}">Food System</a>
      <ul class="navbar-nav ms-auto">
       @guest
        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
      @else
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.categories.index') }}">Categories</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.menu.index') }}">Menu</a></li>
        {{-- <li class="nav-item"><a class="nav-link" href="{{ route('cart.index') }}">Cart</a></li> --}}
        {{-- <li class="nav-item"><a class="nav-link" href="{{ route('orders.index') }}">Orders</a></li> --}}
        {{-- <li class="nav-item"><a class="nav-link" href="{{ route('logout') }}">Logout</a></li> --}}
      @endguest
      </ul>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container mt-4">
    @yield('content')
  </div>
</body>
</html>

<style>
  body {
    background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
    min-height: 100vh;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }
  .navbar-brand {
    font-weight: 700;
    font-size: 1.5rem;
  }
  .nav-link {
    font-weight: 600;
    transition: color 0.3s ease;
  }
  .nav-link:hover {
    color: #6a11cb !important;
  }
</style>
