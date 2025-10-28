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

        /* ------------------------------------- */
        /* === KEY CHANGES FOR STICKY-BOTTOM === */
        /* ------------------------------------- */
        html, body {
            height: 100%;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            
            /* Add padding to prevent content from hiding behind the fixed footer */
            padding-bottom: 200px; /* ADJUST THIS VALUE TO MATCH YOUR FOOTER HEIGHT! */

            font-family: 'Playfair Display', serif;
            background-color: var(--light-bg);
        }

        main {
            flex: 1; /* Pushes the footer to the bottom (of the document, then padding takes effect) */
        }
        
        .footer {
            /* Changed from sticky to fixed for viewport stickiness */
            width: 100%;
            height: 100vh;
            margin-bottom: auto;
            background-color: #f8f9fa; /* Ensure footer has a solid background */
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
        }
        /* ------------------------------------- */

        /* Existing Styles (cleaned up) */
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
            max-width: 600px;
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
        /* Make sure content-area does not interfere with the flex-1 on main */
        .content-area {
             min-height: 400px;
             padding: 40px 0;
        }

        .footer .container-fluid{
            width: 90%;
        }

        .footer{
            color: #4d4c4cff!important;
        }

        .footer a {
            color: black; 
            transition: color 0.3s;
            font-size: 20px;
        }
        
        .footer a:hover {
            color: #787777ff; 
        }

        .footer .btn-light {
            background-color: #000000ff;
            color: white; /* Changed text color to white for contrast */
        }
        .footer .btn-light:hover {
            background-color: #333333;
        }
        
        
    </style>

    @stack('styles')
</head>

<body>
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

    <main>
        @if(request()->is('/'))
            <section class="hero-section">
                <div class="hero-content">
                    <h1>Best food for your taste</h1>
                    <p>Discover delectable cuisine and unforgettable moments in our welcoming, culinary haven</p>
                    <a href="{{ route('customer.menu.index') }}" class="btn-explore">Explore Menu</a>
                </div>
            </section>
        @endif

        <div class="content-area">
            @yield('content')
        </div>
    </main>
    

    {{-- Removed mb-2 class as it adds space that interferes with fixed positioning --}}
    <footer class="footer text-center text-md-start py-1 ">
        <div class="container-fluid mt-2">
            <div class="row align-items-center">
                   <div class="col-md-2 text-center text-md-start">
                       <h6 class="fw-bold mb-2 text-center">FoodHub</h6>
                       <p class="medium mb-0">Delicious meals, made fresh every day. Order your favorite food from us!</p>
                   </div>
                   <div class="col-md-2 text-md-center mb-2 mb-md-0 text-center">
                       <h6 class="fw-bold text-center">Contact US</h6>
                       <span class="me-3"><i class="fas fa-phone"></i> (123) 456-7890</span><br>
                       <span><i class="fas fa-envelope"></i> info@foodhub.com</span>
                   </div>
                   <div class="col-md-2 text-md-center mb-2 mb-md-0">
                       <h6 class="fw-bold text-center">Opening Hours</h6>
                       <p class="mb-0">Mon - Fri: 9:00 AM - 9:00 PM</p>
                       <p class="mb-0">Sat - Sun: 10:00 AM - 10:00 PM</p>
                   </div>
                   <div class="col-md-2 text-md-center  ">
                       <h6 class="fw-bold">Social Media</h6>
                       <a href="#" class="text-black me-2"><i class="fab fa-twitter"></i></a>
                       <a href="#" class="text-black me-2"><i class="fab fa-facebook"></i></a>
                       <a href="#" class="text-black me-2"><i class="fab fa-instagram"></i></a>
                       <a href="#" class="text-black"><i class="fab fa-youtube"></i></a>
                   </div>
                   <div class="col-md-3 text-md-start mb-2 mb-md-0 text-md-end">
                       <h6 class="fw-bold text-center">Newsletter</h6>
                       <form class="d-flex flex-column flex-sm-row justify-content-center justify-content-md-end">
                           <input type="email" class="form-control mb-2 mb-sm-0 me-sm-2" placeholder="Your email">
                           <button type="submit" class="btn btn-light text-light">Subscribe</button>
                       </form>
                   </div>
            </div>
        </div>
    </footer>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- ✅ important: render @push('scripts') here --}}
    @stack('scripts')
</body>
</html>