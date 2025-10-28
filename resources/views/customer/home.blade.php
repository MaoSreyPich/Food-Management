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

        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            font-family: 'Playfair Display', serif;
            margin: 0;
            padding: 0;
        }

        main {
            flex: 1;
            /* pushes footer to the bottom */
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
            margin: 0 8px;
        }

        .top-bar i {
            margin-right: 5px;
        }

        /* Navbar */
        .navbar-custom {
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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
            background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)),
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
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        /* Content Area */
        .content-area {
            min-height: 4cm;
            padding: 40px 0;
        }

        .grid {
            background-color: var(--light-bg);
            display: grid;
            gap: 5rem;
            margin-top: 15px;
            padding-bottom: 10px;
            margin: 10px 0 0 0;
            box-sizing: border-box;
            padding: 0;
            border: 0 solid;
        }

        .md\:grid-cols-3 {
            grid-template-columns: repeat(3, 1fr);
            outline-color:
                color-mix(in oklab, var(--ring) 50%, transparent);
        }

        .gap-8 {
            gap: calc(var(--spacing) * 8);

        }

        .footer .container-fluid {
            width: 90%;
        }

        .footer {
            background-color: #f8f9fa;
            color: #4d4c4cff !important;
        }

        .footer a {
            color: black;
            /* Keep black */
            transition: color 0.3s;
            font-size: 20px;
        }

        .footer a:hover {
            color: #787777ff;
            /* Subtle hover */
        }

        .sticky-bottom {
            position: sticky;
            bottom: 0;
            width: 100%;
            z-index: 10;
        }

        .footer .btn-light {
            background-color: #000000ff;
            color: #000000ff;
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
                    <li class="nav-item">
                        <a href="{{ route('customer.cart.index') }}" class="nav-link">
                            <i class="fas fa-shopping-cart"></i> Cart
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
    <div class="grid md:grid-cols-3 gap-8">
        <div class="text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-primary/10 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-utensils-crossed h-8 w-8 text-primary">
                    <path d="m16 2-2.3 2.3a3 3 0 0 0 0 4.2l1.8 1.8a3 3 0 0 0 4.2 0L22 8"></path>
                    <path d="M15 15 3.3 3.3a4.2 4.2 0 0 0 0 6l7.3 7.3c.7.7 2 .7 2.8 0L15 15Zm0 0 7 7">
                    </path>
                    <path d="m2.1 21.8 6.4-6.3"></path>
                    <path d="m19 5-7 7">

                    </path>
                </svg>
            </div>
            <h3 class="text-xl font-semibold mb-2">Wide Selection</h3>
            <p class="text-muted-foreground">Choose from hundreds of dishes across multiple categories</p>
        </div>
        <div class="text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-primary/10 mb-4"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock h-8 w-8 text-primary">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polyline points="12 6 12 12 16 14"></polyline>
                </svg></div>
            <h3 class="text-xl font-semibold mb-2">Fast Delivery</h3>
            <p class="text-muted-foreground">Get your food delivered hot and fresh in 30 minutes or less</p>
        </div>
        <div class="text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-primary/10 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star h-8 w-8 text-primary">
                    <path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z">
                    </path>
                </svg>
            </div>
            <h3 class="text-xl font-semibold mb-2">Quality Guaranteed</h3>
            <p class="text-muted-foreground">Only the best restaurants and highest quality ingredients</p>
        </div>
    </div>

    {{-- Popular Dishes --}}
    <section class="container py-5">
        <h2 class="text-center fw-bold mb-2">Popular Dishes</h2>
        <p class="text-center text-muted mb-4">Explore our most loved menu items</p>

        <div class="row row-cols-1 row-cols-md-4 g-4">
            @foreach($popularMenus ?? collect() as $menu)
            <div class="col">
                <div class="card h-100 shadow-sm border-0 rounded-3">
                    <img src="{{ asset($menu->image) }}" class="card-img-top rounded-top-3" style="height:220px; object-fit:cover;" alt="{{ $menu->name }}">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">{{ $menu->name }}</h5>
                        <p class="card-text text-muted mb-3">{{ Str::limit($menu->description ?? 'Delicious item', 80) }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer text-center text-md-start py-1 mb-2 sticky-bottom ">
        <!-- Top Section: Contact + Social -->
        <div class="container-fluid border-bottom mt-2">
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
    @stack('scripts')
</body>

</html>