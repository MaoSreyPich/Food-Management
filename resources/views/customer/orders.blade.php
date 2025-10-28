@extends('layout.customer')

@section('title', 'My Orders')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4" style=" font-family: 'Inter', sans-serif;">📦 My Orders</h2>

    @if(session('error'))
        <div class="alert alert-danger text-center">{{ session('error') }}</div>
    @endif

    @if($orders->count() > 0)
        <div class="table-responsive">
            <table class="table table-bordered align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>{{ $order->created_at->format('d M Y') }}</td>
                            <td>${{ number_format($order->total_price, 2) }}</td>
                            <td>
                                <span class="status-badge {{ strtolower($order->status) }}">{{ ucfirst($order->status) }}</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="text-center mt-4">
                <a href="{{ url('/') }}" class="btn btn-dark btn-lg px-5 py-3 rounded-4">← Back to Home</a>
            </div>
        </div>
    @else
        <div class="text-center mt-5">
            <p class="text-muted fs-4">You haven’t placed any orders yet.💁‍♀️ </p>
            <a href="{{ route('customer.menu.index') }}" class="btn btn-dark px-5 py-3 mt-3 fs-5">Browse Menu</a>
        </div>
    @endif
</div>
@endsection
<style>
  /* Import a modern, clean Google Font */
  @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
  
  body {
    font-family: 'Inter', sans-serif;
    font-size: 20px;
    color: #222;
    background-color: #f8fafc;
  }
  
  /* Table Styling */
  .table {
    border-radius: 12px;
    overflow: hidden;
    background: white;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
  }
  
  .table th {
    background-color: #000;
    color: white;
    font-weight: 600;
    font-size:20px ;
    text-transform: uppercase;
  }
  
  .table td {
    font-size: 18px;
    vertical-align: middle;
  }
  
  h3.fw-bold {
    font-size: 28px;
    color: #111;
    letter-spacing: 0.5px;
  }

  /* 🔖 Custom Status Badge Styles */
    .status-badge {
    display: inline-block;
    padding: 8px 18px;
    border-radius: 20px;
    font-weight: 600;
    color: #fff;
    text-transform: capitalize;
    font-size: 16px;
    letter-spacing: 0.3px;
    }

    /* 🎨 Each Status Color */
    .status-badge.pending {
    background-color: #f6c23e; /* Yellow */
    }

    .status-badge.accepted {
    background-color: #36b9cc; /* Blue */
    }

    .status-badge.delivered {
    background-color: #1cc88a; /* Green */
    }

    .status-badge.completed {
    background-color: #4e73df; /* Dark Blue */
    }

    .status-badge.cancelled {
    background-color: #e74a3b; /* Red */
    }

    .status-badge:hover {
    opacity: 0.9;
    transform: scale(1.05);
    transition: all 0.2s ease;
    }
    footer {
    display: none !important;
    } 


</style>