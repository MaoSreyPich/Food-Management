@extends('layout.customer')

@section('title', 'Delicious Food, Delivered to Your Door')

@section('content')
    <!-- Hero Section -->
    <div class="container text-center py-5 my-5">
        <h1 class="display-4 fw-bold mb-3">Delicious Food,<br>Delivered to Your Door</h1>
        <p class="lead text-foodhub-text-muted mb-5">
            Order from your favorite restaurants and enjoy fresh, hot meals delivered right to your doorstep.
        </p>

        <a href="{{ route('register') }}" class="btn btn-cta btn-lg me-3">Get Started</a>
        <a href="{{ route('customer.menu.index') }}" class="btn btn-outline-dark btn-lg">Browse Menu</a>
    </div>

    <!-- Features -->
    <div class="container py-5 text-center">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-icon"><i class="bi bi-egg-fried"></i></div>
                <h5 class="fw-bold">Wide Selection</h5>
                <p class="text-foodhub-text-muted">Choose from hundreds of dishes across multiple categories</p>
            </div>
            <div class="col-md-4">
                <div class="feature-icon"><i class="bi bi-clock-fill"></i></div>
                <h5 class="fw-bold">Fast Delivery</h5>
                <p class="text-foodhub-text-muted">Get your food delivered hot and fresh in 30 minutes or less</p>
            </div>
            <div class="col-md-4">
                <div class="feature-icon"><i class="bi bi-award-fill"></i></div>
                <h5 class="fw-bold">Quality Guaranteed</h5>
                <p class="text-foodhub-text-muted">Only the best restaurants and highest quality ingredients</p>
            </div>
        </div>
    </div>

    <!-- Popular Dishes -->
    <div class="container py-5">
        <h2 class="text-center fw-bold mb-2">Popular Dishes</h2>
        <p class="text-center text-foodhub-text-muted mb-5">Explore our most loved menu items</p>

        <div class="row row-cols-1 row-cols-md-4 g-4">
            @forelse ($popularMenus ?? [] as $menu)
                <div class="col">
                    <div class="card border-0 shadow-sm">
                        <img src="{{ $menu->image ? asset($menu->image) : 'https://via.placeholder.com/400x300?text=' . urlencode($menu->name) }}"
                             class="card-img-top menu-card-img" alt="{{ $menu->name }}">
                        <div class="card-body text-center">
                          <h5 class="card-title mb-0">{{ $menu->name }}</h5>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col">
                    <div class="card border-0 shadow-sm p-4 text-center">
                        No popular items yet.
                    </div>
                </div>
            @endforelse
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('customer.menu.index') }}" class="btn btn-outline-dark">View Full Menu</a>
        </div>
    </div>
@endsection
