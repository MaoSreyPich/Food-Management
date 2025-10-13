@extends('layout.app')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-4 text-center" style="font-family: sans-serif;">👤 Manage Users</h2>

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
    font-size:20px ;
    text-transform: uppercase;
  }
  
  .table td {
    font-size: 18px;
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


</style> 
