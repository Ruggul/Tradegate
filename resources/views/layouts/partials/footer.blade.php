<footer class="bg-dark text-light py-4 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h5>About Us</h5>
                <p>Your trusted platform for quality products and services.</p>
            </div>
            <div class="col-md-4">
                <h5>Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('products') }}" class="text-light">Products</a></li>
                    <li><a href="{{ route('about') }}" class="text-light">About Us</a></li>
                    <li><a href="{{ route('contact') }}" class="text-light">Contact</a></li>
                    <li><a href="{{ route('privacy-policy') }}" class="text-light">Privacy Policy</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5>Contact Info</h5>
                <ul class="list-unstyled">
                    <li><i class="fas fa-phone"></i> +1234567890</li>
                    <li><i class="fas fa-envelope"></i> info@example.com</li>
                    <li><i class="fas fa-map-marker-alt"></i> 123 Street, City, Country</li>
                </ul>
            </div>
        </div>
        <hr class="my-4">
        <div class="text-center">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</footer> 