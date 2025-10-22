<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Bistro Bliss | Customer')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-color: #a0522d;
            --dark-bg: #2c2c2c;
            --light-bg: #f8f5f0;
        }

        body {
            font-family: 'Playfair Display', serif;
            margin: 0;
            padding: 0;
            background-color: var(--light-bg);
        }

        /* Top Bar */
        .top-bar {
            background-color: var(--dark-bg);
            color: white;
            padding: 10px 0;
            font-size: 14px;
        }

        .top-bar a {
            color: white;
            text-decoration: none;
            margin: 0 ;
        }

       

        /* Navbar */
        .navbar-custom {
            background-color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 15px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-brand {
            font-size: 28px;
            font-weight: bold;
            color: var(--dark-bg) !important;
            display: flex;
            align-items: center;
        }

        .navbar-brand img {
            width: 40px;
            height: 40px;
            margin-right: 10px;
        }

        .navbar-nav .nav-link {
            color: var(--dark-bg) !important;
            margin: 0 15px;
            font-size: 16px;
            font-weight: 500;
            transition: color 0.3s;
        }

        .navbar-nav .nav-link:hover {
            color: var(--primary-color) !important;
        }

        /* Hero Section */
        .hero-section {
            position: relative;
            min-height: 600px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), 
                        url('https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=1200') center/cover;
            color: white;
            text-align: center;
        }

        .hero-content {
            max-width: 700px;
            padding: 40px;
        }

        .hero-content h1 {
            font-size: 56px;
            font-weight: bold;
            margin-bottom: 20px;
            line-height: 1.2;
        }

        .hero-content p {
            font-size: 18px;
            margin-bottom: 30px;
            font-family: 'Arial', sans-serif;
        }

        .btn-explore {
            background-color: var(--primary-color);
            color: white;
            padding: 15px 40px;
            border: none;
            border-radius: 50px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-explore:hover {
            background-color: #8b4513;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }

        /* Content Area */
        .content-area {
            min-height: 400px;
            padding: 40px 0;
        }

        /* Footer */
        .footer {
            background-color: var(--dark-bg);
            color: white;
            padding: 20px 20;
            text-align: center;
            margin-top: 60px;
            
        }
        
    </style>

    @stack('styles')
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <span style="color: var(--primary-color);">🍽️</span> Bistro Bliss
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="{{ url('/') }}" class="nav-link">
                            <i class="fas fa-home"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('customer.menu.index') }}" class="nav-link">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('customer.orders.index') }}" class="nav-link">Track Order</a>
                    </li>

                    {{-- ✅ Keep cart count dynamic for AJAX --}}
                    <li class="nav-item">
                        <a href="{{ route('customer.cart.index') }}" class="nav-link">
                            🛒 Cart (<span id="cart-count">{{ count(session('cart', [])) }}</span>)
                        </a>
                    </li>

                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu">
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
                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="nav-link">Register</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section (only on home page) -->
    @if(request()->is('/'))
        <section class="hero-section">
            <div class="hero-content">
                <h1>Best food for your taste</h1>
                <p>Discover delectable cuisine and unforgettable moments in our welcoming, culinary haven</p>
                <a href="{{ route('customer.menu.index') }}" class="btn-explore">Explore Menu</a>
            </div>
        </section>
    @endif

    <!-- Content Area -->
    <div class="content-area">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <span><i class="fas fa-phone"></i> (414) 857 - 0107</span>
                        <span class="ms-3"><i class="fas fa-envelope"></i> yummy@bistrobliss.com</span>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href=""><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <p>&copy; {{ date('Y') }} Bistro Bliss. All rights reserved.</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- ✅ important: render @push('scripts') here --}}
    @stack('scripts')
</body>
</html>
