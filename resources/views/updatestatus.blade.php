<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Status Anak</title>
    <link rel="icon" type="image/png" href="{{ asset('Upinipin.png') }}">
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
        .milk-container {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }
        .milk-item {
            flex: 1;
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 10px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        .milk-icon {
            font-size: 1.5rem;
            color: #007bff;
            margin-bottom: 5px;
        }
        .milk-label {
            font-size: 0.8rem;
            font-weight: bold;
            color: #6c757d;
            margin-top: 5px;
        }
        .milk-item .input-group {
            justify-content: center;
        }
        .milk-item .form-control {
            text-align: center;
            border-radius: 5px 0 0 5px;
        }
        .milk-item .input-group-text {
            border-radius: 0 5px 5px 0;
            background-color: #007bff;
            color: white;
        }
        .form-row {
            display: flex;
            flex-wrap: nowrap;
            gap: 10px;
        }
        .form-row > div {
            flex: 1;
            min-width: 0;
        }
        .date-input-group {
            position: relative;
        }
        .date-input-group .form-control {
            padding-right: 30px;
        }
        .date-input-group .calendar-icon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: black;
            pointer-events: none;
        }
        @media (max-width: 576px) {
            .form-row {
                flex-direction: row;
            }
            .form-row > div {
                width: 50%;
            }
            .form-control {
                font-size: 0.875rem;
            }
            .form-label {
                font-size: 0.875rem;
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
                    <div class="form-row mb-2">
                        <div>
                            <label for="nama_pendamping" class="form-label"><i class="fas fa-user me-2"></i>Nama Pendamping</label>
                            <input type="text" class="form-control form-control-sm" id="nama_pendamping" name="nama_pendamping">
                        </div>
                        <div>
                            <label for="tanggal" class="form-label"><i class="fas fa-calendar-alt me-2"></i>Tanggal</label>
                            <div class="date-input-group">
                                <input type="text" class="form-control form-control-sm" id="tanggal" name="tanggal" required>
                                <i class="fas fa-calendar-alt calendar-icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label class="form-label"><i class="fas fa-utensils me-2"></i>Makan</label>
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
                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-bottle-water me-2"></i>Susu</label>
                        <div class="milk-container">
                            <div class="milk-item">
                                <div class="milk-icon"><i class="fas fa-sun"></i></div>
                                <div class="milk-label">Pagi</div>
                                <div class="input-group input-group-sm">
                                    <input type="number" class="form-control" id="susu_pagi" name="susu_pagi" min="0" value="{{ $child->susu_pagi }}">
                                    <span class="input-group-text">ml</span>
                                </div>
                            </div>
                            <div class="milk-item">
                                <div class="milk-icon"><i class="fas fa-cloud-sun"></i></div>
                                <div class="milk-label">Siang</div>
                                <div class="input-group input-group-sm">
                                    <input type="number" class="form-control" id="susu_siang" name="susu_siang" min="0" value="{{ $child->susu_siang }}">
                                    <span class="input-group-text">ml</span>
                                </div>
                            </div>
                            <div class="milk-item">
                                <div class="milk-icon"><i class="fas fa-moon"></i></div>
                                <div class="milk-label">Sore</div>
                                <div class="input-group input-group-sm">
                                    <input type="number" class="form-control" id="susu_sore" name="susu_sore" min="0" value="{{ $child->susu_sore }}">
                                    <span class="input-group-text">ml</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- New section for water intake -->
                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-tint me-2"></i>Air Putih</label>
                        <div class="milk-container">
                            <div class="milk-item">
                                <div class="milk-icon"><i class="fas fa-sun"></i></div>
                                <div class="milk-label">Pagi</div>
                                <div class="input-group input-group-sm">
                                    <input type="number" class="form-control" id="air_putih_pagi" name="air_putih_pagi" min="0" value="{{ $child->air_putih_pagi }}">
                                    <span class="input-group-text">ml</span>
                                </div>
                            </div>
                            <div class="milk-item">
                                <div class="milk-icon"><i class="fas fa-cloud-sun"></i></div>
                                <div class="milk-label">Siang</div>
                                <div class="input-group input-group-sm">
                                    <input type="number" class="form-control" id="air_putih_siang" name="air_putih_siang" min="0" value="{{ $child->air_putih_siang }}">
                                    <span class="input-group-text">ml</span>
                                </div>
                            </div>
                            <div class="milk-item">
                                <div class="milk-icon"><i class="fas fa-moon"></i></div>
                                <div class="milk-label">Sore</div>
                                <div class="input-group input-group-sm">
                                    <input type="number" class="form-control" id="air_putih_sore" name="air_putih_sore" min="0" value="{{ $child->air_putih_sore }}">
                                    <span class="input-group-text">ml</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-toilet me-2"></i>BAK (Buang Air Kecil)</label>
                        <div class="milk-container">
                            <div class="milk-item">
                                <div class="milk-icon"><i class="fas fa-sun"></i></div>
                                <div class="milk-label">Pagi</div>
                                <div class="input-group input-group-sm">
                                    <input type="number" class="form-control" id="bak_pagi" name="bak_pagi" min="0" value="{{ $child->bak_pagi }}">
                                    <span class="input-group-text">X</span>
                                </div>
                            </div>
                            <div class="milk-item">
                                <div class="milk-icon"><i class="fas fa-cloud-sun"></i></div>
                                <div class="milk-label">Siang</div>
                                <div class="input-group input-group-sm">
                                    <input type="number" class="form-control" id="bak_siang" name="bak_siang" min="0" value="{{ $child->bak_siang }}">
                                    <span class="input-group-text">X</span>
                                </div>
                            </div>
                            <div class="milk-item">
                                <div class="milk-icon"><i class="fas fa-moon"></i></div>
                                <div class="milk-label">Sore</div>
                                <div class="input-group input-group-sm">
                                    <input type="number" class="form-control" id="bak_sore" name="bak_sore" min="0" value="{{ $child->bak_sore }}">
                                    <span class="input-group-text">X</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- New section for BAB -->
                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-poop me-2"></i>BAB (Buang Air Besar)</label>
                        <div class="milk-container">
                            <div class="milk-item">
                                <div class="milk-icon"><i class="fas fa-sun"></i></div>
                                <div class="milk-label">Pagi</div>
                                <div class="input-group input-group-sm">
                                    <input type="number" class="form-control" id="bab_pagi" name="bab_pagi" min="0" value="{{ $child->bab_pagi }}">
                                    <span class="input-group-text">X</span>
                                </div>
                            </div>
                            <div class="milk-item">
                                <div class="milk-icon"><i class="fas fa-cloud-sun"></i></div>
                                <div class="milk-label">Siang</div>
                                <div class="input-group input-group-sm">
                                    <input type="number" class="form-control" id="bab_siang" name="bab_siang" min="0" value="{{ $child->bab_siang }}">
                                    <span class="input-group-text">X</span>
                                </div>
                            </div>
                            <div class="milk-item">
                                <div class="milk-icon"><i class="fas fa-moon"></i></div>
                                <div class="milk-label">Sore</div>
                                <div class="input-group input-group-sm">
                                    <input type="number" class="form-control" id="bab_sore" name="bab_sore" min="0" value="{{ $child->bab_sore }}">
                                    <span class="input-group-text">X</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- New section for Tidur -->
                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-bed me-2"></i>Tidur</label>
                        <div class="milk-container">
                            <div class="milk-item">
                                <div class="milk-icon"><i class="fas fa-sun"></i></div>
                                <div class="milk-label">Pagi</div>
                                <div class="input-group input-group-sm">
                                    <input type="number" class="form-control" id="tidur_pagi" name="tidur_pagi" min="0" value="{{ $child->tidur_pagi }}">
                                    <span class="input-group-text">X</span>
                                </div>
                            </div>
                            <div class="milk-item">
                                <div class="milk-icon"><i class="fas fa-cloud-sun"></i></div>
                                <div class="milk-label">Siang</div>
                                <div class="input-group input-group-sm">
                                    <input type="number" class="form-control" id="tidur_siang" name="tidur_siang" min="0" value="{{ $child->tidur_siang }}">
                                    <span class="input-group-text">X</span>
                                </div>
                            </div>
                            <div class="milk-item">
                                <div class="milk-icon"><i class="fas fa-moon"></i></div>
                                <div class="milk-label">Sore</div>
                                <div class="input-group input-group-sm">
                                    <input type="number" class="form-control" id="tidur_sore" name="tidur_sore" min="0" value="{{ $child->tidur_sore }}">
                                    <span class="input-group-text">X</span>
                                </div>
                            </div>
                        </div>
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
            defaultDate: "today",
            allowInput: true,
            clickOpens: true,
            onOpen: function(selectedDates, dateStr, instance) {
                instance.setDate(instance.input.value, false);
            },
            disableMobile: "true",
            monthSelectorType: "static",
            animate: true
        });

        document.querySelectorAll('.meal-group').forEach(group => {
            const radios = group.querySelectorAll('input[type="radio"]');
            const customInput = group.querySelector('.custom-input');
            const lainnyaRadio = group.querySelector('input[value="custom"]');
            const lainnyaLabel = lainnyaRadio.nextElementSibling;
            
            radios.forEach(radio => {
                radio.addEventListener('click', function(event) {
                    if (this.checked) {
                        if (this.dataset.wasChecked === 'true') {
                            this.checked = false;
                            this.dataset.wasChecked = 'false';
                            customInput.style.display = 'none';
                            if (this.value === 'custom') {
                                lainnyaLabel.style.display = 'inline';
                            }
                        } else {
                            radios.forEach(r => r.dataset.wasChecked = 'false');
                            this.dataset.wasChecked = 'true';
                            customInput.style.display = this.value === 'custom' ? 'inline-block' : 'none';
                            if (this.value === 'custom') {
                                lainnyaLabel.style.display = 'none';
                                customInput.focus();
                            }
                        }
                    }
                    
                    radios.forEach(r => {
                        if (r.value === 'custom') {
                            r.nextElementSibling.style.display = r.checked ? 'none' : 'inline';
                        }
                    });
                });
            });
        });
    });
    </script>
</body>
</html>
