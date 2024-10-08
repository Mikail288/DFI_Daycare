<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details - {{ $user->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .card { border: none; border-radius: 15px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); }
        .card-header { background-color: #007bff; color: white; border-radius: 15px 15px 0 0; }
        .user-avatar { width: 150px; height: 150px; border-radius: 50%; object-fit: cover; border: 3px solid white; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); }
        .list-group-item { border: none; padding: 0.75rem 1.25rem; }
        .list-group-item:not(:last-child) { border-bottom: 1px solid #e9ecef; }
        .section-header { display: flex; justify-content: space-between; align-items: center; }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header text-center py-3">
                        <h2 class="mb-0">User Details</h2>
                    </div>
                    <div class="card-body">                        
                        <div class="section-header mb-3">
                            <h4><i class="fas fa-info-circle me-2"></i>User Details</h4>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit me-1"></i>Edit
                            </a>
                        </div>
                        <ul class="list-group mb-4">
                            <li class="list-group-item"><strong>Name:</strong> {{ $user->name }}</li>
                            <li class="list-group-item"><strong>Email:</strong> {{ $user->email }}</li>
                            <li class="list-group-item">
                                <strong>Role:</strong> 
                                <span class="badge bg-{{ $user->role == 'admin' ? 'primary' : 'success' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </li>
                        </ul>
                        
                        <h4 class="mb-3"><i class="fas fa-child me-2"></i>Anak</h4>
                        @if($user->children->count() > 0)
                            <ul class="list-group">
                                @foreach($user->children as $child)
                                    <li class="list-group-item">
                                        <strong>{{ $child->nama }}</strong>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-muted">Anak tidak terdaftar.</p>
                        @endif
                    </div>
                    <div class="card-footer text-center py-3">
                        <a href="{{ route('dashboardadmin') }}" class="btn btn-primary"><i class="fas fa-arrow-left me-2"></i>Back to Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
