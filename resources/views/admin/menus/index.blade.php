@extends('layout.app')

@section('content')
<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold" style="font-family: sans-serif;">📋 Food Menu</h3>
    <a href="{{ route('admin.menu.create') }}" class="btn btn-success">+ Add Item</a>
  </div>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <table class="table table-hover align-middle text-center">
    <thead class="table-dark">
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Image</th>
        <th>Category</th>
        <th>Price ($)</th>
        <th>Stock</th>
        <th class="text-center">Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse($menus as $index => $menu)
        <tr>
          <td>{{ $index + 1 }}</td>
          <td>{{ $menu->name }}</td>
          <td>
            @if($menu->image)
              <img src="{{ asset($menu->image) }}" alt="{{ $menu->name }}" width="60" height="60" style="object-fit: cover; border-radius: 8px;">
            @else
              <span class="text-muted">No Image</span>
            @endif
          </td>
          </td>
          <td>{{ $menu->category->name ?? 'N/A' }}</td>
          <td>{{ number_format($menu->price, 2) }}</td>
          <td>{{ $menu->stock }}</td>
          <td class="text-center">
            <a href="{{ route('admin.menu.edit', $menu->id) }}" class="btn btn-md btn-outline-warning me-2">Edit</a>
            <form action="{{ route('admin.menu.destroy', $menu->id) }}" method="POST" class="d-inline">
              @csrf
              @method('DELETE')
              <button class="btn btn-md btn-outline-danger" onclick="return confirm('Delete this item?')">Delete</button>
            </form>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="7" class="text-center text-muted">No food items found</td>
        </tr>
      @endforelse
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
    font-weight: 600;
    transition: all 0.2s ease-in-out;
  }
  .btn-success:hover {
    transform: scale(1.05);
    box-shadow: 0 3px 18px rgba(154, 245, 163, 0.4);
  }
</style>


