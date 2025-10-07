@extends('layout.app')

@section('content')
<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold">📂 Categories</h3>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-gradient">+ Add Category</a>
  </div>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <table class="table table-hover align-middle">
    <thead class="table-light">
      <tr>
        <th>#</th>
        <th>Name</th>
        <th class="text-center">Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse($categories as $index => $category)
        <tr>
          <td>{{ $index + 1 }}</td>
          <td>{{ $category->name }}</td>
          <td class="text-center">
            <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-outline-primary me-2">Edit</a>
            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="d-inline">
              @csrf
              @method('DELETE')
              <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
            </form>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="3" class="text-center text-muted">No categories found</td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection

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
