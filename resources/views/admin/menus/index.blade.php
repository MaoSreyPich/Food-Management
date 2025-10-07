@extends('layout.app')

@section('content')
<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold">🍔 Food Menu</h3>
    <a href="{{ route('admin.menu.create') }}" class="btn btn-gradient">+ Add Item</a>
  </div>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <table class="table table-hover align-middle">
    <thead class="table-light">
      <tr>
        <th>#</th>
        <th>Name</th>
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
          <td>{{ $menu->category->name ?? 'N/A' }}</td>
          <td>{{ number_format($menu->price, 2) }}</td>
          <td>{{ $menu->stock }}</td>
          <td class="text-center">
            <a href="{{ route('admin.menu.edit', $menu->id) }}" class="btn btn-sm btn-outline-primary me-2">Edit</a>
            <form action="{{ route('admin.menu.destroy', $menu->id) }}" method="POST" class="d-inline">
              @csrf
              @method('DELETE')
              <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this item?')">Delete</button>
            </form>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="6" class="text-center text-muted">No food items found</td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>

<style>
.btn-gradient {
  background: linear-gradient(90deg, #6a11cb, #2575fc);
  color: #fff;
  border: none;
  border-radius: 8px;
  padding: 8px 16px;
  font-weight: 600;
  transition: all 0.2s ease-in-out;
}
.btn-gradient:hover {
  transform: scale(1.05);
  box-shadow: 0 6px 15px rgba(37, 117, 252, 0.4);
}
</style>
@endsection
