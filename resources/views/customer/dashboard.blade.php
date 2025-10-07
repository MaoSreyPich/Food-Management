@extends('layout.app')

@section('content')
<div class="container py-4">
  <h2 class="fw-bold mb-4">Welcome, {{ Auth::user()->name }} 👋</h2>
  <p>Browse our menu and place your order!</p>
</div>
@endsection
