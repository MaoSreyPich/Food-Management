@extends('layout.app')

@section('content')
<div class="container py-5 text-center">
  <h2 class="fw-bold mb-4 text-gradient">🍽 Manage Menu</h2>
  <p class="text-muted mb-5">Choose whether to manage Categories or Menu Items.</p>

  <div class="row justify-content-center g-4">
    <div class="col-md-4">
      <div class="card shadow border-0 rounded-4">
        <div class="card-body py-5">
          <h5 class="fw-bold mb-3">📂 Categories</h5>
          <p class="text-muted">Manage food categories (Food, Drink, Snack, etc.)</p>
          <a href="{{ route('admin.categories.index') }}" class="btn btn-gradient w-100 mt-3">
            Manage Categories
          </a>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card shadow border-0 rounded-4">
        <div class="card-body py-5">
          <h5 class="fw-bold mb-3">📋 Menu Items</h5>
          <p class="text-muted">Add or edit menu items under each category.</p>
          <a href="{{ route('admin.menu.index') }}" class="btn btn-gradient w-100 mt-3">
            Manage Menu Items
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
