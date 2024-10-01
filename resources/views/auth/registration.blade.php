<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registration Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" rel="stylesheet">
  <style type="text/css">
    body {
      background: #F8F9FA;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .form-floating .form-control {
      padding-right: 3rem;
    }
    .form-floating .btn {
      right: 0.75rem;
    }
    .form-floating .btn i {
      font-size: 1.25rem; /* Perbesar ukuran ikon */
    }
    .form-floating .btn:hover i {
      color: #6c757d; /* Warna ikon saat di-hover */
    }
  </style>
</head>
<body>

<section class="bg-light py-3 py-md-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
        <div class="card border border-light-subtle rounded-3 shadow-sm">
          <div class="card-body p-3 p-md-4 p-xl-5">
            <div class="text-center mb-3">
              <a>
                <img src="" alt="Logo Daycare" width="250">
              </a>
            </div>
            <h2 class="fs-6 fw-normal text-center text-secondary mb-4">Sign up to your account</h2>
            <form method="POST" action="{{ route('register.post') }}">
              @csrf

              @session('error')
                  <div class="alert alert-danger" role="alert"> 
                      {{ $value }}
                  </div>
              @endsession

              <div class="row gy-2 overflow-hidden">
                <div class="col-12">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="name@example.com" required>
                    <label for="name" class="form-label">{{ __('Name') }}</label>
                  </div>
                  @error('name')
                        <span class="text-danger" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                <div class="col-12">
                  <div class="form-floating mb-3">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="name@example.com" required>
                    <label for="email" class="form-label">{{ __('Email Address') }}</label>
                  </div>
                  @error('email')
                        <span class="text-danger" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                <div class="col-12">
                  <div class="form-floating mb-3 position-relative">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" value="" placeholder="Password" required>
                    <label for="password" class="form-label">{{ __('Password') }}</label>
                    <button type="button" class="btn btn-outline-secondary position-absolute top-50 end-0 translate-middle-y" id="togglePassword" style="border: none; background: none;">
                      <i class="bi bi-eye-slash" id="toggleIcon"></i>
                    </button>
                  </div>
                  @error('password')
                      <span class="text-danger" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                <div class="col-12">
                  <div class="form-floating mb-3 position-relative">
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="password_confirmation" value="" placeholder="password_confirmation" required>
                    <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                    <button type="button" class="btn btn-outline-secondary position-absolute top-50 end-0 translate-middle-y" id="togglePasswordConfirmation" style="border: none; background: none;">
                      <i class="bi bi-eye-slash" id="toggleIconConfirmation"></i>
                    </button>
                  </div>
                  @error('password_confirmation')
                      <span class="text-danger" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                <div class="col-12">
                  <div class="d-grid my-3">
                    <button class="btn btn-primary btn-lg" type="submit">{{ __('Register') }}</button>
                  </div>
                </div>
                <div class="col-12">
                  <div class="d-grid">
                    <a href="{{ route('dashboardadmin') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  document.getElementById('togglePassword').addEventListener('click', function () {
    const passwordField = document.getElementById('password');
    const toggleIcon = document.getElementById('toggleIcon');
    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordField.setAttribute('type', type);
    toggleIcon.classList.toggle('bi-eye');
    toggleIcon.classList.toggle('bi-eye-slash');
  });

  document.getElementById('togglePasswordConfirmation').addEventListener('click', function () {
    const passwordField = document.getElementById('password_confirmation');
    const toggleIcon = document.getElementById('toggleIconConfirmation');
    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordField.setAttribute('type', type);
    toggleIcon.classList.toggle('bi-eye');
    toggleIcon.classList.toggle('bi-eye-slash');
  });
</script>

</body>
</html>