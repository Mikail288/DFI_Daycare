<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
      @media (max-width: 576px) {
        .container-fluid {
          padding: 1rem;
        }
        .display-5 {
          font-size: 1.5rem;
        }
        .lead {
          font-size: 1rem;
        }
        .btn {
          font-size: 0.875rem;
        }
        .table-responsive {
          font-size: 0.875rem;
        }
      }
      .modal-dialog-centered {
        display: flex;
        align-items: center;
        min-height: calc(100% - 1rem);
      }
      .modal-dialog-centered::before {
        display: block;
        height: calc(100vh - 1rem);
        content: "";
      }
    </style>
  </head>
<body>
    
<main>
  <div class="container py-4">
    <header class="pb-3 mb-4 border-bottom">
        <div class="row">
            <div class="col-8 col-md-10">
                <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
                    <img src="" alt="Daycare Logo" class="img-fluid" style="max-width: 100%; height: auto;">
                </a>          
            </div>
            <div class="col-4 col-md-2 text-end">
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
      
    </header>

    <div class="p-5 mb-4 bg-light rounded-3">
      <div class="container-fluid py-5">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
          <div>
            <h1 class="display-5 fw-bold">Hi, {{ Auth::user()->name }}</h1>
            <p class="lead">Welcome to the admin dashboard.</p>
          </div>
          <div class="ms-auto">
            <a href="{{ route('register') }}" class="btn btn-primary">Add User</a>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
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
                <tr>
                  <td>{{ $user->id }}</td>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->role }}</td>
                  <td>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning">
                      <i class="bi bi-pencil-square"></i>
                    </a>
                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-userid="{{ $user->id }}" data-username="{{ $user->name }}">
                      <i class="bi bi-trash"></i>
                    </button>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</main>

<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Apakah anda yakin ingin menghapus <span id="userNameToDelete"></span> ini?
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
</script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>

</body>
</html>