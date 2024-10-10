<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Anak</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
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
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>

</body>
</html>
