@extends('layout.customer')

@section('title', 'Your Cart')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">🛒 Your Cart</h2>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger text-center">{{ session('error') }}</div>
    @endif

    @php
        $cart = session('cart', []);
        $total = 0;
    @endphp

    @if(count($cart) > 0)
        <div class="table-responsive">
            <table class="table table-bordered align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Image</th>
                        <th>Item</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $id => $item)
                        @php
                            $subtotal = $item['price'] * $item['quantity'];
                            $total += $subtotal;
                        @endphp
                        <tr>
                            <td>
                                 <img src="{{ asset($item['image']) }}" 
                                alt="{{ $item['name'] }}" width="70" height="70"
                                style="object-fit: cover;">

                            </td>
                            <td>{{ $item['name'] }}</td>
                            <td>${{ number_format($item['price'], 2) }}</td>
                            <td>
                                <form action="{{ route('customer.cart.update') }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $id }}">
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                                           class="form-control d-inline-block text-center custom-quantity-input" style="width: 60px; height: 38px;">
                                    <button type="submit" class="btn btn-sm btn-success custom-update-button">Update</button>
                                </form>
                            </td>
                            <td>${{ number_format($subtotal, 2) }}</td>
                            <td>
                                <form action="{{ route('customer.cart.remove') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $id }}">
                                    <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-4">
            <h4>Total: <span class="text-success">${{ number_format($total, 2) }}</span></h4>
            <a href="{{ route('customer.checkout.index') }}" class="btn btn-primary btn-lg">Proceed to Checkout</a>
        </div>
    @else
        <div class="text-center">
            <p class="text-muted fs-5">Your cart is empty.</p>
            <a href="{{ route('customer.menu.index') }}" class="btn btn-outline-primary mt-3">Back to Menu</a>
        </div>
    @endif
</div>
@endsection