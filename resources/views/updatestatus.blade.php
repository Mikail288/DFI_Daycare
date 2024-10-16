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
        body, html {
            height: 100%;
        }
        .container {
            height: 100%;
            display: flex;
            align-items: center;
            padding: 10px;
        }
        .card {
            width: 100%;
            max-width: 500px;
            margin: auto;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .card-header {
            background-color: #007bff;
            color: white;
            border-radius: 15px 15px 0 0 !important;
            padding: 15px;
        }
        .card-body {
            padding: 15px;
        }
        .form-label {
            font-weight: 600;
            margin-bottom: 0.25rem;
        }
        .meal-group {
            background-color: #f1f3f5;
            border-radius: 10px;
            padding: 10px;
            margin-bottom: 10px;
        }
        .meal-group h6 {
            color: #007bff;
            margin-bottom: 5px;
            font-size: 0.9rem;
        }
        .form-check-inline {
            margin-right: 0.5rem;
            margin-bottom: 0.25rem;
        }
        .form-check-label {
            font-size: 0.9rem;
        }
        .custom-input {
            width: 60px !important;
            display: inline-block;
            margin-left: 0.5rem;
        }
        @media (max-width: 576px) {
            .card-header h2 {
                font-size: 1.25rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2 class="mb-0"><i class="fas fa-user-edit me-2"></i>Update Status</h2>
            </div>
            <div class="card-body">
                <form id="updateStatusForm" action="{{ route('children.updateStatus', $child->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-2">
                        <label for="nama_pendamping" class="form-label"><i class="fas fa-user me-2"></i>Nama Pendamping</label>
                        <input type="text" class="form-control form-control-sm" id="nama_pendamping" name="nama_pendamping">
                    </div>
                    <div class="mb-2">
                        <label class="form-label"><i class="fas fa-utensils me-2"></i>Status Makan</label>
                        @foreach(['Pagi', 'Siang', 'Sore'] as $meal)
                            <div class="meal-group">
                                <h6><i class="fas fa-{{ $meal == 'Pagi' ? 'sun' : ($meal == 'Siang' ? 'cloud-sun' : 'moon') }} me-2"></i>{{ $meal }}</h6>
                                @foreach(['1', '1/2', '1/3', '1/4'] as $value)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="makan_{{ strtolower($meal) }}" id="makan_{{ strtolower($meal) }}_{{ str_replace('/', '_', $value) }}" value="{{ $value }}">
                                        <label class="form-check-label" for="makan_{{ strtolower($meal) }}_{{ str_replace('/', '_', $value) }}">{{ $value }}</label>
                                    </div>
                                @endforeach
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input lainnya-checkbox" type="radio" name="makan_{{ strtolower($meal) }}" id="makan_{{ strtolower($meal) }}_lainnya" value="custom">
                                    <label class="form-check-label" for="makan_{{ strtolower($meal) }}_lainnya">Lainnya</label>
                                    <input type="text" class="form-control form-control-sm custom-input" id="makan_{{ strtolower($meal) }}_custom" name="makan_{{ strtolower($meal) }}_custom" style="display: none;">
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mb-2">
                        <label for="tanggal" class="form-label"><i class="fas fa-calendar-alt me-2"></i>Tanggal</label>
                        <input type="text" class="form-control form-control-sm" id="tanggal" name="tanggal" required>
                    </div>
                    <div class="mb-2">
                        <label for="keterangan" class="form-label"><i class="fas fa-comment me-2"></i>Keterangan</label>
                        <textarea class="form-control form-control-sm" id="keterangan" name="keterangan" rows="3"></textarea>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save me-2"></i>Update</button>
                        <a href="{{ route('dashboardanak') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left me-2"></i>Kembali</a>
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
            const radios = group.querySelectorAll('input[type="radio"]');
            const customInput = group.querySelector('.custom-input');
            radios.forEach(radio => {
                radio.addEventListener('change', function() {
                    customInput.style.display = this.value === 'custom' ? 'inline-block' : 'none';
                });
            });
        });
    });
    </script>
</body>
</html>
