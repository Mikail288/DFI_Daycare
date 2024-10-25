<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat {{ $child->nama }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,.1);
            margin-bottom: 20px;
        }
        .card-header {
            background-color: #f8f9fa;
            border-bottom: none;
            padding: 15px 20px;
        }
        .card-body {
            padding: 20px;
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
        @media (max-width: 767px) {
            .info-col {
                flex: 0 0 50%;
                max-width: 50%;
            }
        }
        .modal-dialog-centered {
            display: flex;
            align-items: center;
            min-height: calc(100% - 1rem);
        }

        @media (min-width: 576px) {
            .modal-dialog-centered {
                min-height: calc(100% - 3.5rem);
            }
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <a href="{{ route('dashboard') }}" class="btn btn-primary me-3">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <h1 class="mb-0">Riwayat {{ $child->nama }}</h1>
            </div>
            <button id="download-btn" class="btn btn-success">
                <i class="fas fa-download"></i> Download
            </button>
        </div>
        @foreach($histories as $history)
            <div class="card mb-3">
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
                        <!-- Makan -->
                        <div class="col-md-4 info-col">
                            <div class="info-card">
                                <h5><i class="fas fa-utensils me-2"></i>Makan</h5>
                                <p class="mb-1"><small><i class="fas fa-sun text-warning me-2"></i>Pagi: {{ $history->makan_pagi ?? 'Belum' }}</small></p>
                                <p class="mb-1"><small><i class="fas fa-cloud-sun text-primary me-2"></i>Siang: {{ $history->makan_siang ?? 'Belum' }}</small></p>
                                <p class="mb-1"><small><i class="fas fa-moon text-info me-2"></i>Sore: {{ $history->makan_sore ?? 'Belum' }}</small></p>
                            </div>
                        </div>
                        <!-- Susu -->
                        <div class="col-md-4 info-col">
                            <div class="info-card">
                                <h5><i class="fas fa-bottle-water me-2"></i>Susu</h5>
                                <p class="mb-1"><small><i class="fas fa-sun text-warning me-2"></i>Pagi: {{ $history->susu_pagi ?? "-" }} ml</small></p>
                                <p class="mb-1"><small><i class="fas fa-cloud-sun text-primary me-2"></i>Siang: {{ $history->susu_siang ?? "-" }} ml</small></p>
                                <p class="mb-1"><small><i class="fas fa-moon text-info me-2"></i>Sore: {{ $history->susu_sore ?? "-" }} ml</small></p>
                            </div>
                        </div>
                        <!-- Air Putih -->
                        <div class="col-md-4 info-col">
                            <div class="info-card">
                                <h5><i class="fas fa-tint me-2"></i>Air Putih</h5>
                                <p class="mb-1"><small><i class="fas fa-sun text-warning me-2"></i>Pagi: {{ $history->air_putih_pagi ?? "-" }} ml</small></p>
                                <p class="mb-1"><small><i class="fas fa-cloud-sun text-primary me-2"></i>Siang: {{ $history->air_putih_siang ?? "-" }} ml</small></p>
                                <p class="mb-1"><small><i class="fas fa-moon text-info me-2"></i>Sore: {{ $history->air_putih_sore ?? "-" }} ml</small></p>
                            </div>
                        </div>
                        <!-- BAK -->
                        <div class="col-md-4 info-col">
                            <div class="info-card">
                                <h5><i class="fas fa-toilet me-2"></i>BAK</h5>
                                <p class="mb-1"><small><i class="fas fa-sun text-warning me-2"></i>Pagi: {{ $history->bak_pagi ?? "-" }} X</small></p>
                                <p class="mb-1"><small><i class="fas fa-cloud-sun text-primary me-2"></i>Siang: {{ $history->bak_siang ?? "-" }} X</small></p>
                                <p class="mb-1"><small><i class="fas fa-moon text-info me-2"></i>Sore: {{ $history->bak_sore ?? "-" }} X</small></p>
                            </div>
                        </div>
                        <!-- BAB -->
                        <div class="col-md-4 info-col">
                            <div class="info-card">
                                <h5><i class="fas fa-poop me-2"></i>BAB</h5>
                                <p class="mb-1"><small><i class="fas fa-sun text-warning me-2"></i>Pagi: {{ $history->bab_pagi ?? "-" }} X</small></p>
                                <p class="mb-1"><small><i class="fas fa-cloud-sun text-primary me-2"></i>Siang: {{ $history->bab_siang ?? "-" }} X</small></p>
                                <p class="mb-1"><small><i class="fas fa-moon text-info me-2"></i>Sore: {{ $history->bab_sore ?? "-" }} X</small></p>
                            </div>
                        </div>
                        <!-- Tidur -->
                        <div class="col-md-4 info-col">
                            <div class="info-card">
                                <h5><i class="fas fa-bed me-2"></i>Tidur</h5>
                                <p class="mb-1"><small><i class="fas fa-sun text-warning me-2"></i>Pagi: {{ $history->tidur_pagi ?? "-" }} X</small></p>
                                <p class="mb-1"><small><i class="fas fa-cloud-sun text-primary me-2"></i>Siang: {{ $history->tidur_siang ?? "-" }} X</small></p>
                                <p class="mb-1"><small><i class="fas fa-moon text-info me-2"></i>Sore: {{ $history->tidur_sore ?? "-" }} X</small></p>
                            </div>
                        </div>
                        <!-- Kegiatan Indoor -->
                        <div class="col-md-6 info-col">
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
                        <!-- Kegiatan Outdoor -->
                        <div class="col-md-6 info-col">
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
                        <!-- Kondisi -->
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
                        <!-- Obat -->
                        <div class="col-md-4 info-col">
                            <div class="info-card">
                                <h5><i class="fas fa-pills me-2"></i>Obat</h5>
                                <p class="mb-1"><small><i class="fas fa-sun text-warning me-2"></i>Pagi: {{ $history->obat_pagi ?? 'Tidak ada' }}</small></p>
                                <p class="mb-1"><small><i class="fas fa-cloud-sun text-primary me-2"></i>Siang: {{ $history->obat_siang ?? 'Tidak ada' }}</small></p>
                                <p class="mb-1"><small><i class="fas fa-moon text-info me-2"></i>Sore: {{ $history->obat_sore ?? 'Tidak ada' }}</small></p>
                            </div>
                        </div>
                        <!-- Makanan & Camilan -->
                        <div class="col-md-4 info-col">
                            <div class="info-card">
                                <h5><i class="fas fa-cookie-bite me-2"></i>Makanan & Camilan</h5>
                                <p class="mb-1"><small><i class="fas fa-sun text-warning me-2"></i>Pagi:</small></p>
                                <small>
                                    @php
                                        $makananCamilanPagi = json_decode($history->makanan_camilan_pagi, true) ?? [];
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
                                        $makananCamilanSiang = json_decode($history->makanan_camilan_siang, true) ?? [];
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
                                        $makananCamilanSore = json_decode($history->makanan_camilan_sore, true) ?? [];
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
        
        <div class="d-flex justify-content-center mt-4">
            {{ $histories->links('pagination::bootstrap-4') }}
        </div>
    </div>

    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="errorToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-danger text-white">
                <strong class="me-auto">Error</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Terjadi kesalahan saat mengunduh Excel.
            </div>
        </div>
    </div>

    <div class="modal fade" id="dateRangeModal" tabindex="-1" aria-labelledby="dateRangeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dateRangeModalLabel">Download Excel</h5>
                </div>
                <div class="modal-body">
                    <p>Pilih rentang tanggal yang ingin di download</p>
                    <input type="text" id="daterange" class="form-control" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success" id="apply-daterange">Download</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>
        function toggleHistory(id) {
            var content = document.getElementById('history-' + id);
            var icon = document.getElementById('toggle-icon-' + id);
            content.classList.toggle('show');
            icon.classList.toggle('fa-chevron-up');
            icon.classList.toggle('fa-chevron-down');
        }

        $(document).ready(function() {
            $('#download-btn').on('click', function() {
                $('#dateRangeModal').modal('show');
            });

            var dateRangeModal = new bootstrap.Modal(document.getElementById('dateRangeModal'));

            $('#dateRangeModal').on('shown.bs.modal', function() {
                $('#daterange').daterangepicker({
                    opens: 'left',
                    locale: {
                        format: 'DD-MM-YYYY'
                    }
                });
            });

            $('#apply-daterange').on('click', function() {
                var dateRange = $('#daterange').val();
                var childId = {{ $child->id }};
                var childName = "{{ $child->nama }}";

                $.ajax({
                    url: '{{ route('children.downloadExcel', ['id' => $child->id]) }}',
                    type: 'POST',
                    data: {
                        daterange: dateRange,
                        _token: '{{ csrf_token() }}'
                    },
                    xhrFields: {
                        responseType: 'blob'
                    },
                    success: function(response) {
                        var blob = new Blob([response], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });
                        var link = document.createElement('a');
                        link.href = window.URL.createObjectURL(blob);
                        link.download = 'Riwayat ' + childName + '.xlsx';
                        link.click();
                        dateRangeModal.hide();
                    },
                    error: function() {
                        // Ganti alert dengan Toast
                        var errorToast = new bootstrap.Toast(document.getElementById('errorToast'));
                        errorToast.show();
                    }
                });
            });
        });
    </script>
</body>
</html>
