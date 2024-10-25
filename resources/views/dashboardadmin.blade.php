<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
      body {
        background-color: #f8f9fa;
      }
      .navbar {
        box-shadow: 0 2px 4px rgba(0,0,0,.1);
      }
      .card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 6px rgba(0,0,0,.1);
        transition: all 0.3s ease;
      }
      .card-header {
        background-color: #007bff;
        color: white;
        border-radius: 15px 15px 0 0 !important;
      }
      .card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 6px rgba(0,0,0,.1);
        transition: all 0.3s ease;
      }
      .card-header {
        background-color: #007bff;
        color: white;
        border-radius: 15px 15px 0 0 !important;
      }
      .btn-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border-radius: 50%;
      }
      .input-group {
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        border-radius: 25px;
        overflow: hidden;
        transition: all 0.3s ease;
        border: 2px solid #007bff;
        max-width: 250px;
      }

      .input-group:hover, .input-group:focus-within {
        box-shadow: 0 6px 12px rgba(0,0,0,0.15);
        border-color: #0056b3;
      }

      .input-group .form-control {
        border: none;
        padding: 10px 15px;
        font-size: 0.9rem;
      }

      .input-group .btn {
        border-radius: 0 23px 23px 0;
        padding: 10px 15px;
        background-color: #007bff;
        border-color: #007bff;
      }

      .input-group .btn:hover {
        background-color: #0056b3;
        border-color: #004085;
      }

      .input-group .form-control:focus,
      .input-group .btn:focus {
        box-shadow: none;
        outline: none;
      }

      .btn-action {
        margin-bottom: 5px;
        width: 100%;
      }

      @media (min-width: 768px) {
        .btn-action {
          width: auto;
          margin-right: 5px;
        }
      }

      @media (max-width: 767px) {
        .card-header .d-flex {
          flex-direction: row;
          justify-content: space-between;
          align-items: center;
        }
        .card-header form {
          width: auto;
          margin-top: 0;
        }
        .card-header .input-group {
          width: 200px;
        }
      }

      #sidebar {
        position: fixed;
        top: 0;
        right: -250px;
        height: 100vh;
        width: 250px;
        background-color: #f8f9fa;
        transition: 0.3s;
        z-index: 1050;
        overflow-y: auto;
      }

      #sidebar.active {
        right: 0;
      }

      .overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background: rgba(0, 0, 0, 0.7);
        z-index: 1049;
        opacity: 0;
        transition: all 0.5s ease-in-out;
      }

      .overlay.active {
        display: block;
        opacity: 1;
      }

      @media (min-width: 992px) {
        #sidebar {
          right: -250px !important;
        }
        #content {
          margin-right: 0 !important;
        }
      }

      @keyframes float {
        0% {
          transform: translateY(0px);
        }
        50% {
          transform: translateY(-10px);
        }
        100% {
          transform: translateY(0px);
        }
      }

      .floating-image {
        transition: all 0.3s ease;
        animation: float 3s ease-in-out infinite;
      }

      .floating-image:hover {
        transform: translateY(-10px);
      }

      .card-header h3 {
        font-size: 1.75rem;
        font-weight: bold;
        margin-bottom: 0;
      }
    </style>
  </head>
<body>

