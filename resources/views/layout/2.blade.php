@extends('layout.customer')

@section('title', 'Delicious Food, Delivered to Your Door')

@section('content')
    <div class="container text-center py-5 my-5">
        <h1 class="hero-heading mb-3">Delicious Food,<br>Delivered to Your Door</h1>
        <p class="hero-subheading mb-5">
            Order from your favorite restaurants and enjoy fresh, hot meals delivered right to your doorstep.
        </p>

        <a href="{{ route('register') }}" class="btn btn-cta-primary btn-lg me-3">Get Started</a>
        <a href="{{ route('customer.menu.index') }}" class="btn btn-cta-secondary btn-lg">Browse Menu</a>
    </div>

    <div class="container py-5 text-center features-row">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-icon-container"><i class="bi bi-x-lg"></i></div> <h5 class="feature-title">Wide Selection</h5>
                <p class="feature-text">Choose from hundreds of dishes across multiple categories</p>
            </div>
            <div class="col-md-4">
                <div class="feature-icon-container"><i class="bi bi-clock"></i></div> <h5 class="feature-title">Fast Delivery</h5>
                <p class="feature-text">Get your food delivered hot and fresh in 30 minutes or less</p>
            </div>
            <div class="col-md-4">
                <div class="feature-icon-container"><i class="bi bi-star"></i></div> <h5 class="feature-title">Quality Guaranteed</h5>
                <p class="feature-text">Only the best restaurants and highest quality ingredients</p>
            </div>
        </div>
    </div>

    <div class="container py-5">
        <h2 class="text-center hero-heading" style="font-size: 2.25rem;">Popular Dishes</h2>
        <p class="text-center hero-subheading" style="margin-bottom: 3rem;">Explore our most loved menu items</p>

        <div class="row row-cols-1 row-cols-md-4 g-4">
            @forelse ($popularMenus ?? [] as $menu)
                <div class="col">
                    <div class="card menu-card h-100">
                        <img src="{{ $menu->image ? asset('uploads/menus/'.$menu->image) : 'https://via.placeholder.com/400x300?text=' . urlencode($menu->name) }}"
                            class="card-img-top menu-card-img" alt="{{ $menu->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $menu->name }}</h5>
                            <p class="card-text-description">{{ $menu->description ?? 'Authentic food with fresh ingredients.' }}</p> 
                            
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <p class="card-price mb-0">${{ number_format($menu->price, 2) }}</p>
                                <a href="{{ route('customer.cart.add', $menu->id) }}" class="btn btn-add-to-cart">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col text-center w-100">
                    <p class="text-muted">No popular items yet.</p>
                </div>
            @endforelse
        </div>
    </div>
    <div class="text-center pb-5">
        <a href="{{ route('customer.menu.index') }}" class="btn btn-cta-secondary">View Full Menu</a>
    </div>
@endsection