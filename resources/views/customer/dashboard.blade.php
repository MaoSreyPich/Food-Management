@extends('layout.customer') <!-- Use the new customer layout -->

@section('title','Customer Dashboard')

@section('content')
<div class="text-center py-4">
  <h2 class="fw-bold mb-4">Welcome, {{ Auth::user()->name }} 👋</h2>
  <p>Browse our menu and place your order!</p>
</div>
@endsection
