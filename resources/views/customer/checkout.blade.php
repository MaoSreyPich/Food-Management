@extends('layout.customer')
@section('title', 'Checkout')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold text-center mb-4" style="font-family: 'Inter', sans-serif;">
        💳 Checkout
    </h2>

    {{-- Error Message --}}
    @if(session('error'))
        <div class="alert alert-danger text-center shadow-sm border-0">
            <i class="bi bi-x-circle-fill me-2"></i>{{ session('error') }}
        </div>
    @endif

    @php
        $cart = session('cart', []);
        $subtotal = 0;
        foreach($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        $delivery_fee = 3.50; // you can adjust
        $total = $subtotal + $delivery_fee;
    @endphp

    @if(count($cart) > 0)
        <div class="row g-4">
            {{-- Left Column: Customer Info --}}
            <div class="col-lg-6">
                <div class="card border-0 shadow-lg rounded-4">
                    <div class="card-header bg-foodhub-primary text-white rounded-top-4">
                        <h5 class="mb-0"><i class="bi bi-person-circle me-2"></i> Customer Information</h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('customer.checkout.place') }}" method="POST" class="needs-validation" novalidate>
                            @csrf
                            <div class="mb-3">
                                <label for="customer_name" class="form-label fw-semibold">Full Name</label>
                                <input type="text" name="customer_name" id="customer_name" 
                                       class="form-control form-control-lg rounded-3 shadow-sm border-0" 
                                       placeholder="Enter your full name" required>
                            </div>

                            <div class="mb-3">
                                <label for="customer_email" class="form-label fw-semibold">Email</label>
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

                            <button type="submit" class="btn btn-primary btn-lg w-100 rounded-4 shadow-sm">
                                Place Order <i class="bi bi-arrow-right-circle ms-2"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Right Column: Order Summary --}}
            <div class="col-lg-6">
                <div class="card border-0 shadow-lg rounded-4">
                    <div class="card-header bg-foodhub-primary text-white rounded-top-4">
                        <h5 class="mb-0"><i class="bi bi-receipt me-2"></i> Order Summary</h5>
                    </div>
                    <div class="card-body p-4">
                        <table class="table align-middle">
                            <thead>
                                <tr class="text-muted">
                                    <th>Item</th>
                                    <th>Qty</th>
                                    <th class="text-end">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cart as $item)
                                    <tr>
                                        <td>{{ $item['name'] }}</td>
                                        <td>{{ $item['quantity'] }}</td>
                                        <td class="text-end">${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="2" class="text-end fw-semibold">Delivery Fee</td>
                                    <td class="text-end">${{ number_format($delivery_fee, 2) }}</td>
                                </tr>
                                <tr class="border-top">
                                    <td colspan="2" class="text-end fw-bold fs-5">Total</td>
                                    <td class="text-end fw-bold fs-5 text-foodhub-primary">
                                        ${{ number_format($total, 2) }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="text-center mt-3">
                            <small class="text-muted">
                                Secure checkout powered by FoodHub 🍔
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        {{-- Empty Cart --}}
        <div class="text-center py-5">
            <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-4 shadow-sm"
                 style="width: 120px; height: 120px;">
                <i class="bi bi-cart-x text-foodhub-primary" style="font-size: 3rem;"></i>
            </div>
            <h3 class="fw-bold mb-2">Your Cart is Empty</h3>
            <p class="text-muted">Please add items to your cart before proceeding to checkout.</p>
            <a href="{{ route('customer.menu.index') }}" class="btn btn-primary rounded-4 mt-3 px-4">
                Back to Menu <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>
    @endif
</div>

<style>
    .bg-foodhub-primary {
        background-color: #ff4d4d !important; /* Customize this to match your brand color */
    }
</style>
@endsection

