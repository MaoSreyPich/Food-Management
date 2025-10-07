@extends('layout.app')

@section('content')
<div class="container py-4">
  <h3 class="fw-bold mb-4">Add New Menu Item</h3>

  <form action="{{ route('admin.menu.store') }}" method="POST">
    @csrf
    <div class="mb-3">
      <label class="form-label">Name</label>
      <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Category</label>
      <select name="category_id" class="form-select" required>
        <option value="">Select Category</option>
        @foreach($categories as $cat)
          <option value="{{ $cat->id }}">{{ $cat->name }}</option>
        @endforeach
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Price ($)</label>
      <input type="number" name="price" step="0.01" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Stock</label>
      <input type="number" name="stock" class="form-control" required>
    </div>

    <button class="btn btn-gradient">Save</button>
  </form>
</div>
@endsection
