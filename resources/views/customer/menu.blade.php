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
                                {{-- ✅ Fix image path --}}
                                <img src="{{ asset($menu->image) }}" 
                                     class="card-img-top menu-card-img" 
                                     alt="{{ $menu->name }}"  
                                     style="height: 300px; object-fit: cover; width: 100%;">

                                <div class="card-body">
                                    <h5 class="card-title fw-bold">{{ $menu->name }}</h5>
                                    <p class="card-text text-foodhub-text-muted mb-3">
                                        {{ Str::limit($menu->description ?? 'Delicious item description.', 50) }}
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="item-price mb-0">${{ number_format($menu->price, 2) }}</p>
                                        <button 
                                            class="btn btn-warning add-to-cart-btn" 
                                            data-id="{{ $menu->id }}">
                                            Add to Cart
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

    {{-- Pagination --}}
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

    /* Pagination */
    .col-sm-6.justify-content-end .pagination {
        display: flex;
        gap: 0.5rem;
        margin-left: 20px;
    }
    .col-sm-6.justify-content-end .pagination .page-link {
        color: #000;
        background-color: #fff;
        border: 2px solid #000;
        padding: 0.75rem 1.25rem;
        font-weight: 400; 
        border-radius: 0.5rem;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    .col-sm-6.justify-content-end .pagination .page-link:hover {
        color: #fff;
        background-color: #000;
        border-color: #000;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    }
    .col-sm-6.justify-content-end .pagination .page-item.active .page-link {
        color: #fff;
        background-color: #000;
        border-color: #000;
    }
</style>
@endsection

{{-- ✅ Correct script placement --}}
@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    $(".add-to-cart-btn").click(function (e) {
        e.preventDefault();

        let button = $(this);
        let menuId = button.data("id");

                    $.ajax({
                            url: "{{ route('customer.cart.add.ajax') }}",
                            method: "POST",
                            data: {
                                    _token: "{{ csrf_token() }}",
                                    id: menuId
                            },
                            success: function (response) {
                                    // update cart count
                                    $("#cart-count").text(response.cart_count);

                                    // show bootstrap toast
                                                    var toastHtml = '' +
                                                            '<div class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">' +
                                                                '<div class="d-flex">' +
                                                                    '<div class="toast-body">' +
                                                                        response.message +
                                                                    '</div>' +
                                                                    '<button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>' +
                                                                '</div>' +
                                                            '</div>';

                                                    var $toast = $(toastHtml);
                                    $("#toast-container").append($toast);
                                    var toastEl = $toast.get(0);
                                    var bsToast = new bootstrap.Toast(toastEl, { delay: 2500 });
                                    bsToast.show();
                                    // remove after hidden
                                    $toast.on('hidden.bs.toast', function () { $(this).remove(); });
                            },
                            error: function () {
                                                    var errHtml = '' +
                                                            '<div class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">' +
                                                                '<div class="d-flex">' +
                                                                    '<div class="toast-body">Failed to add item to cart.</div>' +
                                                                    '<button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>' +
                                                                '</div>' +
                                                            '</div>';

                                                    var $err = $(errHtml);
                                    $("#toast-container").append($err);
                                    var errEl = $err.get(0);
                                    var bsErr = new bootstrap.Toast(errEl, { delay: 3000 });
                                    bsErr.show();
                                    $err.on('hidden.bs.toast', function () { $(this).remove(); });
                            }
                    });
    });
});
</script>
@endpush

{{-- Toast container (placed after scripts stack so it sits inside body) --}}
@push('scripts')
<div id="toast-container" class="position-fixed bottom-0 end-0 p-3" style="z-index: 1080;"></div>
@endpush
