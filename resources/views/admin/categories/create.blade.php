@extends('layout.app')

@section('content')
<div class="container py-4">
  <h3 class="fw-bold mb-4 text-center" style="font-family: 'Inter', sans-serif;">Add New Category</h3>
  <form action="{{ route('admin.categories.store') }}"  method="POST" class="shadow-sm p-4 rounded-4 bg-gray-900 mx-auto" style="max-width: 570px;">
    @csrf
    <div class="mb-3">
      <label class="form-label">Category Name</label>
      <input type="text" name="name" class="form-control" placeholder="e.g., Food, Drink, Snack" required>
    </div>
    <button class="btn btn-success">Save</button>
  </form>
</div>
@endsection

<style>
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
  /* --- Input Base Styling --- */
  .form-control {
    border-radius: 8px;
    padding: 10px 12px;
    font-size: 18px;
    transition: all 0.2s ease-in-out;
    color: #333; /* default text color */
    border: 2px solid #ccc; /* default border */
    outline: none !important; /* Force removal of standard outline */
    box-shadow: none !important; /* Force removal of default blue shadow/glow */
  }

  /* --- Input Hover and Focus Overrides (for black styling) --- */
  .form-control:hover,
  .form-control:focus {
    color: #000; 
    /* Set border to solid black on focus/hover */
    border: 2px solid #000 !important; 
    /* Apply your custom black shadow */
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.3) !important;
    /* Re-enforce removal of outline */
    outline: none !important;
  }
</style>
