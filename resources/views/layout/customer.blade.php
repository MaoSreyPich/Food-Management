<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title','SystemFood')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand fw-bold" href="{{ url('/') }}">SystemFood</a>
      <div>
        <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Login</a>
        <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
      </div>
    </div>
  </nav>

  <!-- Main content -->
  <div class="container mt-5">
    @yield('content')
  </div>

</body>
</html>
