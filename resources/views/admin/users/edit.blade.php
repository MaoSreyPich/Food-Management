@extends('layout.app')

@section('content')
<div class="container py-4">
  <h3 class="fw-bold mb-4 text-center">✏️ Edit User: {{ $user->name }}</h3>

  <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="shadow-sm p-4 rounded-4 bg-white mx-auto" style="max-width: 500px;">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label class="form-label fw-semibold">Role</label>
      <select name="role" class="form-select" required>
          <option value="0" @if($user->role=='0') selected @endif>User</option>
          <option value="1" @if($user->role=='1') selected @endif>Admin</option>
      </select>

    </div>

    <div class="mb-3">
      <label class="form-label fw-semibold">Status</label>
      <select name="status" class="form-select" required>
        <option value="active" @if($user->status=='active') selected @endif>Active</option>
        <option value="blocked" @if($user->status=='blocked') selected @endif>Blocked</option>
      </select>
    </div>

    <div class="d-flex justify-content-between pt-2">
      <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">Cancel</a>
      <button class="btn btn-success">Update User</button>
    </div>
  </form>
</div>
@endsection
