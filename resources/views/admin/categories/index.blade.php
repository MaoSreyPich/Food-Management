@extends('layout.app')

@section('content')
<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold" style="font-family: sans-serif;">📂 Categories</h3>
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal">+ Add Category</button>
  </div>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <table class="table table-hover align-middle text-center">
    <thead class="table-dark">
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
            <!-- Edit Button -->
            <button  class="btn btn-md btn-outline-warning me-2" data-bs-toggle="modal" data-bs-target="#editModal" data-id="{{ $category->id }}" data-name="{{ $category->name }}">Edit</button>
            <!-- Delete Button -->
            <button  class="btn btn-md btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $category->id }}" data-name="{{ $category->name }}">Delete</button>
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

<!--  Add Modal -->
  <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 30%;">
      <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden" style="background: #ffffff;">
        <form action="{{ route('admin.categories.store') }}" method="POST">
          @csrf
          <div class="modal-header bg-light text-dark d-flex justify-content-center position-relative">
            <h3 class="modal-title fw-bold m-0" style="font-family: sans-serif;" id="addModalLabel">Add Category</h3>
            <button type="button" class="btn-close position-absolute end-0 me-3" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label fw-semibold">Category Name</label>
              <input type="text" name="name" class="form-control" placeholder="e.g., Food, Drink, Snack" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-success">Add</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<!--  Add Modal -->

<!--  Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="max-width: 30%;">
    <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden" style="background: #ffffff;">
      <form id="editForm" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-header bg-light text-dark d-flex justify-content-center position-relative">
          <h3 class="modal-title fw-bold m-0" style="font-family: sans-serif;" id="editModalLabel">Edit Category</h3>
          <button type="button" class="btn-close position-absolute end-0 me-3" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label fw-semibold">Category Name</label>
            <input type="text" name="name" id="categoryName" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-success">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!--  Edit Modal -->


<!--  Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="max-width: 28%;">
    <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden" style="background: #ffffff;">
      <form id="deleteForm" method="POST">
        @csrf
        @method('DELETE')
        <div class="modal-header bg-light text-dark d-flex justify-content-center position-relative">
          <h3 class="modal-title fw-bold m-0" style="font-family: sans-serif;" id="deleteModalLabel">Delete Category</h3>
          <button type="button" class="btn-close position-absolute end-0 me-3" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
          <p class="fs-5 text-dark">Are you sure you want to delete <strong id="deleteCategoryName"></strong>?</p>
        </div>
        <div class="modal-footer justify-content-center">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!--  Delete Modal -->


@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  // 🟢 Edit Modal
  const editModal = document.getElementById('editModal');
  editModal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;
    const id = button.getAttribute('data-id');
    const name = button.getAttribute('data-name');
    const form = document.getElementById('editForm');
    form.action = `/admin/categories/${id}`;
    document.getElementById('categoryName').value = name;
  });

  // 🔴 Delete Modal
  const deleteModal = document.getElementById('deleteModal');
  deleteModal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;
    const id = button.getAttribute('data-id');
    const name = button.getAttribute('data-name');
    const form = document.getElementById('deleteForm');
    document.getElementById('deleteCategoryName').textContent = name;
    form.action = `/admin/categories/${id}`;
  });
});
</script>
@endpush

<style>
  @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
  
  body {
    font-family: 'Inter', sans-serif;
    font-size: 20px;
    color: #222;
    background-color: #f8fafc;
  }

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
    font-size: 20px;
    text-transform: uppercase;
  }

  .table td {
    font-size: 18px;
    vertical-align: middle;
  }

  h3.fw-bold {
    font-size: 28px;
    color: #111;
    letter-spacing: 0.5px;
  }

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
    font-size: 18px;
    font-weight: 600;
    transition: all 0.2s ease-in-out;
  }
  .btn-success:hover {
    transform: scale(1.05);
    box-shadow: 0 3px 18px rgba(154, 245, 163, 0.4);
  }
</style>
