@extends('layout.app')

@section('content')
<div class="container py-4">
  <h3 class="fw-bold mb-4">Add New Category</h3>
  <form action="" method="POST">
    @csrf
    <div class="mb-3">
      <label class="form-label">Category Name</label>
      <input type="text" name="name" class="form-control" required>
    </div>
    <button class="btn btn-gradient">Save</button>
  </form>
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
