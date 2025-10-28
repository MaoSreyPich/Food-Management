@extends('layout.customer')
@section('title', 'Checkout')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold text-center mb-5" style="font-family: 'Inter', sans-serif; font-size: 2.5rem;">
        💳 Checkout
    </h2>

    @if(session('error'))
        <div class="alert alert-danger text-center fs-5 shadow-sm border-0 rounded-4">
            <i class="bi bi-x-circle-fill me-2"></i>{{ session('error') }}
        </div>
    @endif

    @php
        $cart = session('cart', []);
        $subtotal = 0;
        foreach($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        $delivery_fee = 3.50;
        $total = $subtotal + $delivery_fee;
    @endphp

    @if(count($cart) > 0)
        <div class="row g-5">
            {{-- ✅ Left: Customer Info --}}
            <div class="col-lg-6">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-header bg-danger text-white py-3">
                        <h5 class="mb-0 fw-semibold"><i class="bi bi-person-circle me-2"></i> Customer Information</h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('customer.checkout.place') }}" method="POST" class="needs-validation" novalidate>
                            @csrf
                            <div class="mb-4">
                                <label for="customer_name" class="form-label fw-semibold">Full Name</label>
                                <input type="text" name="customer_name" id="customer_name" 
                                       class="form-control form-control-lg rounded-3 shadow-sm border-0" 
                                       placeholder="Enter your full name" required>
                            </div>

                            <div class="mb-4">
                                <label for="customer_email" class="form-label fw-semibold">Email Address</label>
                                <input type="email" name="customer_email" id="customer_email" 
                                       class="form-control form-control-lg rounded-3 shadow-sm border-0" 
                                       placeholder="you@example.com" required>
                            </div>

                            <div class="mb-4">
                                <label for="payment_method" class="form-label fw-semibold">Payment Method</label>
                                <select name="payment_method" id="payment_method" 
                                        class="form-select form-select-lg rounded-3 shadow-sm border-0" required>
                                    <option value="cash">💵 Cash on Delivery</option>
                                    <option value="credit_card">💳 Credit Card</option>
                                    <option value="paypal">🅿️ PayPal</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-dark btn-lg w-100 rounded-4 shadow-sm py-3">
                                Place Order <i class="bi bi-arrow-right-circle ms-2"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- ✅ Right: Order Summary --}}
            <div class="col-lg-6">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-header bg-danger text-white py-3">
                        <h5 class="mb-0 fw-semibold"><i class="bi bi-receipt me-2"></i> Order Summary</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="order-items">
                            @foreach($cart as $item)
                                <div class="d-flex align-items-center justify-content-between mb-4 border-bottom pb-3">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset($item['image']) }}" 
                                             alt="{{ $item['name'] }}"
                                             class="rounded-3 me-3 shadow-sm"
                                             style="width: 80px; height: 80px; object-fit: cover;">
                                        <div>
                                            <h6 class="fw-semibold mb-1">{{ $item['name'] }}</h6>
                                            <p class="text-muted small mb-0">Qty: {{ $item['quantity'] }}</p>
                                        </div>
                                    </div>
                                    <h6 class="fw-bold text-dark mb-0">
                                        ${{ number_format($item['price'] * $item['quantity'], 2) }}
                                    </h6>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-4">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="fw-semibold text-muted">Subtotal</span>
                                <span class="fw-semibold">${{ number_format($subtotal, 2) }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="fw-semibold text-muted">Delivery Fee</span>
                                <span class="fw-semibold">${{ number_format($delivery_fee, 2) }}</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="fw-bold mb-0">Total</h5>
                                <h4 class="fw-bold text-dark mb-0">${{ number_format($total, 2) }}</h4>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <small class="text-muted">Secure checkout powered by <strong>FoodHub</strong> 🍔</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        {{-- 🚫 Empty Cart --}}
        <div class="text-center py-5">
            <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-4 shadow-sm"
                 style="width: 120px; height: 120px;">
                <i class="bi bi-cart-x text-danger" style="font-size: 3rem;"></i>
            </div>
            <h3 class="fw-bold mb-2">Your Cart is Empty</h3>
            <p class="text-muted fs-5">Please add some items to your cart before checking out.</p>
            <a href="{{ route('customer.menu.index') }}" class="btn btn-dark rounded-4 mt-3 px-5 py-3 shadow-sm">
                Browse Menu <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>
    @endif
</div>

<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

body {
  font-family: 'Inter', sans-serif;
  background-color: #f8fafc;
  color: #222;
}

/* ✨ Card Hover Effect */
.card {
  transition: all 0.3s ease;
  border: 1px solid #eee;
}
.card:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
}

/* 🧾 Table / Summary Styling */
.order-items img {
  border: 2px solid #f1f1f1;
}

.btn-dark {
  background-color: #111;
  border: none;
  font-weight: 600;
}
.btn-dark:hover {
  background-color: #222;
  transform: translateY(-2px);
  transition: all 0.2s ease;
}
footer {
display: none !important;
} 

</style>
@endsection
