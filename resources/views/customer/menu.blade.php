@extends('layout.customer')

@section('title', 'Our Menu')

@section('content')
<div class="container py-5">
    <h1 class="fw-bold">Our Menu</h1>
    <p class="text-foodhub-text-muted mb-4">Discover delicious dishes from our curated selection</p>

    @if(session('success'))
        <div class="alert alert-success text-center">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        </div>
    @endif

    {{-- Category Tabs --}}
    @php
        // Keys match your database category names (lowercase)
        $categories = [
            'all' => 'All Items',
            'food' => 'Food',
            'drink' => 'Drink',
            'snack' => 'Snack'
        ];
    @endphp

    <ul class="nav nav-pills mb-5 menu-tabs" role="tablist">
        @foreach($categories as $key => $name)
            <li class="nav-item">
                <a class="nav-link @if($key == 'all') active @endif" data-bs-toggle="pill" href="#{{ $key }}">
                    {{ $name }}
                </a>
            </li>
        @endforeach
    </ul>

    {{-- Tab Content --}}
    <div class="tab-content">
        @foreach($categories as $key => $name)
            <div class="tab-pane fade @if($key == 'all') show active @endif" id="{{ $key }}">
                <div class="row row-cols-1 row-cols-md-4 g-4">
                    @php
                        $items = $key == 'all'
                            ? $menus
                            : $menus->filter(fn($m) => $m->category && strtolower($m->category->name) === strtolower($key));
                    @endphp

                    @if($items->isEmpty() && $key != 'all')
                        <p class="text-center w-100">No items found in this category.</p>
                    @endif

                    @foreach($items as $menu)
                        <div class="col">
                            <div class="card menu-card border-0 h-100">
                                <img src="{{ $menu->image }}" class="card-img-top menu-card-img" alt="{{ $menu->name }}"  style="height: 300px; object-fit: cover; width: 100%;">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold">{{ $menu->name }}</h5>
                                    <p class="card-text text-foodhub-text-muted mb-3">
                                        {{ Str::limit($menu->description ?? 'Delicious item description.', 50) }}
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="item-price mb-0">${{ number_format($menu->price, 2) }}</p>
                                        <a href="{{ route('customer.cart.add', $menu->id) }}" class="btn btn-warning">Add to Cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
    <div class="col-sm-6 d-flex py-5 justify-content-end">
        {{ $menus->links('pagination::bootstrap-5') }}
    </div>
</div>

{{-- Styles --}}
<style>
    .menu-tabs {
        background-color: #f8f8f6;
        border-radius: 12px;
        padding: 6px;
        display: flex;
        justify-content: space-around;
    }
    .menu-tabs .nav-link {
        color: #000;
        font-weight: 600;
        border-radius: 10px;
        padding: 10px 24px;
        transition: all 0.2s ease;
    }
    .menu-tabs .nav-link.active {
        background-color: #f05b5bff;
        color: #fff !important;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }
    .menu-tabs .nav-link:not(.active):hover {
        background-color: #eee;
    }
    .menu-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .menu-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }
    .menu-card-img {
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        object-fit: cover;
        height: 180px;
    }
    .btn-cta {
        border-radius: 50px;
        font-weight: 600;
        padding: 0.4rem 1rem;
    }

    .page-arrow, .page-number {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.5rem 1rem;
        font-size: 0.9rem;
        font-weight: 500;
        text-decoration: none;
        border-radius: 0.5rem; /* Pill-like shape */
        transition: background-color 0.2s, color 0.2s;
    }

    .page-arrow.active-arrow {
        color: #007bff;
        background-color: transparent;
        border: 1px solid #007bff;
    }

    .page-arrow.active-arrow:hover {
        background-color: #007bff;
        color: white;
    }

    .page-arrow.disabled-arrow {
        color: #adb5bd;
        cursor: not-allowed;
        border: 1px solid #dee2e6;
    }

    .page-number {
        width: 2.25rem;
        height: 2.25rem;
        padding: 0;
    }

    .page-number.active-number {
        background-color: #212529; /* Dark active background */
        color: white;
    }

    .page-number.link-number {
        color: #495057;
    }

    .page-number.link-number:hover {
        background-color: #f8f9fa;
        color: #212529;
    }

    .page-number.dots {
        color: #6c757d;
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

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection
