<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FoodHub | Delicious Food')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
     @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body {
            background-color: #fffaf5;
            color: #2d2d2d;
            font-family: 'Inter', sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;

        }
        body, html {
            height: 100%;
            margin: 0;
        }

         main {
            flex: 1;
        }

        .navbar {
            background-color: #fff;
            border-bottom: 1px solid #eee;
            height: 83px;
        }

        .navbar-brand {
            font-weight: 700;
            color: #d94b2b !important;
            font-size: 20px;
        }

        .navbar .nav-link {
            color: #2d2d2d;
            font-weight: 500;
            margin-left: 1rem;
            font-size: 20px;
        }

        .navbar .nav-link:hover {
            color: #d94b2b;
        }

        .btn-signup {
            background-color: #d94b2b;
            color: white;
            border-radius: 20px;
            padding: 6px 16px;
            font-size: 20px;
            font-weight: 600;
        }

        .btn-signup:hover {
            background-color: #c63e22;
            color: white;
        }

        .btn-cta {
            background-color: #d94b2b;
            border: none;
            border-radius: 8px;
            padding: 12px 28px;
            font-weight: 600;
        }

        .btn-cta:hover {
            background-color: #c63e22;
        }

        .text-foodhub-text-muted {
            color: #666 !important;
        }

        .feature-icon {
            font-size: 2rem;
            color: #d94b2b;
            background-color: #fff3ef;
            width: 70px;
            height: 70px;
            line-height: 70px;
            border-radius: 50%;
            margin: 0 auto 1rem auto;
        }

        footer {
            background-color: #f8f9fa;
            border-top: 1px solid #e9ecef;
            color: #6c757d;
            font-size: 15px;
        }

        .menu-card-img {
            border-radius: 12px;
            transition: transform 0.2s ease;
        }

        .menu-card-img:hover {
            transform: scale(1.03);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg sticky-top" >
        <div class="container px-6 "style="font-family: sans-serif;">
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="bi bi-egg-fried me-1 "></i> FoodHub
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a href="{{ route('customer.orders.index') }}" class="nav-link">Orders</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('customer.cart.index') }}" class="nav-link">Cart</a>
                    </li>

                    @auth
                        <li class="nav-item dropdown ms-3">
                            <a class="nav-link dropdown-toggle btn btn-outline-dark btn-sm" href="#" id="userMenu" role="button" data-bs-toggle="dropdown" style="border-radius: 20px;">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link">Login</a>
                        </li>
                        <li class="nav-item ms-2">
                            <a href="{{ route('register') }}" class="btn btn-signup">Sign Up</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="text-center py-3 footer-expand-lg sticky-bottom">
        &copy; {{ date('Y') }} FoodHub. All rights reserved.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
