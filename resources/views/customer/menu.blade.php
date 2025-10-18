@extends('layout.customer')

@section('title', 'Our Menu')

@section('content')
<div class="container py-5">
    <h1 class="fw-bold">Our Menu</h1>
    <p class="text-foodhub-text-muted mb-4">Discover delicious dishes from our curated selection</p>

    @if(session('success'))
        <div class="alert alert-success text-center">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        </div>
    @endif

    {{-- Category Tabs --}}
    @php
        // Keys match your database category names (lowercase)
        $categories = [
            'all' => 'All Items',
            'food' => 'Food',
            'drink' => 'Drink',
            'snack' => 'Snack'
        ];
    @endphp

    <ul class="nav nav-pills mb-5 menu-tabs" role="tablist">
        @foreach($categories as $key => $name)
            <li class="nav-item">
                <a class="nav-link @if($key == 'all') active @endif" data-bs-toggle="pill" href="#{{ $key }}">
                    {{ $name }}
                </a>
            </li>
        @endforeach
    </ul>

    {{-- Tab Content --}}
    <div class="tab-content">
        @foreach($categories as $key => $name)
            <div class="tab-pane fade @if($key == 'all') show active @endif" id="{{ $key }}">
                <div class="row row-cols-1 row-cols-md-4 g-4">
                    @php
                        $items = $key == 'all'
                            ? $menus
                            : $menus->filter(fn($m) => $m->category && strtolower($m->category->name) === strtolower($key));
                    @endphp

                    @if($items->isEmpty() && $key != 'all')
                        <p class="text-center w-100">No items found in this category.</p>
                    @endif

                    @foreach($items as $menu)
                        <div class="col">
                            <div class="card menu-card border-0 h-100">
                                <img src="{{ $menu->image ? asset('uploads/menus/'.$menu->image) : 'https://via.placeholder.com/400x300?text=' . urlencode($menu->name) }}"
                                class="card-img-top menu-card-img" alt="{{ $menu->name }}">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold">{{ $menu->name }}</h5>
                                    <p class="card-text text-foodhub-text-muted mb-3">
                                        {{ Str::limit($menu->description ?? 'Delicious item description.', 50) }}
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="item-price mb-0">${{ number_format($menu->price, 2) }}</p>
                                        <a href="{{ route('customer.cart.add', $menu->id) }}" class="btn btn-warning">Add to Cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>

{{-- Styles --}}
<style>
.menu-tabs {
    background-color: #f8f8f6;
    border-radius: 12px;
    padding: 6px;
    display: flex;
    justify-content: space-around;
}
.menu-tabs .nav-link {
    color: #000;
    font-weight: 600;
    border-radius: 10px;
    padding: 10px 24px;
    transition: all 0.2s ease;
}
.menu-tabs .nav-link.active {
    background-color: #f05b5bff;
    color: #fff !important;
    box-shadow: 0 2px 5px rgba(0,0,0,0.05);
}
.menu-tabs .nav-link:not(.active):hover {
    background-color: #eee;
}
.menu-card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.menu-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}
.menu-card-img {
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    object-fit: cover;
    height: 180px;
}
.btn-cta {
    border-radius: 50px;
    font-weight: 600;
    padding: 0.4rem 1rem;
}
</style>

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection
