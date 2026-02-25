@extends('admin.auth.layouts.app')

@section('content')
<div class="login-box">

    <div class="card">
      <div class="card-body login-card-body">

        <!-- Admin Profile Image (Circle) -->
        <div class="text-center mb-4">
          <div class="d-inline-block position-relative">
            <img src="https://ui-avatars.com/api/?name=Admin&size=128&background=0D6EFD&color=fff&bold=true&length=1"
                 alt="Admin Avatar"
                 class="rounded-circle img-thumbnail shadow"
                 style="width: 100px; height: 100px; object-fit: cover; border: 3px solid #fff;">

            <!-- Optional: Online Status Indicator -->
            <span class="position-absolute bottom-0 end-0 bg-success rounded-circle p-2 border border-2 border-white"
                  style="width: 15px; height: 15px;"></span>
          </div>
          <h5 class="mt-3 mb-0 fw-bold">Administrator</h5>
          <p class="text-muted small">Please sign in to continue</p>
        </div>

        <p class="login-box-msg">Welcome To Admin Panel</p>
        <form action="{{ route('admin.login.submit') }}" method="post">
          @csrf

          <x-forms.input-right-append type="email" placeholder="Email" name="email" icon="fas fa-envelope" required="required"/>

          <!-- Password Field with Show/Hide Icon -->
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name="password" id="password" required>

            <div class="input-group-append">
              <button class="btn btn-outline-secondary" type="button" id="togglePassword" style="border-top-right-radius: 0.25rem; border-bottom-right-radius: 0.25rem;">
                <i class="fas fa-eye" id="togglePasswordIcon"></i>
              </button>
            </div>
          </div>

            <div class="row">
                <div class="col-12 mb-3 text-right">
                <a href="forgot-password.html">{{ __('Forgot Password') }}</a>
                </div>

                <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">{{ __('Login') }}</button>
                </div>

            </div>
        </form>
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
