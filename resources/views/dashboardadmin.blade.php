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
      .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0,0,0,.1);
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
    </style>
  </head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img src="" alt="Daycare Logo" height="40">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboardanak') }}">
                        <i class="fas fa-users"></i> Dashboard Anak
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> {{ __('Keluar') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
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

    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="display-4 fw-bold">Welcome, {{ Auth::user()->name }}</h1>
            <p class="lead">Manage your daycare users and children here.</p>
        </div>
        <div class="col-md-4 text-md-end">
            <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                <i class="fas fa-user-plus me-2"></i> Add New User
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="mb-0"><i class="fas fa-users me-2"></i>User Management</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="user-row" data-href="{{ route('users.show', $user->id) }}" style="cursor: pointer;">
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td><span class="badge bg-{{ $user->role == 'admin' ? 'danger' : 'success' }}">{{ $user->role }}</span></td>
                                <td>
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm me-1" title="Edit" onclick="event.stopPropagation();">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <button type="button" class="btn btn-success btn-sm me-1" data-bs-toggle="modal" data-bs-target="#addChildModal" data-userid="{{ $user->id }}" data-username="{{ $user->name }}" title="Add Child" onclick="event.stopPropagation();">
                                        <i class="fas fa-baby"></i>Tambah Anak
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal" data-userid="{{ $user->id }}" data-username="{{ $user->name }}" title="Delete" onclick="event.stopPropagation();">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
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

<!-- Add Child Modal -->
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

</body>
</html>
