<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="MyStore – Discover amazing products at great prices.">
    <title>MyStore – Professional E‑commerce</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }

        .product-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            border: none;
            border-radius: 12px;
            overflow: hidden;
        }

        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        }

        .product-card img {
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .product-card:hover img {
            transform: scale(1.05);
        }

        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 80px 0;
        }

        .btn-primary {
            background-color: #4f46e5;
            border-color: #4f46e5;
            padding: 12px 32px;
            font-weight: 500;
        }

        .btn-primary:hover {
            background-color: #4338ca;
            border-color: #4338ca;
        }

        .newsletter-section {
            background-color: #f8f9fa;
            border-radius: 16px;
            padding: 48px;
        }

        .footer-link {
            color: #6c757d;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .footer-link:hover {
            color: #4f46e5;
        }

        .cart-badge {
            background-color: #4f46e5;
            color: white;
            font-size: 0.7rem;
            padding: 0.25rem 0.5rem;
            border-radius: 20px;
            margin-left: 4px;
        }
    </style>
</head>
<body>



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
                    <h3 class="fw-bold mb-3">Stay in the loop</h3>
                    <p class="text-secondary mb-4">Subscribe to get special offers, free giveaways, and exclusive deals.</p>

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

<!-- ========== FOOTER ========== -->
<footer class="bg-white border-top py-5">
    <div class="container">
        <div class="row g-4">
            <!-- Brand -->
            <div class="col-lg-4">
                <h5 class="fw-bold mb-3">MyStore</h5>
                <p class="text-secondary small">Your one‑stop shop for the latest trends and timeless classics. Quality products at affordable prices.</p>
                <div class="d-flex gap-3">
                    <a href="#" class="text-secondary"><i class="bi bi-facebook fs-5"></i></a>
                    <a href="#" class="text-secondary"><i class="bi bi-twitter fs-5"></i></a>
                    <a href="#" class="text-secondary"><i class="bi bi-instagram fs-5"></i></a>
                    <a href="#" class="text-secondary"><i class="bi bi-pinterest fs-5"></i></a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-6 col-lg-2">
                <h6 class="fw-semibold mb-3">Shop</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#" class="footer-link small">New Arrivals</a></li>
                    <li class="mb-2"><a href="#" class="footer-link small">Best Sellers</a></li>
                    <li class="mb-2"><a href="#" class="footer-link small">Sale</a></li>
                    <li class="mb-2"><a href="#" class="footer-link small">Gift Cards</a></li>
                </ul>
            </div>

            <!-- Support -->
            <div class="col-6 col-lg-2">
                <h6 class="fw-semibold mb-3">Support</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#" class="footer-link small">Contact Us</a></li>
                    <li class="mb-2"><a href="#" class="footer-link small">Returns</a></li>
                    <li class="mb-2"><a href="#" class="footer-link small">FAQ</a></li>
                    <li class="mb-2"><a href="#" class="footer-link small">Shipping Info</a></li>
                </ul>
            </div>

            <!-- Company -->
            <div class="col-6 col-lg-2">
                <h6 class="fw-semibold mb-3">Company</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#" class="footer-link small">About Us</a></li>
                    <li class="mb-2"><a href="#" class="footer-link small">Careers</a></li>
                    <li class="mb-2"><a href="#" class="footer-link small">Blog</a></li>
                    <li class="mb-2"><a href="#" class="footer-link small">Affiliate</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="col-6 col-lg-2">
                <h6 class="fw-semibold mb-3">Contact</h6>
                <ul class="list-unstyled">
                    <li class="mb-2 small text-secondary">
                        <i class="bi bi-geo-alt me-2"></i>123 Store St, NY
                    </li>
                    <li class="mb-2 small text-secondary">
                        <i class="bi bi-envelope me-2"></i>hello@mystore.com
                    </li>
                    <li class="mb-2 small text-secondary">
                        <i class="bi bi-telephone me-2"></i>+1 (555) 123-4567
                    </li>
                </ul>
            </div>
        </div>

        <!-- Copyright -->
        <div class="border-top mt-4 pt-4 text-center">
            <p class="small text-secondary mb-0">
                &copy; {{ date('Y') }} MyStore. All rights reserved.
                <a href="#" class="footer-link ms-2">Privacy Policy</a>
                <a href="#" class="footer-link ms-2">Terms of Service</a>
            </p>
        </div>
    </div>
</footer>

<!-- Bootstrap JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
