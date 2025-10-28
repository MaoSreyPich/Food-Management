@extends('layout.app')

@section('content')
<div class="container-fluid py-4">
    <h2 class="fw-bold mb-5 text-center" style="font-family: sans-serif;">👤 Manage Users</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-hover align-middle text-center">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $index => $user)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    {{ $user->role == 1 ? 'Admin' : 'User' }}
                </td>
                <td>
                    <span class="badge {{ $user->status === 'active' ? 'bg-success' : 'bg-danger' }}">
                        {{ ucfirst($user->status) }}
                    </span>
                </td>
                <td>
                    <form action="{{ route('admin.users.toggle', $user->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        <button class="btn btn-md {{ $user->status === 'active' ? 'btn-danger' : 'btn-success' }}">
                            {{ $user->status === 'active' ? 'Block' : 'Unblock' }}
                        </button>
                    </form>
                
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-md">
                        Edit
                    </a>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
        <div class="col-sm-6 d-flex py-4 justify-content-end">
        {{ $users->links('pagination::bootstrap-5') }}
        </div>
</div>
@endsection

<style>
  /* Import a modern, clean Google Font */
  @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
  
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
    font-size:26px ;
    text-transform: uppercase;
  }
  
  .table td {
    font-size: 20px;
    vertical-align: middle;
  }
  
  h2.fw-bold {
    font-size: 28px;
    color: #111;
    letter-spacing: 0.5px;
  }
  .table td:last-child button {
    margin-top: 15px;
   }
  .table td a.btn-warning {
    margin-top: 15px;
   }
  .table td a.btn-warning:hover{
    background-color: orange;
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
