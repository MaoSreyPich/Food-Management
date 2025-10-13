@extends('layout.app')
@section('title', 'Dashboard Overview')

@section('content')
<div class="container-fluid">
  <h2 class="fw-bold mb-4 py-2" style="font-family: sans-serif;">Dashboard Overview</h2>

  {{-- Overview Cards --}}
  <div class="row g-4">
    <div class="col-md-3">
      <div class="overview-card">
        <div class="overview-icon">👥</div>
        <h4>Total Users</h4>
        <h4 class="fw-bold text-success">{{ $totalUsers }}</h4>
      </div>
    </div>

    <div class="col-md-3">
      <div class="overview-card">
        <div class="overview-icon">💰</div>
        <h4>Revenue</h4>
        <h4 class="fw-bold text-success">${{ number_format($totalRevenue, 2) }}</h4>
      </div>
    </div>

    <div class="col-md-3">
      <div class="overview-card">
        <div class="overview-icon">🧾</div>
        <h4>Orders</h4>
        <h4 class="fw-bold text-success">{{ $totalOrders }}</h4>
      </div>
    </div>

    <div class="col-md-3">
      <div class="overview-card">
        <div class="overview-icon">📋</div>
        <h4>Menu Items</h4>
        <h4 class="fw-bold text-success">{{ $totalMenuItems }}</h4>
      </div>
    </div>
  </div>

  {{-- Modern Graphs --}}
  <div class="row mt-5">
    <!-- Orders Trend Chart -->
    <div class="col-md-9 mb-10">
      <div class="card shadow-lg p-3 rounded-4">
        <h4 class="fw-bold mb-3">📈 Orders Trend (Last 7 Days)</h4>
        <canvas id="ordersChart" height="550"></canvas>
      </div>
    </div>

    <!-- Revenue Breakdown Chart -->
     <div class="col-md-3 mb-4"> <!-- smaller column -->
       <div class="card shadow-md p-2 rounded-4"> <!-- less padding -->
         <h4 class="fw-bold mb-2">💸 Revenue Breakdown</h4>
         <canvas id="revenueChart" height="100"></canvas> <!-- smaller canvas -->
       </div>
     </div>

  </div>
</div>

{{-- Chart.js CDN --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

{{-- Chart Scripts --}}
<script>
  // Orders Trend Chart (Line)
  const ordersCtx = document.getElementById('ordersChart').getContext('2d');
  const ordersChart = new Chart(ordersCtx, {
    type: 'line',
    data: {
      labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
      datasets: [{
        label: 'Orders',
        data: [12, 19, 8, 15, 22, 13, 17], // sample data
        borderColor: '#4CAF50',
        backgroundColor: 'rgba(76, 175, 80, 0.2)',
        fill: true,
        tension: 0.3,
        borderWidth: 2,
        pointRadius: 4,
        pointBackgroundColor: '#4CAF50'
      }]
    },
    options: {
      plugins: {
        legend: { display: false }
      },
      scales: {
        y: { beginAtZero: true, grid: { color: '#eee' } },
        x: { grid: { display: false } }
      }
    }
  });

  // Revenue Breakdown Chart (Doughnut)
  const revenueCtx = document.getElementById('revenueChart').getContext('2d');
  const revenueChart = new Chart(revenueCtx, {
    type: 'doughnut',
    data: {
      labels: ['Food', 'Drink', 'Snack'],
      datasets: [{
        data: [55, 30, 15], // sample data
        backgroundColor: ['#4CAF50', '#FFC107', '#03A9F4'],
        borderWidth: 0
      }]
    },
    options: {
      plugins: {
        legend: { position: 'bottom' }
      }
    }
  });
</script>
@endsection
