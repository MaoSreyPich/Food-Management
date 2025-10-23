@extends('layout.app')
@section('title', 'Menu Management')

@section('content')
<div class="container-fluid py-4 ">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold" style="font-family: sans-serif;">📋 Food Menu</h2>
    <button class="btn btn-success " data-bs-toggle="modal" data-bs-target="#addMenuModal">+ Add Item</button>
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
        <th>Subtitle</th>
        <th>Description</th>
        <th>Category</th>
        <th>Price ($)</th>
        <th>Stock</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse($menus as $index => $menu)
      <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $menu->name }}</td>
        <td>
          @if($menu->image)
          <img src="{{ $menu->image }}" alt="{{ $menu->name }}" width="60" height="60" style="object-fit:cover;border-radius:8px;">
          @else
          <span class="text-muted">No Image</span>
          @endif
        </td>
        <td>
          <div class="scroll-cell">{{ $menu->subtitle }}</div>
        </td>
        <td>
          <div class="scroll-cell">{{ $menu->description  }}</div>
        </td>
        <td>{{ $menu->category->name ?? 'N/A' }}</td>
        <td>{{ number_format($menu->price, 2) }}</td>
        <td>{{ $menu->stock }}</td>
        <td>
          <!-- Edit Button -->
          <button
            class="btn btn-md btn-outline-warning me-2 editMenuBtn"
            data-bs-toggle="modal"
            data-bs-target="#editMenuModal"
            data-id="{{ $menu->id }}"
            data-name="{{ $menu->name }}"
            data-subtitle="{{ $menu->subtitle }}"
            data-description="{{ $menu->description }}"
            data-price="{{ $menu->price }}"
            data-stock="{{ $menu->stock }}"

            data-image="{{ asset($menu->image) }}">Edit
          </button>
          <!-- Delete Button -->
          <button class="btn btn-md btn-outline-danger me-2" data-bs-toggle="modal" data-bs-target="#deleteMenuModal" data-id="{{ $menu->id }}" data-name="{{ $menu->name }}">Delete</button>


        </td>
      </tr>
      @empty
      <tr>
        <td colspan="9" class="text-muted text-center">No food items found</td>
      </tr>
      @endforelse
    </tbody>
  </table>
    <div class="col-sm-6 d-flex py-4 justify-content-end">
        {{ $menus->links('pagination::bootstrap-5') }}
    </div>
</div>

<!-- Modal: Add -->
<div class="modal fade" id="addMenuModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content border-dark rounded-4">
      <form action="{{ route('admin.menu.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-header bg-light text-dark justify-content-center position-relative">
          <h3 class="m-0">Add Menu Item</h3>
          <button type="button" class="btn-close position-absolute end-0 me-3" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label fw-semibold">Name</label>
              <input type="text" name="name" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label fw-semibold">Subtitle</label>
              <input type="text" name="subtitle" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label fw-semibold">Description</label>
              <input type="text" name="description" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label fw-semibold">Price ($)</label>
              <input type="number" step="0.01" name="price" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label fw-semibold">Stock</label>
              <input type="number" name="stock" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label fw-semibold">Category</label>
              <select name="category_id" class="form-select" required>
                <option value="">Select Category</option>
                @foreach($categories as $cat)
                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
              </select>
            </div>

            <!-- 🖼️ Image Input + Preview -->
            <div class="col-12">
              <label class="form-label fw-semibold">Image</label>
              <input type="file" name="image" class="form-control" id="addImageInput" accept="image/*">
              <div class="mt-3 text-center">
                <img id="addImagePreview" src="#" alt="Preview" class="img-fluid rounded" style="max-height:180px; display:none;">
              </div>
            </div>

          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
          <button class="btn btn-success">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal: Edit -->
<div class="modal fade" id="editMenuModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content border-dark rounded-4">
      <form method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="id">

        <div class="modal-header bg-light text-dark justify-content-center position-relative">
          <h3 class="m-0">Edit Menu Item</h3>
          <button type="button" class="btn-close position-absolute end-0 me-3" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label fw-semibold">Name</label>
              <input type="text" name="name" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label fw-semibold">Subtitle</label>
              <input type="text" name="subtitle" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label fw-semibold">Description</label>
              <input type="text" name="description" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label fw-semibold">Category</label>
              <select name="category_id" class="form-select" required>
                @foreach($categories as $cat)
                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label fw-semibold">Price ($)</label>
              <input type="number" step="0.01" name="price" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label fw-semibold">Stock</label>
              <input type="number" name="stock" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label fw-semibold">Image</label>
              <input type="file" name="image" class="form-control">
              <img id="editImagePreview" src="" alt="Preview" style="display:none; margin-top:10px; width:80px; height:80px; object-fit:cover; border-radius:8px;">
            </div>
          </div>
        </div>

        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
          <button class="btn btn-success">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteMenuModal" tabindex="-1" aria-labelledby="deleteMenuModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="max-width: 28%;">
    <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden" style="background: #ffffff;">
      <form id="deleteForm" method="POST">
        @csrf
        @method('DELETE')
        <div class="modal-header bg-light text-dark d-flex justify-content-center position-relative">
          <h3 class="modal-title fw-bold m-0" style="font-family: sans-serif;" id="deleteMenuModalLabel">Delete Menu</h3>
          <button type="button" class="btn-close position-absolute end-0 me-3" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
          <p class="fs-5 text-dark">Are you sure you want to delete <strong id="deleteMenuName"></strong>?</p>
        </div>
        <div class="modal-footer justify-content-center">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>


