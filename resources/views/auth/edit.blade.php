<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
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
      .position-relative {
        display: flex;
        align-items: center;
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
                <img src="" alt="BootstrapBrain Logo" width="250">
              </a>
            </div>
            <h2 class="fs-6 fw-normal text-center text-secondary mb-4">Edit User</h2>
            <form action="{{ route('users.update', $user->id) }}" method="POST">
              @csrf
              @method('PUT')
              <div class="row gy-2 overflow-hidden">
                <div class="col-12">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                    <label for="name" class="form-label">Name</label>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                    <label for="email" class="form-label">Email</label>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-floating mb-3 position-relative">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Leave blank to keep current password">
                    <label for="password" class="form-label">Password</label>
                    <button type="button" class="btn btn-outline-secondary position-absolute top-50 end-0 translate-middle-y d-flex align-items-center" id="togglePassword" style="border: none; background: none;">
                      <i class="bi bi-eye-slash" id="toggleIcon"></i>
                    </button>
                  </div>
                  <small class="text-muted">Kosongkan jika tidak ingin mengubah password</small>
                </div>
                <div class="col-12">
                  <div class="form-floating mb-3">
                    <select class="form-control" id="role" name="role" required>
                      <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                      <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                    <label for="role" class="form-label">Role</label>
                  </div>
                </div>
                <div class="col-12 d-flex justify-content-end gap-2">
                  <a href="{{ route('dashboardadmin') }}" class="btn btn-secondary">Cancel</a>
                  <button type="submit" class="btn btn-primary">Update</button>
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
    const passwordInput = document.getElementById('password');
    const toggleIcon = document.getElementById('toggleIcon');
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);
    toggleIcon.classList.toggle('bi-eye');
    toggleIcon.classList.toggle('bi-eye-slash');
  });
</script>

</body>
</html>