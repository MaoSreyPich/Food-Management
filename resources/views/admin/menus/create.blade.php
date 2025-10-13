@extends('layout.app')

@section('content')
<div class="container py-4">
  <h3 class="fw-bold mb-4 text-center" style="font-family: 'Inter', sans-serif;">📋 Add New Menu Item</h3>

  <form action="{{ route('admin.menu.store') }}" method="POST" enctype="multipart/form-data" class="shadow-sm p-4 rounded-4 bg-gray-900 mx-auto" style="max-width: 570px;">
    @csrf
    <div class="mb-3">
      <label class="form-label fw-semibold">Name</label>
      <input type="text" name="name" class="form-control" placeholder="Enter menu item name" required>
    </div>

    <div class="mb-3">
      <label class="form-label fw-semibold">Category</label>
      <select name="category_id" class="form-select" required>
        <option value="">Select Category</option>
        @foreach($categories as $cat)
          <option value="{{ $cat->id }}">{{ $cat->name }}</option>
        @endforeach
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label fw-semibold">Price ($)</label>
      <input type="number" name="price" step="0.01" class="form-control" placeholder="0.00" required>
    </div>

    <div class="mb-3">
      <label class="form-label fw-semibold">Stock</label>
      <input type="number" name="stock" class="form-control" placeholder="0" required>
    </div>

    <div class="mb-3">
      <label class="form-label fw-semibold">Image</label>
      <input type="file" name="image" class="form-control" accept="image/*" onchange="previewImage(event)">
      <small class="text-muted">Optional. Supported formats: jpeg, png, jpg, gif.</small>
      <div class="mt-2">
        <img id="imagePreview" style="display:none; width:120px; height:120px; object-fit: cover; border-radius: 8px;">
      </div>
    </div>

    <button class="btn btn-success w-100 mt-3">Save</button>
  </form>
</div>

<script>
function previewImage(event) {
    const input = event.target;
    const preview = document.getElementById('imagePreview');

    if(input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection



<style>
  @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

  body {
    font-family: 'Inter', sans-serif;
    font-size: 20px;
    color: #222;
    background-color: #f8fafc;
  }

  h3.fw-bold {
    font-size: 28px;
    color: #111;
    letter-spacing: 0.5px;
  }

  .form-label {
    font-size: 18px;
  }

  /* --- Input/Select Base Styling --- */
  .form-control, 
  .form-select {
    border-radius: 8px;
    padding: 10px 12px;
    font-size: 18px;
    transition: all 0.2s ease-in-out;
    color: #333; /* default text color */
    border: 2px solid #ccc; /* default border */
    outline: none !important; /* Force removal of standard outline */
    box-shadow: none !important; /* Force removal of default blue shadow/glow */
  }

  /* --- Hover and Focus Overrides (for black styling) --- */
  .form-control:hover,
  .form-control:focus,
  .form-select:hover,
  .form-select:focus {
    color: #000; 
    /* Set border to solid black on focus/hover */
    border: 2px solid #000 !important; 
    /* Apply your custom black shadow */
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.3) !important;
    /* Re-enforce removal of outline */
    outline: none !important;
  }
  
  /* You may also want to target the :active state */
  .form-control:active,
  .form-select:active {
      box-shadow: none !important;
  }

  .btn-success {
    color: white;
    border: none;
    border-radius: 10px;
    padding: 12px 0;
    font-weight: 600;
    font-size: 18px;
    background-color: #198754; /* Add a default green color if not defined */
    transition: all 0.2s ease-in-out;
  }
  .btn-success:hover {
    transform: scale(1.05);
    box-shadow: 0 3px 18px rgba(154, 245, 163, 0.4);
  }

  form.shadow-sm {
    background: white;
    border-radius: 12px;
    padding: 30px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
  }
</style>