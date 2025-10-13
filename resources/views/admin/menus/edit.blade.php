@extends('layout.app')

@section('content')
<div class="container py-4">
  <h3 class="fw-bold mb-4 text-center" style="font-family: 'Inter', sans-serif;">✏️ Edit Menu Item: {{ $menu->name }}</h3>

  <form action="{{ route('admin.menu.update', $menu->id) }}" method="POST" enctype="multipart/form-data" class="shadow-sm p-4 rounded-4 bg-white mx-auto" style="max-width: 570px;" id="menuForm">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label class="form-label fw-semibold">Name</label>
      <input type="text" name="name" class="form-control" placeholder="Enter menu item name" value="{{ old('name', $menu->name) }}" required>
    </div>

    {{-- Category select (your custom select code) --}}
    <div class="mb-3">
      <label class="form-label fw-semibold">Category</label>
      <input type="hidden" name="category_id" id="category_id_hidden" required>
      <div class="custom-select-wrapper">
        <div class="custom-select-display form-select" tabindex="0" data-placeholder="Select Category"></div>
        <div class="custom-select-options">
          <div class="custom-option @if(old('category_id', $menu->category_id) == '') selected @endif" data-value="">Select Category</div>
          @foreach($categories as $cat)
            <div class="custom-option @if($cat->id == old('category_id', $menu->category_id)) selected @endif" data-value="{{ $cat->id }}">{{ $cat->name }}</div>
          @endforeach
        </div>
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label fw-semibold">Price ($)</label>
      <input type="number" name="price" step="0.01" class="form-control" placeholder="0.00" value="{{ old('price', $menu->price) }}" required>
    </div>

    <div class="mb-3">
      <label class="form-label fw-semibold">Stock</label>
      <input type="number" name="stock" class="form-control" placeholder="0" value="{{ old('stock', $menu->stock) }}" required>
    </div>

    {{-- Image Upload --}}
    <div class="mb-3">
      <label class="form-label fw-semibold">Image</label>
      @if($menu->image)
        <div class="mb-2">
          <img src="{{ asset($menu->image) }}" alt="{{ $menu->name }}" width="120" height="120" style="object-fit: cover; border-radius: 8px;" id="currentImage">
        </div>
      @endif
      <input type="file" name="image" class="form-control" accept="image/*" onchange="previewImage(event)">
      <small class="text-muted">Optional. Supported formats: jpeg, png, jpg, gif.</small>
      <div class="mt-2">
        <img id="imagePreview" style="display:none; width:120px; height:120px; object-fit: cover; border-radius: 8px;">
      </div>
    </div>

    <div class="d-flex justify-content-between pt-2">
        <a href="{{ route('admin.menu.index') }}" class="btn btn-outline-secondary">
            Cancel
        </a>
        <button class="btn btn-success">Update Menu Item</button>
    </div>
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

// --- Your custom select script remains unchanged ---
document.addEventListener('DOMContentLoaded', () => {
    const display = document.querySelector('.custom-select-display');
    const optionsContainer = document.querySelector('.custom-select-options');
    const hiddenInput = document.getElementById('category_id_hidden');
    const options = optionsContainer.querySelectorAll('.custom-option');
    const initialPlaceholder = display.getAttribute('data-placeholder');

    const initialSelectedOption = optionsContainer.querySelector('.custom-option.selected');
    if (initialSelectedOption) {
        hiddenInput.value = initialSelectedOption.getAttribute('data-value');
        display.textContent = initialSelectedOption.textContent.trim();
    } else {
        display.textContent = initialPlaceholder;
        hiddenInput.value = "";
    }

    display.addEventListener('click', () => {
        const isClosed = optionsContainer.style.display === 'none' || optionsContainer.style.display === '';
        optionsContainer.style.display = isClosed ? 'block' : 'none';
        display.classList.toggle('open', isClosed);
    });

    options.forEach(option => {
        option.addEventListener('click', () => {
            options.forEach(opt => opt.classList.remove('selected'));
            option.classList.add('selected');
            hiddenInput.value = option.getAttribute('data-value');
            display.textContent = option.textContent.trim();
            optionsContainer.style.display = 'none';
            display.classList.remove('open');
            display.focus();
        });
    });

    document.addEventListener('click', (e) => {
        if (!display.contains(e.target) && !optionsContainer.contains(e.target)) {
            optionsContainer.style.display = 'none';
            display.classList.remove('open');
        }
    });
});
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
  .custom-select-display:focus {
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

  /* --- Custom Dropdown Styling (The fix for the blue color) --- */
  .custom-select-wrapper {
      position: relative;
  }

  .custom-select-display {
      cursor: pointer;
      display: flex;
      justify-content: space-between;
      align-items: center;
  }

  .custom-select-display::after {
      content: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
      display: inline-block;
      width: 1rem;
      height: 1rem;
      margin-left: 0.5rem;
      vertical-align: middle;
      pointer-events: none;
  }

  .custom-select-options {
      display: none;
      position: absolute;
      top: 100%; 
      left: 0;
      right: 0;
      z-index: 1000;
      background-color: white;
      border: 2px solid #000; 
      border-top: none;
      border-radius: 0 0 8px 8px;
      max-height: 200px;
      overflow-y: auto;
      box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
  }

  .custom-option {
      padding: 10px 12px;
      cursor: pointer;
      font-size: 18px;
      transition: background-color 0.1s ease;
      color: #333; 
  }

  /* The fix: Black background on hover! */
  .custom-option:hover {
      background-color: #000 !important; 
      color: white !important;
  }
  
  .custom-select-display.open {
      border-bottom-left-radius: 0;
      border-bottom-right-radius: 0;
      border-bottom: 2px solid #000 !important; 
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
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
  }
</style>

