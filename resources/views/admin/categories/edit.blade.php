@extends('layout.app')

@section('content')
<div class="container py-4">
  <h3 class="fw-bold mb-4 text-center" style="font-family: 'Inter', sans-serif;">✏️ Edit Category: {{ $category->name }}</h3>
  
  {{-- The form uses PUT method for updating the resource --}}
  <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" class="shadow-sm p-4 rounded-4 bg-gray-900 mx-auto" style="max-width: 570px;">
    @csrf
    @method('PUT') 
    
    <div class="mb-3 ">
      <label class="form-label fw-semibold">Category Name</label>
      {{-- Pre-fill the input with the current category name --}}
      <input type="text" name="name" class="form-control" value="{{ old('name', $category->name) }}" required>
      @error('name')
        <div class="text-danger mt-2">{{ $message }}</div>
      @enderror
    </div>
    
    <div class="d-flex justify-content-between pt-2">
        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">
            Cancel
        </a>
        <button class="btn btn-success">Update Category</button>
    </div>
  </form>
</div>
@endsection

<style>
  /* Import a modern, clean Google Font */
  @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

  body {
    font-family: 'Inter', sans-serif;
    font-size: 20px;
    color: #222;
    background-color: #f8fafc; /* Light gray background */
  }

  h3.fw-bold {
    font-size: 28px;
    color: #111;
    letter-spacing: 0.5px;
  }

  .form-label {
    font-size: 18px;
    font-weight: 600; /* Use fw-semibold class from HTML */
  }

  /* --- Input Base Styling --- */
  .form-control {
    border-radius: 8px;
    padding: 10px 12px;
    font-size: 18px;
    transition: all 0.2s ease-in-out;
    color: #333; /* default text color */
    border: 5px solid #282828ff; /* default border */
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

  /* --- Button Styling (Success/Update) --- */
  .btn-success {
    color: white;
    border: none;
    border-radius: 10px;
    padding: 12px 20px; 
    font-weight: 600;
    font-size: 18px;
    background-color: #198754; 
    transition: all 0.2s ease-in-out;
  }
  .btn-success:hover {
    transform: scale(1.02); 
    box-shadow: 0 4px 15px rgba(25, 135, 84, 0.4); 
  }
  
  /* --- Button Styling (Cancel/Outline Secondary) --- */
  .btn-outline-secondary {
    border: 2px solid #6c757d;
    color: #6c757d;
    font-weight: 600;
    border-radius: 8px;
    transition: all 0.2s ease-in-out;
    padding: 12px 20px;
  }
  .btn-outline-secondary:hover {
    background-color: #6c757d;
    color: white;
  }


  /* --- Form Container Styling --- */
  form.shadow-sm {
    background: white;
    border-radius: 12px;
    padding: 30px;
    box-shadow: 4px 4px 4px 12px rgba(0,0,0,0.05);
  }
</style>
