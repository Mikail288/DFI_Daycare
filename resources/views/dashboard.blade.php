<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
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
            margin-bottom: 20px;
        }
        .card-header {
            background-color: #007bff;
            color: white;
            border-radius: 15px 15px 0 0 !important;
            padding: 15px 20px;
        }
        .card-body {
            padding: 20px;
        }
        .list-group-item {
            border: none;
            padding: 0.75rem 1.25rem;
        }
        .list-group-item:not(:last-child) {
            border-bottom: 1px solid #f1f1f1;
        }
        .info-row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -10px;
        }
        .info-col {
            flex: 0 0 calc(33.333% - 20px);
            max-width: calc(33.333% - 20px);
            padding: 0 10px;
            margin-bottom: 20px;
        }
        .info-card {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 15px;
            height: 100%;
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }
        .info-card h5 {
            font-size: 1rem;
            margin-bottom: 10px;
            color: #007bff;
        }
        .info-card p {
            font-size: 0.9rem;
            margin-bottom: 5px;
        }
        .history-card {
            margin-bottom: 15px;
        }
        .history-card .card-header {
            background-color: #f8f9fa;
            color: #333;
            font-weight: bold;
        }
        @media (max-width: 767px) {
            .info-col {
                flex: 0 0 50%;
                max-width: 50%;
            }
            .order-md-last {
                order: -1 !important;
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
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
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

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-8 col-md-7">
                            <h1 class="card-title display-5 fw-bold">Hi, {{ auth()->user()->name }}</h1>
                            <p class="card-text fs-4">Pantau keseharian anak anda disini.</p>
                        </div>
                        <div class="col-4 col-md-5 text-end d-flex align-items-center justify-content-end">
                            <img src="{{ asset('Upinipin.png') }}" alt="Upinipin" class="img-fluid rounded" style="max-height: 150px; max-width: 100%;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-8 order-md-1 order-2">
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="mb-0"><i class="fas fa-thumbtack me-2"></i>Children Information</h3>
                </div>
                <div class="card-body">
                    @if($selectedChild)
                        <h4 class="mb-1">{{ $selectedChild->nama }}</h4>
                        <p class="mb-3">Pendamping : {{ $selectedChild->nama_pendamping }}</p>
                        <div class="row info-row">
                            <div class="col-md-4 info-col">
                                <div class="info-card">
                                    <h5><i class="fas fa-utensils me-2"></i>Makan</h5>
                                    <p class="mb-1"><small><i class="fas fa-sun text-warning me-2"></i>Pagi: {{ $selectedChild->makan_pagi ?? 'Belum' }}</small></p>
                                    <p class="mb-1"><small><i class="fas fa-cloud-sun text-primary me-2"></i>Siang: {{ $selectedChild->makan_siang ?? 'Belum' }}</small></p>
                                    <p class="mb-1"><small><i class="fas fa-moon text-info me-2"></i>Sore: {{ $selectedChild->makan_sore ?? 'Belum' }}</small></p>
                                </div>
                            </div>
                            <div class="col-md-4 info-col">
                                <div class="info-card">
                                    <h5><i class="fas fa-bottle-water me-2"></i>Susu</h5>
                                    <p class="mb-1"><small><i class="fas fa-sun text-warning me-2"></i>Pagi: {{ $selectedChild->susu_pagi ?? "-" }} ml</small></p>
                                    <p class="mb-1"><small><i class="fas fa-cloud-sun text-primary me-2"></i>Siang: {{ $selectedChild->susu_siang ?? "-" }} ml</small></p>
                                    <p class="mb-1"><small><i class="fas fa-moon text-info me-2"></i>Sore: {{ $selectedChild->susu_sore ?? "-" }} ml</small></p>
                                </div>
                            </div>
                            <div class="col-md-4 info-col">
                                <div class="info-card">
                                    <h5><i class="fas fa-tint me-2"></i>Air Putih</h5>
                                    <p class="mb-1"><small><i class="fas fa-sun text-warning me-2"></i>Pagi: {{ $selectedChild->air_putih_pagi ?? "-" }} ml</small></p>
                                    <p class="mb-1"><small><i class="fas fa-cloud-sun text-primary me-2"></i>Siang: {{ $selectedChild->air_putih_siang ?? "-" }} ml</small></p>
                                    <p class="mb-1"><small><i class="fas fa-moon text-info me-2"></i>Sore: {{ $selectedChild->air_putih_sore ?? "-" }} ml</small></p>
                                </div>
                            </div>
                            <div class="col-md-4 info-col">
                                <div class="info-card">
                                    <h5><i class="fas fa-toilet me-2"></i>BAK</h5>
                                    <p class="mb-1"><small><i class="fas fa-sun text-warning me-2"></i>Pagi: {{ $selectedChild->bak_pagi ?? "-" }} X</small></p>
                                    <p class="mb-1"><small><i class="fas fa-cloud-sun text-primary me-2"></i>Siang: {{ $selectedChild->bak_siang ?? "-" }} X</small></p>
                                    <p class="mb-1"><small><i class="fas fa-moon text-info me-2"></i>Sore: {{ $selectedChild->bak_sore ?? "-" }} X</small></p>
                                </div>
                            </div>
                            <div class="col-md-4 info-col">
                                <div class="info-card">
                                    <h5><i class="fas fa-poop me-2"></i>BAB</h5>
                                    <p class="mb-1"><small><i class="fas fa-sun text-warning me-2"></i>Pagi: {{ $selectedChild->bab_pagi ?? "-" }} X</small></p>
                                    <p class="mb-1"><small><i class="fas fa-cloud-sun text-primary me-2"></i>Siang: {{ $selectedChild->bab_siang ?? "-" }} X</small></p>
                                    <p class="mb-1"><small><i class="fas fa-moon text-info me-2"></i>Sore: {{ $selectedChild->bab_sore ?? "-" }} X</small></p>
                                </div>
                            </div>
                            <div class="col-md-4 info-col">
                                <div class="info-card">
                                    <h5><i class="fas fa-bed me-2"></i>Tidur</h5>
                                    <p class="mb-1"><small><i class="fas fa-sun text-warning me-2"></i>Pagi: {{ $selectedChild->tidur_pagi ?? "-" }} X</small></p>
                                    <p class="mb-1"><small><i class="fas fa-cloud-sun text-primary me-2"></i>Siang: {{ $selectedChild->tidur_siang ?? "-" }} X</small></p>
                                    <p class="mb-1"><small><i class="fas fa-moon text-info me-2"></i>Sore: {{ $selectedChild->tidur_sore ?? "-" }} X</small></p>
                                </div>
                            </div>
                            <div class="col-md-12 info-col">
                                <div class="info-card">
                                    <h5><i class="fas fa-home me-2"></i>Kegiatan Indoor</h5>
                                    <small>
                                        @php
                                            $kegiatanIndoor = json_decode($selectedChild->kegiatan_indoor, true) ?? [];
                                        @endphp
                                        @if(count($kegiatanIndoor) > 0)
                                            <ul class="list-unstyled mb-0">
                                                @foreach($kegiatanIndoor as $item)
                                                    <li>- {{ $item }}</li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <p>Tidak ada kegiatan indoor</p>
                                        @endif
                                    </small>
                                </div>
                            </div>
                            <div class="col-md-12 info-col">
                                <div class="info-card">
                                    <h5><i class="fas fa-running me-2"></i>Kegiatan Outdoor</h5>
                                    <small>
                                        @php
                                            $kegiatan = json_decode($selectedChild->kegiatan_outdoor, true) ?? [];
                                        @endphp
                                        @if(count($kegiatan) > 0)
                                            <ul class="list-unstyled mb-0">
                                                @foreach($kegiatan as $item)
                                                    <li>- {{ $item }}</li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <p>Tidak ada kegiatan outdoor</p>
                                        @endif
                                    </small>
                                </div>
                            </div>
                            <div class="col-md-12 info-col">
                                <div class="info-card">
                                    <h5><i class="fas fa-heartbeat me-2"></i>Kondisi</h5>
                                    <p class="mb-0">
                                        @if($selectedChild->kondisi)
                                            <span class="badge {{ $selectedChild->kondisi === 'sehat' ? 'bg-success' : 'bg-danger' }}">
                                                {{ ucfirst($selectedChild->kondisi) }}
                                            </span>
                                        @else
                                            <span class="text-muted">Belum diisi</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-12 info-col">
                                <div class="info-card">
                                    <h5><i class="fas fa-pills me-2"></i>Obat</h5>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <p class="mb-1"><small><i class="fas fa-sun text-warning me-2"></i>Pagi: {{ $selectedChild->obat_pagi ?? 'Tidak ada' }}</small></p>
                                        </div>
                                        <div class="col-md-4">
                                            <p class="mb-1"><small><i class="fas fa-cloud-sun text-primary me-2"></i>Siang: {{ $selectedChild->obat_siang ?? 'Tidak ada' }}</small></p>
                                        </div>
                                        <div class="col-md-4">
                                            <p class="mb-1"><small><i class="fas fa-moon text-info me-2"></i>Sore: {{ $selectedChild->obat_sore ?? 'Tidak ada' }}</small></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 info-col">
                                <div class="info-card">
                                    <h5><i class="fas fa-cookie-bite me-2"></i>Makanan & Camilan</h5>
                                    <p class="mb-1"><small><i class="fas fa-sun text-warning me-2"></i>Pagi:</small></p>
                                    <small>
                                        @php
                                            $makananCamilanPagi = json_decode($selectedChild->makanan_camilan_pagi, true) ?? [];
                                        @endphp
                                        @if(count($makananCamilanPagi) > 0)
                                            <ul class="list-unstyled mb-0">
                                                @foreach($makananCamilanPagi as $item)
                                                    <li>- {{ $item }}</li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <p>Tidak ada</p>
                                        @endif
                                    </small>
                                    <p class="mb-1"><small><i class="fas fa-cloud-sun text-primary me-2"></i>Siang:</small></p>
                                    <small>
                                        @php
                                            $makananCamilanSiang = json_decode($selectedChild->makanan_camilan_siang, true) ?? [];
                                        @endphp
                                        @if(count($makananCamilanSiang) > 0)
                                            <ul class="list-unstyled mb-0">
                                                @foreach($makananCamilanSiang as $item)
                                                    <li>- {{ $item }}</li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <p>Tidak ada</p>
                                        @endif
                                    </small>
                                    <p class="mb-1"><small><i class="fas fa-moon text-info me-2"></i>Sore:</small></p>
                                    <small>
                                    @php
                                        $makananCamilanSore = json_decode($selectedChild->makanan_camilan_sore, true) ?? [];
                                    @endphp
                                    @if(count($makananCamilanSore) > 0)
                                        <ul class="list-unstyled mb-0">
                                            @foreach($makananCamilanSore as $item)
                                                <li>- {{ $item }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p>Tidak ada</p>
                                    @endif
                                    </small>
                                </div>
                            </div>
                        </div>
                        <p class="mb-1 mt-3">
                            <i class="fas fa-calendar me-1"></i>
                            Tanggal: {{ \Carbon\Carbon::parse($selectedChild->tanggal)->format('d/m/Y') }}
                        </p>
                        <p class="mb-0">
                            <i class="fas fa-comment me-1"></i>
                            Keterangan: {{ $selectedChild->keterangan ?? 'Tidak ada' }}
                        </p>
                    @else
                        <p class="card-text text-muted">Tidak ada anak yang dipilih. Klik anak dari "Anak Anda" untuk melihat detailnya.</p>
                    @endif
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0"><i class="fas fa-history me-2"></i>Riwayat Anak (5 Terakhir)</h3>
                </div>
                <div class="card-body p-2">
                    @if($selectedChild && $selectedChild->histories->count() > 0)
                        @foreach($selectedChild->histories->sortByDesc('tanggal')->take(5) as $history)
                            <div class="card history-card mx-n2 mb-3">
                                <div class="card-header" role="button" onclick="toggleHistory({{ $history->id }})">
                                    <h5 class="mb-0 d-flex justify-content-between align-items-center">
                                        <span>
                                            <i class="fas fa-calendar me-2"></i>
                                            {{ \Carbon\Carbon::parse($history->tanggal)->format('d/m/Y') }}
                                        </span>
                                        <i class="fas fa-chevron-down toggle-icon" id="toggle-icon-{{ $history->id }}"></i>
                                    </h5>
                                </div>
                                <div class="card-body collapse" id="history-{{ $history->id }}">
                                    <div class="row info-row">
                                        <div class="col-md-4 info-col">
                                            <div class="info-card">
                                                <h5><i class="fas fa-utensils me-2"></i>Makan</h5>
                                                <p class="mb-1"><small><i class="fas fa-sun text-warning me-2"></i>Pagi: {{ $history->makan_pagi ?? 'Belum' }}</small></p>
                                                <p class="mb-1"><small><i class="fas fa-cloud-sun text-primary me-2"></i>Siang: {{ $history->makan_siang ?? 'Belum' }}</small></p>
                                                <p class="mb-1"><small><i class="fas fa-moon text-info me-2"></i>Sore: {{ $history->makan_sore ?? 'Belum' }}</small></p>
                                            </div>
                                        </div>
                                        <div class="col-md-4 info-col">
                                            <div class="info-card">
                                                <h5><i class="fas fa-bottle-water me-2"></i>Susu</h5>
                                                <p class="mb-1"><small><i class="fas fa-sun text-warning me-2"></i>Pagi: {{ $history->susu_pagi ?? "-" }} ml</small></p>
                                                <p class="mb-1"><small><i class="fas fa-cloud-sun text-primary me-2"></i>Siang: {{ $history->susu_siang ?? "-" }} ml</small></p>
                                                <p class="mb-1"><small><i class="fas fa-moon text-info me-2"></i>Sore: {{ $history->susu_sore ?? "-" }} ml</small></p>
                                            </div>
                                        </div>
                                        <div class="col-md-4 info-col">
                                            <div class="info-card">
                                                <h5><i class="fas fa-tint me-2"></i>Air Putih</h5>
                                                <p class="mb-1"><small><i class="fas fa-sun text-warning me-2"></i>Pagi: {{ $history->air_putih_pagi ?? "-" }} ml</small></p>
                                                <p class="mb-1"><small><i class="fas fa-cloud-sun text-primary me-2"></i>Siang: {{ $history->air_putih_siang ?? "-" }} ml</small></p>
                                                <p class="mb-1"><small><i class="fas fa-moon text-info me-2"></i>Sore: {{ $history->air_putih_sore ?? "-" }} ml</small></p>
                                            </div>
                                        </div>
                                        <div class="col-md-4 info-col">
                                            <div class="info-card">
                                                <h5><i class="fas fa-toilet me-2"></i>BAK</h5>
                                                <p class="mb-1"><small><i class="fas fa-sun text-warning me-2"></i>Pagi: {{ $history->bak_pagi ?? "-" }} X</small></p>
                                                <p class="mb-1"><small><i class="fas fa-cloud-sun text-primary me-2"></i>Siang: {{ $history->bak_siang ?? "-" }} X</small></p>
                                                <p class="mb-1"><small><i class="fas fa-moon text-info me-2"></i>Sore: {{ $history->bak_sore ?? "-" }} X</small></p>
                                            </div>
                                        </div>
                                        <div class="col-md-4 info-col">
                                            <div class="info-card">
                                                <h5><i class="fas fa-poop me-2"></i>BAB</h5>
                                                <p class="mb-1"><small><i class="fas fa-sun text-warning me-2"></i>Pagi: {{ $history->bab_pagi ?? "-" }} X</small></p>
                                                <p class="mb-1"><small><i class="fas fa-cloud-sun text-primary me-2"></i>Siang: {{ $history->bab_siang ?? "-" }} X</small></p>
                                                <p class="mb-1"><small><i class="fas fa-moon text-info me-2"></i>Sore: {{ $history->bab_sore ?? "-" }} X</small></p>
                                            </div>
                                        </div>
                                        <div class="col-md-4 info-col">
                                            <div class="info-card">
                                                <h5><i class="fas fa-bed me-2"></i>Tidur</h5>
                                                <p class="mb-1"><small><i class="fas fa-sun text-warning me-2"></i>Pagi: {{ $history->tidur_pagi ?? "-" }} X</small></p>
                                                <p class="mb-1"><small><i class="fas fa-cloud-sun text-primary me-2"></i>Siang: {{ $history->tidur_siang ?? "-" }} X</small></p>
                                                <p class="mb-1"><small><i class="fas fa-moon text-info me-2"></i>Sore: {{ $history->tidur_sore ?? "-" }} X</small></p>
                                            </div>
                                        </div>
                                        <div class="col-md-4 info-col">
                                            <div class="info-card">
                                                <h5><i class="fas fa-home me-2"></i>Kegiatan Indoor</h5>
                                                <small>
                                                    @php
                                                        $kegiatanIndoor = json_decode($history->kegiatan_indoor, true) ?? [];
                                                    @endphp
                                                    @if(count($kegiatanIndoor) > 0)
                                                        <ul class="list-unstyled mb-0">
                                                            @foreach($kegiatanIndoor as $item)
                                                                <li>- {{ $item }}</li>
                                                            @endforeach
                                                        </ul>
                                                    @else
                                                        <p>Tidak ada kegiatan indoor</p>
                                                    @endif
                                                </small>
                                            </div>
                                        </div>
                                        <div class="col-md-4 info-col">
                                            <div class="info-card">
                                                <h5><i class="fas fa-running me-2"></i>Kegiatan Outdoor</h5>
                                                <small>
                                                    @php
                                                        $kegiatan = json_decode($history->kegiatan_outdoor, true) ?? [];
                                                    @endphp
                                                    @if(count($kegiatan) > 0)
                                                        <ul class="list-unstyled mb-0">
                                                            @foreach($kegiatan as $item)
                                                                <li>- {{ $item }}</li>
                                                            @endforeach
                                                        </ul>
                                                    @else
                                                        <p>Tidak ada kegiatan outdoor</p>
                                                    @endif
                                                </small>
                                            </div>
                                        </div>
                                        <div class="col-md-4 info-col">
                                            <div class="info-card">
                                                <h5><i class="fas fa-heartbeat me-2"></i>Kondisi</h5>
                                                <p class="mb-0">
                                                    @if($history->kondisi)
                                                        <span class="badge {{ $history->kondisi === 'sehat' ? 'bg-success' : 'bg-danger' }}">
                                                            {{ ucfirst($history->kondisi) }}
                                                        </span>
                                                    @else
                                                        <span class="text-muted">Belum diisi</span>
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-4 info-col">
                                            <div class="info-card">
                                                <h5><i class="fas fa-pills me-2"></i>Obat</h5>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <p class="mb-1"><small><i class="fas fa-sun text-warning me-2"></i>Pagi: {{ $history->obat_pagi ?? 'Tidak ada' }}</small></p>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <p class="mb-1"><small><i class="fas fa-cloud-sun text-primary me-2"></i>Siang: {{ $history->obat_siang ?? 'Tidak ada' }}</small></p>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <p class="mb-1"><small><i class="fas fa-moon text-info me-2"></i>Sore: {{ $history->obat_sore ?? 'Tidak ada' }}</small></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 info-col">
                                            <div class="info-card">
                                                <h5><i class="fas fa-cookie-bite me-2"></i>Makanan & Camilan</h5>
                                                <p class="mb-1"><small><i class="fas fa-sun text-warning me-2"></i>Pagi:</small></p>
                                                <small>
                                                    @php
                                                        $makananCamilanPagi = json_decode($selectedChild->makanan_camilan_pagi, true) ?? [];
                                                    @endphp
                                                    @if(count($makananCamilanPagi) > 0)
                                                        <ul class="list-unstyled mb-0">
                                                            @foreach($makananCamilanPagi as $item)
                                                                <li>- {{ $item }}</li>
                                                            @endforeach
                                                        </ul>
                                                    @else
                                                        <p>Tidak ada</p>
                                                    @endif
                                                </small>
                                                <p class="mb-1"><small><i class="fas fa-moon text-info me-2"></i>Siang:</small></p>
                                                <small>
                                                    @php
                                                        $makananCamilanSiang = json_decode($selectedChild->makanan_camilan_siang, true) ?? [];
                                                    @endphp
                                                    @if(count($makananCamilanSiang) > 0)
                                                        <ul class="list-unstyled mb-0">
                                                            @foreach($makananCamilanSiang as $item)
                                                                <li>- {{ $item }}</li>
                                                            @endforeach
                                                        </ul>
                                                    @else
                                                        <p>Tidak ada</p>
                                                    @endif
                                                </small>
                                                <p class="mb-1"><small><i class="fas fa-moon text-info me-2"></i>Sore:</small></p>
                                                <small>
                                                    @php
                                                        $makananCamilanSore = json_decode($selectedChild->makanan_camilan_sore, true) ?? [];
                                                    @endphp
                                                    @if(count($makananCamilanSore) > 0)
                                                        <ul class="list-unstyled mb-0">
                                                            @foreach($makananCamilanSore as $item)
                                                                <li>- {{ $item }}</li>
                                                            @endforeach
                                                        </ul>
                                                    @else
                                                        <p>Tidak ada</p>
                                                    @endif
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mb-0 mt-3">
                                        <i class="fas fa-comment me-2"></i>
                                        Keterangan: {{ $history->keterangan ?? 'Tidak ada' }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                        @if($selectedChild->histories->count() > 5)
                            <div class="text-center mt-3">
                                <a href="#" class="btn btn-outline-primary btn-sm">Lihat Semua Riwayat</a>
                            </div>
                        @endif
                    @elseif($selectedChild)
                        <p class="card-text text-muted">Tidak ada riwayat tersedia untuk anak ini.</p>
                    @else
                        <p class="card-text text-muted">Pilih anak untuk melihat riwayat.</p>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="col-md-4 order-md-2 order-1 mb-4 mb-md-0">
            <div class="card sticky-top" style="top: 20px;">
                <div class="card-header">
                    <h3 class="mb-0"><i class="fas fa-child me-2"></i>Anak Anda</h3>
                </div>
                <div class="card-body">
                    @if($children->count() > 0)
                        <ul class="list-group list-group-flush">
                            @foreach($children as $child)
                                <li class="list-group-item p-0">
                                    <a href="{{ route('dashboard', ['child_id' => $child->id]) }}" class="text-decoration-none d-block p-3 text-dark {{ $selectedChild && $selectedChild->id == $child->id ? 'bg-light' : '' }}">
                                        <i class="fas fa-user me-2 text-primary"></i>{{ $child->nama }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="card-text text-muted">No children in the list.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
function toggleHistory(id) {
    const historyElement = document.getElementById(`history-${id}`);
    const toggleIcon = document.getElementById(`toggle-icon-${id}`);
    
    if (historyElement.classList.contains('show')) {
        historyElement.classList.remove('show');
        toggleIcon.classList.remove('fa-chevron-up');
        toggleIcon.classList.add('fa-chevron-down');
    } else {
        historyElement.classList.add('show');
        toggleIcon.classList.remove('fa-chevron-down');
        toggleIcon.classList.add('fa-chevron-up');
    }
}
</script>
</body>
</html>
