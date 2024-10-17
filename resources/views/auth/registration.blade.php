<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            overflow: hidden;
        }
        body {
            background-color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .container {
            max-height: 100%;
            overflow-y: auto;
        }
        .card {
            border-radius: 1rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #007bff;
            color: white;
            border-radius: 1rem 1rem 0 0;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        @media (max-height: 600px) {
            .card-body {
                padding: 1rem !important;
            }
            .mb-4 {
                margin-bottom: 0.5rem !important;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card">
                    <div class="card-header text-center py-4">
                        <h2 class="mb-0">Register</h2>
                    </div>
                    <div class="card-body p-5">
                        @if(session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('register.post') }}" id="registrationForm">
                            @csrf
                            <div class="mb-4">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required autofocus>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                        <i class="fas fa-eye" id="toggleIcon"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                                    <button class="btn btn-outline-secondary" type="button" id="togglePasswordConfirmation">
                                        <i class="fas fa-eye" id="toggleIconConfirmation"></i>
                                    </button>
                                </div>
                                <div class="invalid-feedback" id="passwordMismatch" style="display: none;">
                                    Passwords do not match.
                                </div>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg" id="registerButton">Register</button>
                                <a href="{{ route('dashboardadmin') }}" class="btn btn-secondary btn-lg">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePasswordVisibility(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }

        document.getElementById('togglePassword').addEventListener('click', () => togglePasswordVisibility('password', 'toggleIcon'));
        document.getElementById('togglePasswordConfirmation').addEventListener('click', () => togglePasswordVisibility('password_confirmation', 'toggleIconConfirmation'));
    </script>
</body>
</html>
