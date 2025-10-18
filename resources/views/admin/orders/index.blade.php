@extends('layout.app')

@section('content')
<div class="container py-4">
  <h2 class="fw-bold mb-4 text-center" style="font-family: sans-serif;">🧾 Manage Orders</h2>

  @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <table class="table table-hover align-middle text-center">
    <thead class="table-dark">
      <tr>
        <th>#</th>
        <th>Customer</th>
        <th>Email</th>
        <th>Total ($)</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody class="text-center">
      @foreach ($orders as $order)
      <tr>
        <td>{{ $order->id }}</td>
        <td>{{ $order->customer_name }}</td>
        <td>{{ $order->customer_email }}</td>
        <td>{{ number_format($order->total_price, 2) }}</td>
        <td>
          <span class="badge bg-{{ $order->status == 'Pending' ? 'secondary' : ($order->status == 'Accepted' ? 'success' : ($order->status == 'Rejected' ? 'danger' : 'info')) }}">
            {{ $order->status }}
          </span>
        </td>
        <td>
          <form action="{{ route('admin.orders.updateStatus', ['id' => $order->id, 'status' => 'Accepted']) }}" method="POST" class="d-inline">
            @csrf
            <button class="btn btn-success btn-sm">Accept</button>
          </form>

          <form action="{{ route('admin.orders.updateStatus', ['id' => $order->id, 'status' => 'Rejected']) }}" method="POST" class="d-inline">
            @csrf
            <button class="btn btn-danger btn-sm">Reject</button>
          </form>

          <form action="{{ route('admin.orders.updateStatus', ['id' => $order->id, 'status' => 'Delivered']) }}" method="POST" class="d-inline">
            @csrf
            <button class="btn btn-info btn-sm">Delivered</button>
          </form>

          <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" class="d-inline">
            @csrf @method('DELETE')
            <button class="btn btn-outline-danger btn-sm">🗑</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
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
  
  /* Modern Button Styling */
  .btn-outline-warning {
    border: 2px solid #3b82f6;
    color: #3b82f6;
    font-weight: 600;
    border-radius: 8px;
    transition: all 0.2s ease-in-out;
  }
  .btn-outline-warning:hover {
    background-color: #3b82f6;
    color: white;
  }
  
  .btn-outline-danger {
    border: 2px solid #ef4444;
    color: #ef4444;
    font-weight: 600;
    border-radius: 8px;
    transition: all 0.2s ease-in-out;
  }
  .btn-outline-danger:hover {
    background-color: #ef4444;
    color: white;
  }
  
  .btn-success {
    color: white;
    border: none;
    border-radius: 10px;
    padding: 10px 20px;
    font-size: 18px;
    font-weight: 600;
    transition: all 0.2s ease-in-out;
  }
  .btn-success:hover {
    transform: scale(1.05);
    box-shadow: 0 3px 18px rgba(154, 245, 163, 0.4);
  }
</style> 
