@extends('layouts.app')
@section('title', 'My Orders')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">📦 My Orders</h2>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    @if($orders->count() > 0)
        <div class="table-responsive">
            <table class="table table-striped table-bordered align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Customer Name</th>
                        <th>Email</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Placed At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $index => $order)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $order->customer_name }}</td>
                            <td>{{ $order->customer_email }}</td>
                            <td>${{ number_format($order->total_price, 2) }}</td>
                            <td>
                                @if($order->status === 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @elseif($order->status === 'processing')
                                    <span class="badge bg-primary">Processing</span>
                                @elseif($order->status === 'delivered')
                                    <span class="badge bg-success">Delivered</span>
                                @elseif($order->status === 'cancelled')
                                    <span class="badge bg-danger">Cancelled</span>
                                @else
                                    <span class="badge bg-secondary">{{ ucfirst($order->status) }}</span>
                                @endif
                            </td>
                            <td>{{ $order->created_at->format('d M Y, h:i A') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="text-center mt-5">
            <p class="text-muted fs-5">You haven’t placed any orders yet.</p>
            <a href="{{ route('customer.menu.index') }}" class="btn btn-outline-primary mt-3">Browse Menu</a>
        </div>
    @endif
</div>
@endsection