<script>
  document.addEventListener('DOMContentLoaded', function() {
    const editModal = document.getElementById('editMenuModal');
    const nameInput = editModal.querySelector('input[name="name"]');
    const subtitleInput = editModal.querySelector('input[name="subtitle"]');
    const descriptionInput = editModal.querySelector('input[name="description"]');
    const categorySelect = editModal.querySelector('select[name="category_id"]');
    const priceInput = editModal.querySelector('input[name="price"]');
    const stockInput = editModal.querySelector('input[name="stock"]');
    const imagePreview = editModal.querySelector('#editImagePreview');
    const idInput = editModal.querySelector('input[name="id"]');
    const form = editModal.querySelector('form');

    // Preview selected image when adding
    const addImageInput = document.getElementById('addImageInput');
    const addImagePreview = document.getElementById('addImagePreview');

    addImageInput.addEventListener('change', function() {
      const file = this.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = e => {
          addImagePreview.src = e.target.result;
          addImagePreview.style.display = 'block';
        };
        reader.readAsDataURL(file);
      }
    });
    // Preview selected image when editing
    const editImageInput = editModal.querySelector('input[name="image"]');
    editImageInput.addEventListener('change', function() {
      const file = this.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = e => {
          imagePreview.src = e.target.result;
          imagePreview.style.display = 'block';
        };
        reader.readAsDataURL(file);
      }
    });


    // When edit button clicked
    document.querySelectorAll('.editMenuBtn').forEach(btn => {
      btn.addEventListener('click', function() {
        const id = this.dataset.id;
        const name = this.dataset.name;
        const subtitle = this.dataset.subtitle;
        const description = this.dataset.description;
        const price = this.dataset.price;
        const stock = this.dataset.stock;
        const image = this.dataset.image;
        const categoryId = this.dataset.categoryId;

        idInput.value = id;
        nameInput.value = name;
        subtitleInput.value = subtitle;
        descriptionInput.value = description;
        priceInput.value = price;
        stockInput.value = stock;
        categorySelect.value = categoryId;

        if (image && imagePreview) {
          imagePreview.src = image;
          imagePreview.style.display = 'block';
        } else {
          imagePreview.style.display = 'none';
        }



        form.action = `/admin/menu/${id}`;
      });
    });

    const deleteModal = document.getElementById('deleteMenuModal');
    deleteModal.addEventListener('show.bs.modal', function(event) {
      const button = event.relatedTarget;
      const id = button.getAttribute('data-id');
      const name = button.getAttribute('data-name');
      const form = document.getElementById('deleteForm');

      document.getElementById('deleteMenuName').textContent = name;
      form.action = `/admin/menu/${id}`;
    });


  });
</script>

@endsection

<style>
  /* Import a modern, clean Google Font */
  @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

  .container-fluid{
    margin-left: 30px;
  }

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
    font-size: 25px;
    text-transform: uppercase;
  }

  .table td {
    font-size: 19px;
    vertical-align: middle;
  }

  .scroll-cell::-webkit-scrollbar {
    height: 6px;
  }

  .scroll-cell::-webkit-scrollbar-thumb {
    background: #ccc;
    border-radius: 4px;
  }

  .scroll-cell::-webkit-scrollbar-thumb:hover {
    background: #999;
  }

  .scroll-cell {
    max-width: 250px;
    overflow-x: auto;
    white-space: nowrap;
    display: block;
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

  /* Target the pagination links container for styling */
  .col-sm-6.justify-content-end nav {
      /* Optional: Ensure the pagination navigation element respects the flexbox container */
      margin: 0;
      padding: 0;
  }

  /* Base Pagination Container Styling (ul element) */
  .col-sm-6.justify-content-end .pagination {
      display: flex;
      gap: 0.5rem;
      margin-left: 20px;
  }

  .col-sm-6.justify-content-end .pagination .page-item {
      list-style: none;
  }

  /* Pagination Link Base Style (a or span element) */
  .col-sm-6.justify-content-end .pagination .page-link {
      color: #000;
      background-color: #fff;
      border: 2px solid #000;
      padding: 0.75rem 1.25rem;
      font-weight: 400; 
      text-decoration: none;
      transition: all 0.3s ease;
      border-radius: 0.5rem;
      display: flex;
      align-items: center;
      justify-content: center;
      min-width: 1.35rem;
      line-height: 1; /* Essential for vertical alignment */
  }

  /* Hover State */
  .col-sm-6.justify-content-end .pagination .page-link:hover {
      color: #fff;
      background-color: #000;
      border-color: #000;
      transform: none; /* No vertical movement on hover */
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
  }

  /* Active State */
  .col-sm-6.justify-content-end .pagination .page-item.active .page-link {
      color: #fff;
      background-color: #000;
      border-color: #000;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
  }

  /* Disabled State */
  .col-sm-6.justify-content-end .pagination .page-item.disabled .page-link {
      color: #999;
      background-color: #f5f5f5;
      border-color: #ddd;
      cursor: not-allowed;
      opacity: 0.8;
  }

  .col-sm-6.justify-content-end .pagination .page-item.disabled .page-link:hover {
      transform: none;
      box-shadow: none;
      background-color: #f5f5f5;
      color: #999;
  }

  /* Focus State */
  .col-sm-6.justify-content-end .pagination .page-link:focus {
      outline: 2px solid #000;
      outline-offset: 2px;
      box-shadow: none;
  }

  /* IMPORTANT: Hide the result count that Laravel generates inside the pagination block */
  .col-sm-6.justify-content-end nav > div:first-child p.text-sm {
      display: none !important;
  }
</style>