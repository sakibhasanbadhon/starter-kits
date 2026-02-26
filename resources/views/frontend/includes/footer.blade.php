<!-- ========== FOOTER ========== -->
<footer class="bg-white border-top py-5">
    <div class="container">
        <!-- Language Switcher -->
        <div class="d-flex justify-content-end mb-4">
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body py-2 px-3">
            <form action="{{ route('language.switch') }}" method="POST" class="d-flex align-items-center gap-2">
                @csrf
                <i class="bi bi-translate text-primary me-1"></i>
                <span class="text-secondary small me-2 d-none d-sm-inline">{{ __('Language') }}:</span>

                <select name="language_switch" class="form-select form-select-sm border-0 bg-light"
                        style="width: auto; min-width: 140px; font-weight: 500; cursor: pointer;"
                        onchange="this.form.submit()">

                    <option value="en" {{ session('locale') == 'en' ? 'selected' : '' }}
                            class="py-2" data-flag="🇺🇸">
                        🇺🇸 {{ __('English') }}
                    </option>

                    <option value="es" {{ session('locale') == 'es' ? 'selected' : '' }}
                            class="py-2" data-flag="🇪🇸">
                        🇪🇸 {{ __('Spanish') }}
                    </option>

                    <option value="fr" {{ session('locale') == 'fr' ? 'selected' : '' }}
                            class="py-2" data-flag="🇫🇷">
                        🇫🇷 {{ __('French') }}
                    </option>

                    <option value="de" {{ session('locale') == 'de' ? 'selected' : '' }}
                            class="py-2" data-flag="🇩🇪">
                        🇩🇪 {{ __('German') }}
                    </option>

                    <option value="ar" {{ session('locale') == 'ar' ? 'selected' : '' }}
                            class="py-2" data-flag="🇸🇦">
                        🇸🇦 {{ __('Arabic') }}
                    </option>
                </select>

                <i class="bi bi-check2-circle text-success ms-1 d-none d-sm-inline"
                   style="font-size: 0.9rem;" title="{{ __('Active Language') }}"></i>
            </form>
        </div>
    </div>
</div>

        <div class="row g-4">
            <!-- Brand (translatable) -->
            <div class="col-lg-4">
                <h5 class="fw-bold mb-3">{{ __('MyStore') }}</h5>
                <p class="text-secondary small">{{ __('Your one‑stop shop for the latest trends and timeless classics. Quality products at affordable prices.') }}</p>
                <div class="d-flex gap-3">
                    <a href="#" class="text-secondary"><i class="bi bi-facebook fs-5"></i></a>
                    <a href="#" class="text-secondary"><i class="bi bi-twitter fs-5"></i></a>
                    <a href="#" class="text-secondary"><i class="bi bi-instagram fs-5"></i></a>
                    <a href="#" class="text-secondary"><i class="bi bi-pinterest fs-5"></i></a>
                </div>
            </div>

            <!-- Quick Links (translatable) -->
            <div class="col-6 col-lg-2">
                <h6 class="fw-semibold mb-3">{{ __('Shop') }}</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#" class="footer-link small">{{ __('New Arrivals') }}</a></li>
                    <li class="mb-2"><a href="#" class="footer-link small">{{ __('Best Sellers') }}</a></li>
                    <li class="mb-2"><a href="#" class="footer-link small">{{ __('Sale') }}</a></li>
                    <li class="mb-2"><a href="#" class="footer-link small">{{ __('Gift Cards') }}</a></li>
                </ul>
            </div>

            <!-- Support (translatable) -->
            <div class="col-6 col-lg-2">
                <h6 class="fw-semibold mb-3">{{ __('Support') }}</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#" class="footer-link small">{{ __('Contact Us') }}</a></li>
                    <li class="mb-2"><a href="#" class="footer-link small">{{ __('Returns') }}</a></li>
                    <li class="mb-2"><a href="#" class="footer-link small">{{ __('FAQ') }}</a></li>
                    <li class="mb-2"><a href="#" class="footer-link small">{{ __('Shipping Info') }}</a></li>
                </ul>
            </div>

            <!-- Company (translatable) -->
            <div class="col-6 col-lg-2">
                <h6 class="fw-semibold mb-3">{{ __('Company') }}</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#" class="footer-link small">{{ __('About Us') }}</a></li>
                    <li class="mb-2"><a href="#" class="footer-link small">{{ __('Careers') }}</a></li>
                    <li class="mb-2"><a href="#" class="footer-link small">{{ __('Blog') }}</a></li>
                    <li class="mb-2"><a href="#" class="footer-link small">{{ __('Affiliate') }}</a></li>
                </ul>
            </div>

            <!-- Contact Info (partially translatable) -->
            <div class="col-6 col-lg-2">
                <h6 class="fw-semibold mb-3">{{ __('Contact') }}</h6>
                <ul class="list-unstyled">
                    <li class="mb-2 small text-secondary">
                        <i class="bi bi-geo-alt me-2"></i>{{ __('123 Store St, NY') }}
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

        <!-- Copyright (translatable) -->
        <div class="border-top mt-4 pt-4 text-center">
            <p class="small text-secondary mb-0">
                &copy; {{ date('Y') }} {{ __('MyStore. All rights reserved.') }}
                <a href="#" class="footer-link ms-2">{{ __('Privacy Policy') }}</a>
                <a href="#" class="footer-link ms-2">{{ __('Terms of Service') }}</a>
            </p>
        </div>
    </div>
</footer>

@push('script')
    <script>
      
    </script>
@endpush
