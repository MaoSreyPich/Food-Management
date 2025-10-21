<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FoodHub | Delicious Food')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
        
        /* --- Color Variables (Precise Match to Images) --- */
        :root {
            --primary-color: #e45738; /* Orange-Red for buttons and accents */
            --dark-text: #2a2a2a;     /* Dark Charcoal for headings and logo */
            --muted-text: #5e5e5e;    /* Muted Gray for body/descriptions */
            --background-color: #ffffff; 
            --light-accent-bg: #fef2ee; /* Light pink/orange for feature circles */
            --border-color: #dcdcdc; /* Light border for secondary buttons/cards */
        }

        body {
            /* Using pure white background */
            background-color: #fbfbfbff;
            color: var(--muted-text);
            font-family: 'Inter', sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            overflow-x: hidden;
            width: 100%;
        }
        body, html {
            height: 100%;
            margin: 0;
        }

        main {
            flex: 1;
        }

        /* ---------------------------------- */
        /* --- Navigation Bar Styles --- */
        /* ---------------------------------- */
        .navbar {
            background-color: #fff;
            border-bottom: none; 
            padding-top: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #e9ecef;

        }

        /* Brand Logo: Dark Text with Red Icon (using X icon from image) */
        .navbar-brand {
            font-weight: 700;
            color: var(--dark-text) !important; 
            font-size: 24px;
            display: flex;
            align-items: center;
            
        }
        .navbar-brand i {
            font-size: 24px;
            color: var(--primary-color);
            margin-right: 0.25rem;
            
        }

        /* Navigation Links (Orders, Login) */
        .navbar .nav-link {
            color: var(--dark-text); /* Link color is dark, not muted */
            font-weight: 500;
            font-size: 16px; 
            padding: 0; 
            
        }

        .navbar .nav-link:hover {
            color: var(--primary-color);
        }
        
        /* Orders Cart Count Badge (The '2' in the image) */
        .order-cart-count {
            background-color: var(--primary-color);
            color: white;
            font-size: 12px;
            font-weight: 600;
            padding: 2px 7px;
            border-radius: 50%;
            position: absolute;
            top: -5px;
            right: -10px;
            line-height: 1;
        }
        
        /* Login Text Link Style */
        .nav-item-login {
            color: var(--dark-text) !important;
            margin-right: 0.5rem;
        }

        /* Sign Up Button Style: Exact Color & Rounded Corners from Image */
        .btn-signup {
            background-color: var(--primary-color);
            color: white;
            border-radius: 6px; /* Slightly less rounded than original */
            padding: 8px 18px;
            font-size: 16px;
            font-weight: 500;
            border: none;
            line-height: 1.2;
        }

        .btn-signup:hover {
            background-color: #c9492f;
            color: white;
        }

        /* ---------------------------------- */
        /* --- Hero Section & Buttons --- */
        /* ---------------------------------- */
        /* Main Heading (Delicious Food, Delivered to Your Door) */
        .hero-heading {
            font-size: 3.5rem; 
            font-weight: 800; 
            color: var(--dark-text); 
            line-height: 1.1;
        }
        
        /* Subheading Text */
        .hero-subheading {
            font-size: 1.15rem;
            font-weight: 400;
            color: var(--muted-text);
        }

        /* Primary CTA Button (Get Started) */
        .btn-cta-primary {
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 6px;
            padding: 12px 30px;
            font-weight: 600;
            font-size: 16px;
        }

        .btn-cta-primary:hover {
            background-color: #c9492f;
            color: white;
        }
        
        /* Secondary CTA Button (Browse Menu) */
        .btn-cta-secondary {
            background-color: transparent;
            color: var(--dark-text);
            border: 1px solid var(--border-color); 
            border-radius: 6px;
            padding: 12px 30px;
            font-weight: 500;
            font-size: 16px;
        }

        .btn-cta-secondary:hover {
            background-color: #f7f7f7;
            border-color: #c0c0c0;
        }

        /* ---------------------------------- */
        /* --- Features & Menu Cards --- */
        /* ---------------------------------- */

        /* Feature Icon Circle */
        .feature-icon-container {
            font-size: 2rem;
            color: var(--primary-color);
            background-color: var(--light-accent-bg); 
            width: 70px; 
            height: 70px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            margin: 0 auto 0.75rem auto;
        }
        
        .feature-title {
            font-weight: 700; /* Bold font for titles */
            color: var(--dark-text);
            font-size: 18px;
            margin-bottom: 0.25rem;
        }
        
        .feature-text {
            color: var(--muted-text);
            font-size: 14px;
            line-height: 1.4;
        }
        
        /* Menu Cards Styles */
        .menu-card {
            /* The cards in the image have a subtle shadow and light border */
            border: 1px solid #eee; 
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05); 
            overflow: hidden;
            height: 100%;
        }
        
        .menu-card-img {
            /* Remove transition from original if it's not desired */
            border-radius: 0; /* Image fills the top of the card */
            height: 200px; /* Fixed height for image consistency */
            object-fit: cover;
        }
        
        .card-title {
            color: var(--dark-text);
            font-weight: 600;
            font-size: 18px;
        }
        
        .card-text-description {
            color: var(--muted-text);
            font-size: 14px;
            margin-bottom: 0.5rem;
            /* Use a lighter font weight for descriptions */
            font-weight: 400; 
        }

        .card-price {
            color: var(--dark-text);
            font-weight: 700;
            font-size: 18px;
            margin-bottom: 0.75rem;
        }

        /* "Add to Cart" Button Style on Cards */
        .btn-add-to-cart {
            background-color: var(--primary-color);
            color: white;
            border-radius: 6px;
            padding: 8px 20px;
            font-weight: 500;
            border: none;
            font-size: 14px;
        }
        
        .btn-add-to-cart:hover {
            background-color: #c9492f;
            color: white;
        }

        footer {
             background-color: var(--background-color);
             border-top: 1px solid #e9ecef;
             color: #6c757d;
             font-size: 15px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg sticky-top ">
        <div class="container px-5 w-full">
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="bi bi-egg-fried me-1"></i> FoodHub 
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item me-4">
                        <a href="{{ route('customer.orders.index') }}" class="nav-link position-relative">
                            Orders
                            
                        </a>
                    </li>
                    <li class="nav-item me-4">
                        <a href="{{ route('customer.cart.index') }}" class="nav-link position-relative">
                            Cards
                            <!-- <span class="order-cart-count">2</span> -->
                        </a>
                    </li>
                    
                    @guest
                        <li class="nav-item me-3">
                            <a href="{{ route('login') }}" class="nav-link nav-item-login">Login</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="btn btn-signup">Sign Up</a>
                        </li>
                    @endguest
                    
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
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="text-center py-3  footer-expand-lg sticky-bottom">
        &copy; {{ date('Y') }} FoodHub. All rights reserved.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>