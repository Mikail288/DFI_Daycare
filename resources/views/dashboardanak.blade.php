<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Anak</title>
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
        background-color: #28a745;
        color: white;
        border-radius: 15px 15px 0 0 !important;
      }
    </style>
  </head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img src="" alt="Daycare Logo" height="40">
        </a>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboardadmin') }}">
                    <i class="fas fa-users"></i> Dashboard Admin
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
            <h1 class="display-4 fw-bold">Selamat Datang, {{ Auth::user()->name }}</h1>
            <p class="lead">Kelola data anak-anak di daycare Anda di sini.</p>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="mb-0"><i class="fas fa-child me-2"></i>Daftar Anak</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Makan</th>
                            <th>Minum Obat</th>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($children as $child)
                            <tr>
                                <td>{{ $child->id }}</td>
                                <td>{{ $child->nama }}</td>
                                <td>
                                    <span class="badge bg-{{ $child->sudah_makan ? 'success' : 'danger' }}">
                                        {{ $child->sudah_makan ? 'Sudah' : 'Belum' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $child->sudah_minum_obat ? 'success' : 'danger' }}">
                                        {{ $child->sudah_minum_obat ? 'Sudah' : 'Belum' }}
                                    </span>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($child->tanggal)->format('d-m-Y') }}</td>
                                <td>{{ $child->keterangan ?? '-' }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#updateStatusModal" data-childid="{{ $child->id }}" data-childname="{{ $child->nama }}">
                                        <i class="fas fa-edit"></i> Update Status
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteChildModal" data-childid="{{ $child->id }}" data-childname="{{ $child->nama }}">
                                        <i class="fas fa-trash"></i> Hapus
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

<!-- Delete Child Modal -->
<div class="modal fade" id="deleteChildModal" tabindex="-1" aria-labelledby="deleteChildModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteChildModalLabel">Konfirmasi penghapusan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Apakah anda yakin ingin menghapus anak <b><span id="childNameToDelete"></span></b>?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <form id="deleteChildForm" action="" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger">Hapus</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Update Status Modal -->
<div class="modal fade" id="updateStatusModal" tabindex="-1" aria-labelledby="updateStatusModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateStatusModalLabel">Update Status Anak</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="updateStatusForm" action="" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body">
          <h6 id="childNameToUpdate"></h6>
          <div class="mb-3">
            <label for="sudah_makan" class="form-label">Status Makan</label>
            <select class="form-select" id="sudah_makan" name="sudah_makan">
              <option value="1">Sudah</option>
              <option value="0">Belum</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="sudah_minum_obat" class="form-label">Status Minum Obat</label>
            <select class="form-select" id="sudah_minum_obat" name="sudah_minum_obat">
              <option value="1">Sudah</option>
              <option value="0">Belum</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="text" class="form-control" id="tanggal" name="tanggal" required>
          </div>
          <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
  var deleteChildModal = document.getElementById('deleteChildModal');
  deleteChildModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var childId = button.getAttribute('data-childid');
    var childName = button.getAttribute('data-childname');
    var form = document.getElementById('deleteChildForm');
    var childNameToDelete = document.getElementById('childNameToDelete');
    
    form.action = '{{ route("children.destroy", "") }}/' + childId;
    childNameToDelete.textContent = childName;
  });

  var updateStatusModal = document.getElementById('updateStatusModal');
  updateStatusModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var childId = button.getAttribute('data-childid');
    var childName = button.getAttribute('data-childname');
    var form = document.getElementById('updateStatusForm');
    var childNameToUpdate = document.getElementById('childNameToUpdate');
    
    form.action = '{{ url("children") }}/' + childId + '/update-status';
    childNameToUpdate.textContent = 'Anak: ' + childName;

    // Initialize flatpickr for the date input
    flatpickr("#tanggal", {
      dateFormat: "d-m-Y",
      defaultDate: "today"
    });
  });

  document.getElementById('updateStatusForm').addEventListener('submit', function(e) {
    var dateInput = document.getElementById('tanggal');
    var dateParts = dateInput.value.split('-');
    if (dateParts.length === 3) {
      var day = dateParts[0];
      var month = dateParts[1];
      var year = dateParts[2];
      dateInput.value = year + '-' + month + '-' + day;
    }
  });
</script>

</body>
</html>