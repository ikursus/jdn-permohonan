<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran - {{ config('app.name') }}</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</head>
<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center min-vh-100 align-items-center">
            <div class="col-md-6">

                <div class="my-2 mb-3 fs-3 text-center">
                    <i class="bi bi-file-earmark-text me-2"></i>
                    {{ config('app.name') }}
                </div>

                <div class="card shadow">
                    <div class="card-body p-5">
                        <h3 class="text-center mb-4">Pendaftaran Akaun</h3>
                        
                        @include('alert')
                        
                        <form method="POST" action="{{ route('register.proses') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Penuh</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="email" class="form-label">Alamat Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="no_kp" class="form-label">No. Kad Pengenalan</label>
                                <input type="text" class="form-control @error('no_kp') is-invalid @enderror" 
                                       id="no_kp" name="no_kp" value="{{ old('no_kp') }}" 
                                       placeholder="000000-00-0000" required>
                                @error('no_kp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="no_telefon" class="form-label">No. Telefon</label>
                                <input type="text" class="form-control @error('no_telefon') is-invalid @enderror" 
                                       id="no_telefon" name="no_telefon" value="{{ old('no_telefon') }}" 
                                       placeholder="01X-XXXXXXX" required>
                                @error('no_telefon')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="password" class="form-label">Kata Laluan</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                       id="password" name="password" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Sahkan Kata Laluan</label>
                                <input type="password" class="form-control" 
                                       id="password_confirmation" name="password_confirmation" required>
                            </div>
                            
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
                                <label class="form-check-label" for="terms">
                                    Saya bersetuju dengan <a href="#" target="_blank">Terma dan Syarat</a>
                                </label>
                            </div>
                            
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="bi bi-person-plus me-2"></i>Daftar Akaun
                                </button>
                            </div>
                            
                            <div class="text-center mt-3">
                                <p>Sudah mempunyai akaun? <a href="{{ route('login') }}">Log masuk di sini</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>