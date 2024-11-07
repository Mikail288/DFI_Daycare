<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Anak</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
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
      .input-group {
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        border-radius: 25px;
        overflow: hidden;
        transition: all 0.3s ease;
        border: 2px solid #28a745;
        max-width: 250px;
      }

      .input-group:hover, .input-group:focus-within {
        box-shadow: 0 6px 12px rgba(0,0,0,0.15);
        border-color: #218838;
      }

      .input-group .form-control {
        border: none;
        padding: 10px 15px;
        font-size: 0.9rem;
      }

      .input-group .btn {
        border-radius: 0 23px 23px 0;
        padding: 10px 15px;
        background-color: #28a745;
        border-color: #28a745;
      }

      .input-group .btn:hover {
        background-color: #218838;
        border-color: #1e7e34;
      }

      .input-group .form-control:focus,
      .input-group .btn:focus {
        box-shadow: none;
        outline: none;
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

      .select2-container {
        width: 100% !important;
      }
      .select2-selection {
        height: 38px !important;
        padding: 5px !important;
      }

      .modal {
        text-align: center;
        padding: 0!important;
      }

      .modal:before {
        content: '';
        display: inline-block;
        height: 100%;
        vertical-align: middle;
        margin-right: -4px;
      }

      .modal-dialog {
        display: inline-block;
        text-align: left;
        vertical-align: middle;
        max-width: 500px;
        width: 90%;
      }

      @media (max-width: 576px) {
        .modal-dialog {
          margin: 1rem auto;
          width: 95%;
        }
      }

      .select2-container--open .select2-dropdown {
        top: 100% !important;
        bottom: auto !important;
      }
      
      .select2-container .select2-dropdown {
        margin-top: 1px;
      }
      
      .modal-body {
        overflow: visible;
      }
      
      .modal-content {
        overflow: visible;
      }

      .search-form {
        margin-left: auto;
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
                        <a class="btn btn-outline-success" href="{{ route('dashboardadmin') }}">
                            <i class="fas fa-users"></i> Dashboard Admin
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
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="mb-0"><i class="fas fa-child me-2"></i>Daftar Anak</h3>
                    <form action="{{ route('children.search') }}" method="GET" class="search-form">
                        <div class="input-group">
                            <input type="text" 
                                   name="search" 
                                   class="form-control" 
                                   placeholder="Cari nama anak..." 
                                   value="{{ request('search') }}"
                                   aria-label="Cari nama anak" 
                                   aria-describedby="search-addon">
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
                                <th>Orang Tua</th>
                                <th>Tanggal</th>
                                <!-- <th>Keterangan</th> -->
                                <th>Status Pengisian</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($children as $child)
                                <tr class="clickable-row" data-href="{{ route('children.info', $child->id) }}">
                                    <td>{{ $child->nama }}</td>
                                    <td>{{ $child->user->name ?? '-' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($child->tanggal)->format('d-m-Y') }}</td>
                                    <!-- <td>{{ $child->keterangan ?? '-' }}</td> -->
                                    <td>
                                        @php
                                            $today = \Carbon\Carbon::now()->format('Y-m-d');
                                            $childHistory = $child->histories()
                                                ->whereDate('tanggal', $today)
                                                ->latest()
                                                ->first();

                                            $isComplete = $childHistory && 
                                                !empty($childHistory->makan_pagi) && !empty($childHistory->makan_siang) && !empty($childHistory->makan_sore) &&
                                                !empty($childHistory->susu_pagi) && !empty($childHistory->susu_siang) && !empty($childHistory->susu_sore) &&
                                                !empty($childHistory->air_putih_pagi) && !empty($childHistory->air_putih_siang) && !empty($childHistory->air_putih_sore) &&
                                                !empty($childHistory->bak_pagi) && !empty($childHistory->bak_siang) && !empty($childHistory->bak_sore) &&
                                                !empty($childHistory->bab_pagi) && !empty($childHistory->bab_siang) && !empty($childHistory->bab_sore) &&
                                                !empty($childHistory->tidur_pagi) && !empty($childHistory->tidur_siang) && !empty($childHistory->tidur_sore) &&
                                                !empty($childHistory->kondisi);

                                            if ($isComplete) {
                                                $kegiatanOutdoor = json_decode($childHistory->kegiatan_outdoor, true);
                                                $kegiatanIndoor = json_decode($childHistory->kegiatan_indoor, true);
                                                $makananCamilanPagi = json_decode($childHistory->makanan_camilan_pagi, true);
                                                $makananCamilanSiang = json_decode($childHistory->makanan_camilan_siang, true);
                                                $makananCamilanSore = json_decode($childHistory->makanan_camilan_sore, true);
                                                
                                                $isComplete = $isComplete && 
                                                    is_array($kegiatanOutdoor) && count($kegiatanOutdoor) > 0 &&
                                                    is_array($kegiatanIndoor) && count($kegiatanIndoor) > 0 &&
                                                    is_array($makananCamilanPagi) && count($makananCamilanPagi) > 0 &&
                                                    is_array($makananCamilanSiang) && count($makananCamilanSiang) > 0 &&
                                                    is_array($makananCamilanSore) && count($makananCamilanSore) > 0 &&
                                                    !empty($childHistory->obat_pagi) &&
                                                    !empty($childHistory->obat_siang) &&
                                                    !empty($childHistory->obat_sore);
                                            }
                                        @endphp
                                        @if ($isComplete)
                                            <span class="badge bg-success">Lengkap</span>
                                        @else
                                            <span class="badge bg-danger">Belum Lengkap</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('children.editStatus', $child->id) }}" class="btn btn-primary btn-sm btn-action">
                                            <i class="fas fa-edit"></i> Update Status
                                        </a>
                                        <a href="{{ route('children.info', $child->id) }}" class="btn btn-warning btn-sm btn-action">
                                            <i class="fas fa-info-circle"></i> Informasi Anak
                                        </a>
                                        <button type="button" class="btn btn-success btn-sm btn-action" data-bs-toggle="modal" data-bs-target="#editChildModal" 
                                            data-childid="{{ $child->id }}" 
                                            data-childname="{{ $child->nama }}"
                                            data-userid="{{ $child->user_id }}">
                                            <i class="fas fa-sync"></i> Update
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm btn-action" data-bs-toggle="modal" data-bs-target="#deleteChildModal" data-childid="{{ $child->id }}" data-childname="{{ $child->nama }}">
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

    <div class="modal fade" id="editChildModal" tabindex="-1" aria-labelledby="editChildModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editChildModalLabel">Edit Data Anak</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editChildForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="edit_nama" class="form-label">Nama Anak</label>
                            <input type="text" class="form-control" id="edit_nama" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_user_id" class="form-label">Cari Orang Tua</label>
                            <select class="form-select" id="edit_user_id" name="user_id" required>
                                <option value="">Pilih orang tua...</option>
                                @foreach($users as $user)
                                    @if($user->role === 'user')
                                        <option value="{{ $user->id }}">{{ $user->email }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="overlay"></div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

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

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tambahkan kode ini untuk sidebar
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

    // Kode Select2 yang sudah ada
    $('#edit_user_id').select2({
        theme: 'bootstrap-5',
        dropdownParent: $('#editChildModal'),
        placeholder: 'Cari email orang tua...',
        allowClear: true,
        width: '100%'
    });

    var editChildModal = document.getElementById('editChildModal');
    editChildModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var childId = button.getAttribute('data-childid');
        var childName = button.getAttribute('data-childname');
        var userId = button.getAttribute('data-userid');
        
        var form = document.getElementById('editChildForm');
        var nameInput = document.getElementById('edit_nama');
        
        form.action = '/children/' + childId;
        nameInput.value = childName;
        
        // Update Select2 value
        $('#edit_user_id').val(userId).trigger('change');
    });
});
</script>

</body>
</html>

