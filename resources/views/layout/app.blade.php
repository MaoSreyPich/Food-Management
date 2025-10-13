<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Admin Dashboard')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Add Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <!-- Add modern fonts (Poppins + Inter) -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <h2>Admin Panel</h2>
    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">🏠 Dashboard</a>
    <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">📦 Categories</a>
    <a href="{{ route('admin.menu.index') }}" class="{{ request()->routeIs('admin.menu.*') ? 'active' : '' }}">📋 Menu</a>
    <a href="{{ route('admin.orders.index') }}" class="{{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">🧾 Orders</a>
    <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">👤 Users</a>
  </div>

  <!-- Navbar -->
  <div class="navbar">
    <div>
      <input type="text" placeholder="Search...">
      <span class="ms-3">🔔</span>
    </div>
    <!-- Admin Dropdown -->
      <div class="dropdown">
      <button class="btn btn-outline-dark dropdown-toggle d-flex align-items-center gap-2" 
              type="button" id="adminMenu" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="bi bi-person-circle"></i> Admin
      </button>
      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="adminMenu">
        <li>
          <form action="{{ route('logout') }}" method="POST" class="px-3 py-1">
            @csrf
            <button type="submit" class="btn btn-link text-danger text-decoration-none p-0">
               Logout
            </button>
          </form>
        </li>
      </ul>
    </div>
  </div>
  <!-- Main content -->
  <div class="content">
    @yield('content')
  </div>
</body>
</html>

<style>
    /*  Only font and size changed */
    body {
      background-color: #ffffff;
      color: #000000;
      font-family: 'Inter', 'Poppins', sans-serif;
      font-size: 20px;
      display: flex;
      min-height: 100vh;
    }

    /* Sidebar */
    .sidebar {
      width: 250px;
      background-color: #f8f9fa;
      color: #000000;
      position: fixed;
      top: 0;
      bottom: 0;
      left: 0;
      padding: 20px 10px;
      border-right: 1px solid #e0e0e0;
    }

    .sidebar h2 {
      text-align: center;
      margin-bottom: 30px;
      font-weight: 700;
      font-family: 'Inter', 'Poppins', sans-serif;
    }

    .sidebar a {
      display: flex;
      align-items: center;
      gap: 10px;
      color: #333333;
      text-decoration: none;
      padding: 10px 15px;
      border-radius: 8px;
      margin: 5px 0;
      font-size: 19px;
      transition: all 0.3s ease;
    }

    .sidebar a:hover,
    .sidebar a.active {
      background-color: #000000;
      color: #ffffff;
    }

    /* Navbar */
    .navbar {
      background-color: #ffffff;
      position: fixed;
      left: 250px;
      top: 0;
      right: 0;
      z-index: 100;
      padding: 10px 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      color: #000000;
      box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
      border-bottom: 1px solid #e0e0e0;
    }

    .navbar input {
      background-color: #f8f9fa;
      color: #000000;
      border: 1px solid #e0e0e0;
      border-radius: 6px;
      padding: 6px 12px;
      width: 220px;
    }

    .navbar button {
      background-color: #000000;
      color: #ffffff;
      border: none;
      border-radius: 6px;
      padding: 5px 12px;
      font-family: 'Inter', 'Poppins', sans-serif;
    }

    /* Main content */
    .content {
      margin-left: 250px;
      margin-top: 70px;
      padding: 20px;
      flex-grow: 1;
    }

    /* Overview cards */
    .overview-card {
      background-color: #ffffff;
      border: 1px solid #e0e0e0;
      border-radius: 12px;
      padding: 25px;
      text-align: center;
      color: #000000;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease;
      font-family: 'Inter', 'Poppins', sans-serif;
    }

    .overview-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    /* Overview icons */
    .overview-icon {
      font-size: 2rem;
      margin-bottom: 10px;
      color: #000000;
    }

    /* Dropdown */   
    .dropdown-menu {
      min-width: 100px;
    }
    .dropdown-menu li {
      padding: 0px 1px;
    }
    .dropdown-menu li:hover {
      background-color: #f8f9fa;
    }
    .dropdown-menu li button {
      width: 100%;
      text-align: center;
      background: none;
      border: none;
      padding: 0;
      font-size: 16px;
      font-weight: 500;
      color: #dc3545; /* Bootstrap's danger color */
      cursor: pointer;
    }
    .dropdown-menu li button:hover {
      text-decoration: underline;
    }

    
</style>

