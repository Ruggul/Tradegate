@extends('layouts.main')

@section('title', 'Welcome')

@section('content')
<!-- Hero Section -->
<section class="hero-section d-flex align-items-center">
    <div class="container text-center">
        <h1 class="display-4 mb-4">Welcome to Our Platform</h1>
        <p class="lead mb-4">Your one-stop solution for quality products and services</p>
        <div>
            <a href="{{ route('register') }}" class="btn btn-primary btn-lg me-3">Get Started</a>
            <a href="{{ route('products') }}" class="btn btn-outline-light btn-lg">View Products</a>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5">Our Features</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card feature-card h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-shopping-cart fa-3x mb-3 text-primary"></i>
                        <h5 class="card-title">Easy Shopping</h5>
                        <p class="card-text">Browse and purchase products with just a few clicks.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card feature-card h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-truck fa-3x mb-3 text-primary"></i>
                        <h5 class="card-title">Fast Delivery</h5>
                        <p class="card-text">Get your products delivered quickly and securely.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card feature-card h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-headset fa-3x mb-3 text-primary"></i>
                        <h5 class="card-title">24/7 Support</h5>
                        <p class="card-text">Our customer service team is always ready to help.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Products Preview Section -->
<section class="bg-light py-5">
    <div class="container">
        <h2 class="text-center mb-5">Featured Products</h2>
        <div class="row">
            @foreach($featuredProducts as $product)
            <div class="col-md-3 mb-4">
                <div class="card">
                    <img src="{{ $product->image_url }}" class="card-img-top" alt="{{ $product->nama }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->nama }}</h5>
                        <p class="card-text">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                        <a href="{{ route('products.show', $product) }}" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('products') }}" class="btn btn-outline-primary">View All Products</a>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-5">
    <div class="container text-center">
        <h2 class="mb-4">Ready to Get Started?</h2>
        <p class="lead mb-4">Join our platform today and experience the difference.</p>
        <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Register Now</a>
    </div>
</section>
@endsection
