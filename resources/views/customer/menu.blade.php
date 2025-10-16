@extends('layout.customer')

@section('title', 'Menu')

@section('content')
    <div class="container">
        <h1>Our Menu</h1>

        @if(isset($menus) && count($menus))
            <div class="row">
                @foreach ($menus as $menu)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="{{ asset('storage/' . $menu->image) }}" class="card-img-top" alt="{{ $menu->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $menu->name }}</h5>
                                <p class="card-text">${{ $menu->price }}</p>
                                <a href="{{ route('customer.cart.add', $menu->id) }}" class="btn btn-primary">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>No menu items found.</p>
        @endif
    </div>
@endsection
