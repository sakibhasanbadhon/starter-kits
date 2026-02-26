@extends('admin.auth.layouts.app')

@section('content')
<div class="animated-bg">
        <!-- Floating Orbs -->
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>

        <!-- Grid Pattern -->
        <div class="grid-pattern"></div>

        <!-- Particles -->
        <div class="particles">
            @for($i = 0; $i < 50; $i++)
                <div class="particle" style="
                    left: {{ rand(0, 100) }}%;
                    top: {{ rand(0, 100) }}%;
                    animation-delay: -{{ rand(0, 15) }}s;
                    animation-duration: {{ rand(10, 20) }}s;
                "></div>
            @endfor
        </div>

        <!-- Waves -->
        <div class="waves"></div>

        <!-- Shooting Stars -->
        <div class="shooting-star" style="
            top: {{ rand(10, 30) }}%;
            left: {{ rand(0, 30) }}%;
            animation-delay: -{{ rand(0, 5) }}s;
        "></div>
        <div class="shooting-star" style="
            top: {{ rand(40, 60) }}%;
            left: {{ rand(70, 100) }}%;
            animation-delay: -{{ rand(5, 10) }}s;
        "></div>
    </div>

    <!-- Login Box -->
    <div class="login-box">
        <div class="card">
            <div class="card-body login-card-body">
                <!-- Admin Profile Image -->
                <div class="text-center mb-4">
                    <div class="d-inline-block position-relative">
                        <img src="https://ui-avatars.com/api/?name=Admin&size=128&background=0D6EFD&color=fff&bold=true&length=1"
                             alt="Admin Avatar"
                             class="rounded-circle img-thumbnail shadow"
                             style="width: 100px; height: 100px; object-fit: cover; border: 3px solid #fff;">

                        <!-- Online Status Indicator -->
                        <span class="position-absolute bottom-0 end-0 bg-success rounded-circle p-2 border border-2 border-white"
                              style="width: 15px; height: 15px; animation: pulse 2s infinite;"></span>
                    </div>
                    <h5 class="mt-3 mb-0 fw-bold" style="color: #1e293b;">Administrator</h5>
                    <p class="text-muted small">Please sign in to continue</p>
                </div>

                <p class="login-box-msg text-center mb-4" style="color: #4f46e5; font-weight: 500;">Welcome To Admin Panel</p>

                <form action="{{ route('admin.login.submit') }}" method="post">
                    @csrf

                    <!-- Email Field -->
                    <div class="mb-4">
                        <x-forms.input-right-append type="email" placeholder="Email" name="email" icon="fas fa-envelope" required="required"/>
                    </div>

                    <!-- Password Field with Show/Hide Icon -->
                    <div class="mb-4">
                        <div class="input-group">
                            <input type="password" class="form-control" placeholder="Password" name="password" id="password" required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="fas fa-eye" id="togglePasswordIcon"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 mb-3 text-end">
                            <a href="forgot-password.html" class="text-decoration-none">
                                <i class="fas fa-lock me-1"></i>{{ __('Forgot Password?') }}
                            </a>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-sign-in-alt me-2"></i>{{ __('Login') }}
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Footer Text -->
                <div class="text-center mt-4">
                    <small class="text-muted">
                        <i class="fas fa-shield-alt me-1"></i>Secure Admin Access
                    </small>
                </div>
            </div>
        </div>
    </div>


<!-- JavaScript for Password Toggle -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const togglePassword = document.getElementById('togglePassword');
    const password = document.getElementById('password');
    const toggleIcon = document.getElementById('togglePasswordIcon');

    togglePassword.addEventListener('click', function() {
      // Toggle the type attribute
      const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
      password.setAttribute('type', type);

      // Toggle the icon
      if (type === 'password') {
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
      } else {
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
      }
    });
  });
</script>


@endsection
