<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Status Anak</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 800px;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .card-header {
            background-color: #007bff;
            color: white;
            border-radius: 15px 15px 0 0 !important;
            padding: 20px;
        }
        .form-label {
            font-weight: 600;
        }
        .meal-group {
            background-color: #f1f3f5;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
        }
        .meal-group h6 {
            color: #007bff;
            margin-bottom: 10px;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-secondary {
            background-color: #6c757d;
            border: none;
        }
        .btn-secondary:hover {
            background-color: #545b62;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <div class="card">
            <div class="card-header">
                <h2 class="mb-0"><i class="fas fa-child me-2"></i>Update Status Anak: {{ $child->nama }}</h2>
            </div>
            <div class="card-body">
                <form id="updateStatusForm" action="{{ route('children.updateStatus', $child->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="nama_pendamping" class="form-label"><i class="fas fa-user me-2"></i>Nama Pendamping</label>
                        <input type="text" class="form-control" id="nama_pendamping" name="nama_pendamping" value="{{ $child->nama_pendamping ?? old('nama_pendamping') }}">
                    </div>
                    <div class="mb-4">
                        <label class="form-label"><i class="fas fa-utensils me-2"></i>Status Makan</label>
                        <div class="meal-group">
                            <h6><i class="fas fa-sun me-2"></i>Pagi</h6>
                            @foreach(['1', '1/2', '1/3', '1/4'] as $value)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="makan_pagi" id="makan_pagi_{{ str_replace('/', '_', $value) }}" value="{{ $value }}" {{ $child->makan_pagi == $value ? 'checked' : '' }}>
                                    <label class="form-check-label" for="makan_pagi_{{ str_replace('/', '_', $value) }}">{{ $value }}</label>
                                </div>
                            @endforeach
                        </div>
                        <div class="meal-group">
                            <h6><i class="fas fa-cloud-sun me-2"></i>Siang</h6>
                            @foreach(['1', '1/2', '1/3', '1/4'] as $value)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="makan_siang" id="makan_siang_{{ str_replace('/', '_', $value) }}" value="{{ $value }}" {{ $child->makan_siang == $value ? 'checked' : '' }}>
                                    <label class="form-check-label" for="makan_siang_{{ str_replace('/', '_', $value) }}">{{ $value }}</label>
                                </div>
                            @endforeach
                        </div>
                        <div class="meal-group">
                            <h6><i class="fas fa-moon me-2"></i>Sore</h6>
                            @foreach(['1', '1/2', '1/3', '1/4'] as $value)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="makan_sore" id="makan_sore_{{ str_replace('/', '_', $value) }}" value="{{ $value }}" {{ $child->makan_sore == $value ? 'checked' : '' }}>
                                    <label class="form-check-label" for="makan_sore_{{ str_replace('/', '_', $value) }}">{{ $value }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="sudah_minum_obat" class="form-label"><i class="fas fa-pills me-2"></i>Status Minum Obat</label>
                        <select class="form-select" id="sudah_minum_obat" name="sudah_minum_obat">
                            <option value="1" {{ $child->sudah_minum_obat ? 'selected' : '' }}>Sudah</option>
                            <option value="0" {{ !$child->sudah_minum_obat ? 'selected' : '' }}>Belum</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="tanggal" class="form-label"><i class="fas fa-calendar-alt me-2"></i>Tanggal</label>
                        <input type="text" class="form-control" id="tanggal" name="tanggal" value="{{ $child->tanggal ? \Carbon\Carbon::parse($child->tanggal)->format('d-m-Y') : '' }}" required>
                    </div>
                    <div class="mb-4">
                        <label for="keterangan" class="form-label"><i class="fas fa-comment me-2"></i>Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="3">{{ $child->keterangan }}</textarea>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('dashboardanak') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i>Kembali</a>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr("#tanggal", {
            dateFormat: "d-m-Y",
            defaultDate: "today"
        });

        document.querySelectorAll('.meal-group').forEach(group => {
            const checkboxes = group.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    if (this.checked) {
                        checkboxes.forEach(cb => {
                            if (cb !== this) cb.checked = false;
                        });
                    }
                });
            });
        });
    });
    </script>
</body>
</html>