<nav id="sidebar">
    <div class="p-4">
        <h3>Menu</h3>
        <ul class="list-unstyled components mb-5">
            <li>
                <a href="{{ route('dashboardanak') }}" class="btn btn-outline-primary w-100 mb-2">
                    <i class="fas fa-users"></i> Dashboard Anak
                </a>
            </li>
            <li>
                <a href="{{ route('logout') }}" class="btn btn-danger w-100"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> {{ __('Keluar') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</nav>

<div id="content">
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="" alt="Daycare Logo" height="40">
            </a>
            <button type="button" id="sidebarCollapse" class="btn btn-primary d-lg-none">
                <i class="fas fa-bars"></i>
            </button>
            <div class="d-none d-lg-block">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item me-2">
                        <a class="btn btn-outline-primary" href="{{ route('dashboardanak') }}">
                            <i class="fas fa-users"></i> Dashboard Anak
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-danger" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i> {{ __('Keluar') }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container my-5">
        @session('success')
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ $value }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endsession

        <div class="row align-items-center mb-4">
            <div class="col-md-8">
                <h1 class="display-4 fw-bold">Selamat Datang, {{ Auth::user()->name }}</h1>
                <p class="lead">Kelola pengguna dan anak-anak di daycare Anda di sini.</p>
            </div>
            <div class="col-md-4 text-end">
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-user-plus me-2"></i> Tambah User
                </a>
            </div>
        </div>

        <div class="card">
        <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="mb-0 fs-5"><i class="fas fa-child me-2"></i>Manage Users</h3>
                    <form action="{{ route('children.search') }}" method="GET">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Cari nama anak..." value="{{ request('search') }}" aria-label="Cari nama anak" aria-describedby="search-addon">
                            <button class="btn btn-primary" type="submit" id="search-addon">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr class="user-row" data-href="{{ route('users.show', $user->id) }}" style="cursor: pointer;">
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td><span class="badge bg-{{ $user->role == 'admin' ? 'danger' : 'primary' }}">{{ $user->role }}</span></td>
                                    <td>
                                        <div class="d-flex flex-column flex-md-row">
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm btn-action mb-2 mb-md-0 me-md-2">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <button type="button" class="btn btn-primary btn-sm btn-action mb-2 mb-md-0 me-md-2" data-bs-toggle="modal" data-bs-target="#addChildModal" data-userid="{{ $user->id }}" data-username="{{ $user->name }}">
                                                <i class="fas fa-baby"></i> Tambah Anak
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm btn-action" data-bs-toggle="modal" data-bs-target="#deleteModal" data-userid="{{ $user->id }}" data-username="{{ $user->name }}">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteModalLabel">Konfirmasi penghapusan</h5>
          </div>
          <div class="modal-body">
            Apakah anda yakin ingin menghapus akun <b><span id="userNameToDelete"></span></b> dan anak-anak yang terkait?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <form id="deleteForm" action="" method="POST" style="display:inline;">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger">Delete</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="addChildModal" tabindex="-1" aria-labelledby="addChildModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addChildModalLabel">Tambah anak</h5>
          </div>
          <form id="addChildForm" action="{{ route('children.store') }}" method="POST">
            @csrf
            <div class="modal-body">
              <input type="hidden" name="user_id" id="childUserId">
              <div class="mb-3">
                <label for="childName" class="form-label">Nama anak</label>
                <input type="text" class="form-control" id="childName" name="nama" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary">Tambah Anak</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="overlay"></div>

    <script>
      var deleteModal = document.getElementById('deleteModal');
      deleteModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var userId = button.getAttribute('data-userid');
        var userName = button.getAttribute('data-username');
        var form = document.getElementById('deleteForm');
        var userNameToDelete = document.getElementById('userNameToDelete');
        
        form.action = '/users/' + userId;
        userNameToDelete.textContent = userName;
      });

      var addChildModal = document.getElementById('addChildModal');
      addChildModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var userId = button.getAttribute('data-userid');
        var childUserId = document.getElementById('childUserId');
        
        childUserId.value = userId;
      });

      document.addEventListener('DOMContentLoaded', function() {
        var dateInput = document.getElementById('childDate');
        
        flatpickr(dateInput, {
          dateFormat: "d-m-Y",
          allowInput: true
        });
      });

      document.getElementById('addChildForm').addEventListener('submit', function(e) {
        var dateInput = document.getElementById('childDate');
        var dateParts = dateInput.value.split('-');
        if (dateParts.length === 3) {
          var day = dateParts[0];
          var month = dateParts[1];
          var year = dateParts[2];
          dateInput.value = year + '-' + month + '-' + day;
        }
      });
    </script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const userRows = document.querySelectorAll('.user-row');
        userRows.forEach(row => {
            row.addEventListener('click', function() {
                window.location.href = this.dataset.href;
            });
        });
    });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.querySelector('.overlay');
        const sidebarCollapse = document.getElementById('sidebarCollapse');

        sidebarCollapse.addEventListener('click', function() {
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        });

        overlay.addEventListener('click', function() {
            sidebar.classList.remove('active');
            this.classList.remove('active');
        });
    });
    </script>

</body>
</html>
