@extends('layouts.app')
@section('title', 'Checkout')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">💳 Checkout</h2>

    @if(session('error'))
        <div class="alert alert-danger text-center">{{ session('error') }}</div>
    @endif

    @php
        $cart = session('cart', []);
        $subtotal = 0;
        foreach($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        $delivery_fee = 3.50; // You can change this value as needed
        $total = $subtotal + $delivery_fee;
    @endphp

    @if(count($cart) > 0)
        <div class="row">
            {{-- Left column: Customer Info --}}
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0">Customer Information</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('customer.checkout.place') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="customer_name" class="form-label">Full Name</label>
                                <input type="text" name="customer_name" id="customer_name" 
                                       class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="customer_email" class="form-label">Email</label>
                                <input type="email" name="customer_email" id="customer_email" 
                                       class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="payment_method" class="form-label">Payment Method</label>
                                <select name="payment_method" id="payment_method" class="form-select" required>
                                    <option value="cash">Cash on Delivery</option>
                                    <option value="credit_card">Credit Card</option>
                                    <option value="paypal">PayPal</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-success w-100">
                                Place Order
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Right column: Order Summary --}}
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0">Order Summary</h5>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cart as $item)
                                    <tr>
                                        <td>{{ $item['name'] }}</td>
                                        <td>{{ $item['quantity'] }}</td>
                                        <td>${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="2" class="text-end fw-bold">Delivery Fee</td>
                                    <td>${{ number_format($delivery_fee, 2) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-end fw-bold">Total</td>
                                    <td class="fw-bold text-success">
                                        ${{ number_format($total, 2) }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="text-center">
            <p class="text-muted fs-5">Your cart is empty. Please add items before checkout.</p>
            <a href="{{ route('customer.menu.index') }}" class="btn btn-outline-primary mt-3">Back to Menu</a>
        </div>
    @endif
</div>
@endsection
