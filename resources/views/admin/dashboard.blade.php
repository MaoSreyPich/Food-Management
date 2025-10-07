@extends('layout.app')

@section('content')
<div class="container py-5">
  <h2 class="fw-bold mb-5 text-center text-gradient">Welcome to the Admin Dashboard 👋</h2>

  <div class="row g-4 justify-content-center">
    <!-- Manage Menu -->
    <div class="col-md-4">
      <div class="card dashboard-card shadow-lg border-0 rounded-4">
        <div class="card-body text-center py-5">
          <div class="icon-wrapper bg-primary-subtle text-primary mb-3">
            🍽
          </div>
          <h5 class="card-title fw-bold mb-2">Manage Menu</h5>
          <p class="text-muted mb-4">Add, edit, or delete food categories and menu items.</p>
          <a href="{{ route('admin.manage-menu') }}" class="btn btn-gradient w-100">
            Go to Manage Menu
          </a>
        </div>
      </div>
    </div>

    <!-- Orders -->
    <div class="col-md-4">
      <div class="card dashboard-card shadow-lg border-0 rounded-4">
        <div class="card-body text-center py-5">
          <div class="icon-wrapper bg-success-subtle text-success mb-3">
            🧾
          </div>
          <h5 class="card-title fw-bold mb-2">Orders</h5>
          <p class="text-muted mb-4">View and manage all customer orders.</p>
          <a href="#" class="btn btn-gradient w-100">
            View Orders
          </a>
        </div>
      </div>
    </div>

    <!-- Users -->
    <div class="col-md-4">
      <div class="card dashboard-card shadow-lg border-0 rounded-4">
        <div class="card-body text-center py-5">
          <div class="icon-wrapper bg-warning-subtle text-warning mb-3">
            👤
          </div>
          <h5 class="card-title fw-bold mb-2">Users</h5>
          <p class="text-muted mb-4">Manage registered users and block/unblock access.</p>
          <a href="#" class="btn btn-gradient w-100">
            Manage Users
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
  body {
    background: linear-gradient(135deg, #f8f9fc, #e8ecf4);
    font-family: 'Poppins', sans-serif;
  }

  .text-gradient {
    background: linear-gradient(90deg, #6a11cb, #2575fc);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }

  .dashboard-card {
    transition: all 0.3s ease;
  }

  .dashboard-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 24px rgba(37, 117, 252, 0.2);
  }

  .icon-wrapper {
    font-size: 3rem;
    width: 90px;
    height: 90px;
    margin: 0 auto;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .btn-gradient {
    background: linear-gradient(90deg, #6a11cb, #2575fc);
    color: white;
    border: none;
    border-radius: 8px;
    padding: 10px 16px;
    font-weight: 600;
    transition: all 0.3s ease;
  }

  .btn-gradient:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 20px rgba(37, 117, 252, 0.4);
  }
</style>
@endsection
