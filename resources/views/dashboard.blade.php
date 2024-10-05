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
        }
        .card-header {
            background-color: #007bff;
            color: white;
            border-radius: 15px 15px 0 0 !important;
        }
        .list-group-item {
            border: none;
            padding: 0.75rem 1.25rem;
        }
        .list-group-item:not(:last-child) {
            border-bottom: 1px solid #f1f1f1;
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
        <div class="col-md-8 mb-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h1 class="card-title display-5 fw-bold">Hi, {{ auth()->user()->name }}</h1>
                    <p class="card-text fs-4">Welcome to your dashboard.</p>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0"><i class="fas fa-thumbtack me-2"></i>Children Information</h3>
                </div>
                <div class="card-body">
                    @if($selectedChild)
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <h5 class="mb-1">{{ $selectedChild->name }}</h5>
                                <p class="mb-1">
                                    <span class="me-3">
                                        <i class="fas fa-utensils me-1"></i>
                                        Makan: <span class="badge {{ $selectedChild->has_eaten ? 'bg-success' : 'bg-danger' }}">
                                            {{ $selectedChild->has_eaten ? 'Sudah' : 'Belum' }}
                                        </span>
                                    </span>
                                    <span>
                                        <i class="fas fa-pills me-1"></i>
                                        Minum obat: <span class="badge {{ $selectedChild->has_taken_medicine ? 'bg-success' : 'bg-danger' }}">
                                            {{ $selectedChild->has_taken_medicine ? 'Sudah' : 'Belum' }}
                                        </span>
                                    </span>
                                </p>
                                <p class="mb-0"><small class="text-muted">Keterangan: {{ $selectedChild->notes ?? 'Tidak ada' }}</small></p>
                            </li>
                        </ul>
                    @else
                        <p class="card-text text-muted">No child selected. Click on a child from "Your Children" to view details.</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0"><i class="fas fa-child me-2"></i>Your Children</h3>
                </div>
                <div class="card-body">
                    @if($children->count() > 0)
                        <ul class="list-group list-group-flush">
                            @foreach($children as $child)
                                <li class="list-group-item">
                                    <a href="{{ route('dashboard', ['child_id' => $child->id]) }}" class="text-decoration-none">
                                        <i class="fas fa-user me-2"></i>{{ $child->name }}
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
</body>
</html>