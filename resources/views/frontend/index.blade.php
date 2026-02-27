@extends('frontend.layouts.app')

@section('content')
    <!-- ========== FEATURED PRODUCTS ========== -->
    <section id="products" class="py-5">
        <div class="container">
            <h2 class="fw-bold mb-4">Featured Products</h2>

            @php
                // High-quality product images (all from Unsplash)
                $products = [
                    [
                        'name' => 'Premium Headphones',
                        'price' => '$79.99',
                        'description' => 'Wireless noise-cancelling headphones',
                        'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&h=200&q=80',
                        'rating' => 5
                    ],
                    [
                        'name' => 'Classic Leather Watch',
                        'price' => '$199.00',
                        'description' => 'Minimalist design with genuine leather',
                        'image' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&h=200&q=80',
                        'rating' => 4
                    ],
                    [
                        'name' => 'Running Shoes',
                        'price' => '$89.99',
                        'description' => 'Lightweight and comfortable',
                        'image' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&h=200&q=80',
                        'rating' => 4
                    ],
                    [
                        'name' => 'Compact Camera',
                        'price' => '$349.00',
                        'description' => '4K video and 20MP photos',
                        'image' => 'https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&h=200&q=80',
                        'rating' => 5
                    ],
                    [
                        'name' => 'Designer Sunglasses',
                        'price' => '$129.50',
                        'description' => 'UV protection with polarised lenses',
                        'image' => 'https://images.unsplash.com/photo-1572635196237-14b3f281503f?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&h=200&q=80',
                        'rating' => 4
                    ],
                    [
                        'name' => 'Travel Backpack',
                        'price' => '$59.99',
                        'description' => 'Water-resistant with laptop compartment',
                        'image' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&h=200&q=80',
                        'rating' => 5
                    ],
                    [
                        'name' => 'Ultrabook Laptop',
                        'price' => '$999.00',
                        'description' => 'Lightweight with 12-hour battery',
                        'image' => 'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&h=200&q=80',
                        'rating' => 5
                    ],
                    [
                        'name' => 'Ceramic Coffee Mug',
                        'price' => '$24.95',
                        'description' => 'Handcrafted ceramic, 12oz capacity',
                        'image' => 'https://images.unsplash.com/photo-1514228742587-6b1558fcca3d?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&h=200&q=80',
                        'rating' => 4
                    ]
                ];
            @endphp

            <div class="row g-4">
                @foreach($products as $product)
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="card product-card h-100 shadow-sm">
                            <div class="overflow-hidden">
                                <img src="{{ $product['image'] }}" class="card-img-top" alt="{{ $product['name'] }}">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title fw-semibold">{{ $product['name'] }}</h5>
                                <p class="card-text text-secondary small">{{ $product['description'] }}</p>

                                <!-- Rating Stars -->
                                <div class="mb-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $product['rating'])
                                            <i class="bi bi-star-fill text-warning small"></i>
                                        @else
                                            <i class="bi bi-star text-warning small"></i>
                                        @endif
                                    @endfor
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold fs-5">{{ $product['price'] }}</span>
                                    <a href="#" class="btn btn-outline-primary btn-sm">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- View All Button -->
            <div class="text-center mt-5">
                <a href="#" class="btn btn-outline-primary px-5 py-2">View All Products</a>
            </div>
        </div>
    </section>

    <!-- ========== FEATURES SECTION ========== -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4 text-center">
                    <div class="p-4">
                        <i class="bi bi-truck fs-1 text-primary mb-3"></i>
                        <h5 class="fw-semibold">Free Shipping</h5>
                        <p class="text-secondary">On orders over $50</p>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="p-4">
                        <i class="bi bi-shield-check fs-1 text-primary mb-3"></i>
                        <h5 class="fw-semibold">Secure Payment</h5>
                        <p class="text-secondary">100% secure transactions</p>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="p-4">
                        <i class="bi bi-arrow-repeat fs-1 text-primary mb-3"></i>
                        <h5 class="fw-semibold">30-Day Returns</h5>
                        <p class="text-secondary">Easy returns policy</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== NEWSLETTER ========== -->
    <section class="py-5">
        <div class="container">
            <div class="newsletter-section bg-light p-5">
                <div class="row justify-content-center">
                    <div class="col-md-8 text-center">
                        <h3 class="fw-bold mb-3">{{ __('Stay in the loop') }}</h3>
                        <p class="text-secondary mb-4">{{ __('Subscribe to get special offers, free giveaways, and exclusive deals.') }}</p>

                        <form class="row g-2 justify-content-center">
                            <div class="col-md-8">
                                <input type="email" class="form-control form-control-lg" placeholder="Enter your email address">
                            </div>
                            <div class="col-md-auto">
                                <button type="submit" class="btn btn-primary btn-lg px-4">Subscribe</button>
                            </div>
                        </form>

                        <p class="small text-secondary mt-3">
                            <i class="bi bi-envelope-paper me-1"></i>
                            We respect your privacy. Unsubscribe at any time.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>




</body>
</html>
@endsection


