@extends('layout.customer')

@section('title', 'Shopping Cart')

@section('content')
<div class="container py-5" style="max-width: 1200px;">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <h1 class="fw-bold" style="font-family: 'Inter', sans-serif; font-size: 2.2rem;">🛒 Shopping Cart</h1>
        <a href="{{ route('customer.cart.clear') }}" class="text-danger fw-semibold text-decoration-none fs-5">Clear Cart</a>
    </div>

    @php
        $cart = session('cart', []);
        $subtotal = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        $delivery = 3.99;
        $tax = round($subtotal * 0.08, 2);
        $total = $subtotal + $delivery + $tax;
    @endphp

    @if(count($cart) > 0)
        <div class="row g-4">
            <!-- 🧺 Cart Items -->
            <div class="col-lg-8">
                @foreach($cart as $id => $item)
                    <div class="cart-item d-flex justify-content-between align-items-center shadow-sm mb-4 p-4 rounded-4 bg-white">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset($item['image']) }}" 
                                alt="{{ $item['name'] }}" 
                                class="rounded-4 me-4" 
                                style="width: 140px; height: 140px; object-fit: cover;">
                            
                            <div>
                                <h4 class="fw-bold mb-2" style="font-size: 1.4rem;">{{ $item['name'] }}</h4>
                                <p class="text-danger fw-semibold mb-3" style="font-size: 1.2rem;">${{ number_format($item['price'], 2) }}</p>
                                
                                <div class="d-flex align-items-center">
                                    <form action="{{ route('customer.cart.update') }}" method="POST" class="d-flex align-items-center me-3">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $id }}">
                                        <button type="button" class="btn btn-outline-secondary btn-lg rounded-circle px-3" onclick="this.nextElementSibling.stepDown()">−</button>
                                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control text-center mx-3 fw-semibold" style="width: 70px; height: 45px; font-size: 1.1rem;">
                                        <button type="button" class="btn btn-outline-secondary btn-lg rounded-circle px-3" onclick="this.previousElementSibling.stepUp()">+</button>
                                        <button type="submit" class="btn btn-outline-success ms-3 fw-semibold px-3 py-2">Update</button>
                                    </form>

                                    <form action="{{ route('customer.cart.remove') }}" method="POST" class="d-inline" onsubmit="return confirm('Remove this item?')">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $id }}">
                                        <button type="submit" class="btn btn-outline-danger ms-3 fw-semibold px-3 py-2">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div>
                            <p class="fw-bold fs-4 mb-0 text-dark">${{ number_format($item['price'] * $item['quantity'], 2) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- 💳 Order Summary -->
            <div class="col-lg-4">
                <div class="summary-card shadow-sm p-5 rounded-4 bg-white">
                    <h4 class="fw-bold mb-4" style="font-size: 1.6rem;">Order Summary</h4>

                    <div class="d-flex justify-content-between mb-3 fs-5 text-muted">
                        <span>Subtotal</span>
                        <span>${{ number_format($subtotal, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3 fs-5 text-muted">
                        <span>Delivery Fee</span>
                        <span>${{ number_format($delivery, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-4 fs-5 text-muted">
                        <span>Tax</span>
                        <span>${{ number_format($tax, 2) }}</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between align-items-center mb-5 fs-4 fw-bold">
                        <span>Total</span>
                        <span class="text-success">${{ number_format($total, 2) }}</span>
                    </div>

                    <a href="{{ route('customer.checkout.index') }}" class="btn btn-checkout w-100 py-3 fs-5 fw-semibold mb-3">
                        Proceed to Checkout
                    </a>
                    <a href="{{ route('customer.menu.index') }}" class="btn btn-outline-dark w-100 py-3 fs-5 fw-semibold">
                        Continue Shopping
                    </a>
                </div>
            </div>
        </div>
    @else
        <div class="text-center mt-5">
            <p class="text-muted fs-4">Your cart is empty 😢</p>
            <a href="{{ route('customer.menu.index') }}" class="btn btn-dark px-5 py-3 mt-3 fs-5">Browse Menu</a>
        </div>
    @endif
</div>

<style>
    body {
        background-color: #fdfbf8;
        font-family: 'Inter', sans-serif;
    }

    .cart-item {
        transition: all 0.25s ease;
    }

    .cart-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.1);
    }

    .btn-checkout {
        background-color: #e24a1a;
        color: white;
        border: none;
        border-radius: 10px;
        transition: 0.3s ease;
    }

    .btn-checkout:hover {
        background-color: #c63a10;
        transform: scale(1.03);
    }

    .summary-card {
        border: 1px solid #eee;
    }

    .btn-outline-dark {
        border-radius: 10px;
    }
    footer {
    display: none !important;
    } 
</style>
@endsection
