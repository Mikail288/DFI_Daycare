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
      .card-header {
        background-color: #28a745;
        color: white;
        border-radius: 15px 15px 0 0 !important;
      }

      .floating-image {
        transition: all 0.3s ease;
        animation: float 3s ease-in-out infinite;
      }

      .floating-image:hover {
        transform: translateY(-10px);
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
    </div>
</nav>

<main class="container my-5">
    @session('success')
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $value }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endsession

    <div class="row align-items-center">
        <div class="col-md-8">
            <h1 class="display-4 fw-bold">Selamat Datang, {{ Auth::user()->name }}</h1>
            <p class="lead">Kelola data anak-anak di daycare Anda di sini.</p>
        </div>
        <div class="col-md-4 text-end">
            <img src="{{ asset('Upinipin.png') }}" alt="Upin & Ipin" class="img-fluid floating-image" style="max-width: 120px;">
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
                                    <a href="{{ route('children.editStatus', $child->id) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i> Update Status
                                    </a>
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

<div class="modal fade" id="deleteChildModal" tabindex="-1" aria-labelledby="deleteChildModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteChildModalLabel">Konfirmasi penghapusan</h5>
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
</script>

</body>
</html>