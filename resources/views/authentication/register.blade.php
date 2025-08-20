<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran - {{ config('app.name') }}</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #3b82f6;
            --primary-dark: #1d4ed8;
            --secondary: #64748b;
            --success: #10b981;
            --dark: #0f172a;
            --light: #f8fafc;
            --border: #e2e8f0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 2rem 1rem;
        }
        
        .register-container {
            max-width: 500px;
            margin: 0 auto;
        }
        
        .brand-section {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .brand-logo {
            width: 80px;
            height: 80px;
            background: white;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        .brand-logo i {
            font-size: 2rem;
            color: var(--primary);
        }
        
        .brand-title {
            color: white;
            font-size: 1.875rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .brand-subtitle {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1rem;
        }
        
        .register-card {
            background: white;
            border-radius: 1.5rem;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            padding: 3rem 2.5rem;
            border: none;
        }
        
        .register-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .register-title {
            color: var(--dark);
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        
        .register-subtitle {
            color: var(--secondary);
            font-size: 0.875rem;
        }
        
        .form-floating {
            margin-bottom: 1.25rem;
        }
        
        .form-control {
            border: 2px solid var(--border);
            border-radius: 0.75rem;
            padding: 1rem 0.75rem 0.5rem;
            font-size: 0.875rem;
            transition: all 0.2s ease;
        }
        
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        
        .form-control.is-invalid {
            border-color: #dc2626;
        }
        
        .form-floating label {
            color: var(--secondary);
            font-size: 0.875rem;
            padding: 1rem 0.75rem;
        }
        
        .invalid-feedback {
            font-size: 0.75rem;
            margin-top: 0.25rem;
        }
        
        .btn-primary {
            background: var(--primary);
            border: none;
            border-radius: 0.75rem;
            padding: 0.875rem 1.5rem;
            font-weight: 600;
            font-size: 0.875rem;
            transition: all 0.2s ease;
            width: 100%;
        }
        
        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
        }
        
        .form-check {
            margin-bottom: 2rem;
        }
        
        .form-check-input:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }
        
        .form-check-label {
            color: var(--secondary);
            font-size: 0.875rem;
            line-height: 1.5;
        }
        
        .form-check-label a {
            color: var(--primary);
            text-decoration: none;
        }
        
        .form-check-label a:hover {
            text-decoration: underline;
        }
        
        .alert {
            border: none;
            border-radius: 0.75rem;
            padding: 1rem 1.25rem;
            margin-bottom: 1.5rem;
            font-size: 0.875rem;
        }
        
        .login-link {
            text-align: center;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid var(--border);
        }
        
        .login-link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }
        
        .login-link a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }
        
        @media (max-width: 576px) {
            body {
                padding: 1rem 0.5rem;
            }
            
            .register-card {
                padding: 2rem 1.5rem;
            }
            
            .brand-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <!-- Brand Section -->
        <div class="brand-section">
            <div class="brand-logo">
                <i class="bi bi-file-earmark-text"></i>
            </div>
            <h1 class="brand-title">{{ config('app.name') }}</h1>
            <p class="brand-subtitle">Sistem Permohonan Digital</p>
        </div>

        <!-- Register Card -->
        <div class="register-card">
            <div class="register-header">
                <h2 class="register-title">Pendaftaran Akaun</h2>
                <p class="register-subtitle">Sila isi maklumat untuk mendaftar akaun baharu</p>
            </div>

            @include('alert')
            
            <form method="POST" action="{{ route('register.proses') }}">
                @csrf
                <div class="form-floating">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           id="name" name="name" value="{{ old('name') }}" placeholder="Nama Penuh" required>
                    <label for="name">
                        <i class="bi bi-person me-2"></i>Nama Penuh
                    </label>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-floating">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                           id="email" name="email" value="{{ old('email') }}" placeholder="name@example.com" required>
                    <label for="email">
                        <i class="bi bi-envelope me-2"></i>Alamat Email
                    </label>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-floating">
                    <input type="text" class="form-control @error('no_kp') is-invalid @enderror" 
                           id="no_kp" name="no_kp" value="{{ old('no_kp') }}" 
                           placeholder="000000-00-0000" required>
                    <label for="no_kp">
                        <i class="bi bi-credit-card me-2"></i>No. Kad Pengenalan
                    </label>
                    @error('no_kp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-floating">
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                           id="phone" name="phone" value="{{ old('phone') }}" 
                           placeholder="01X-XXXXXXX" required>
                    <label for="phone">
                        <i class="bi bi-telephone me-2"></i>No. Telefon
                    </label>
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-floating">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                           id="password" name="password" placeholder="Password" required>
                    <label for="password">
                        <i class="bi bi-lock me-2"></i>Kata Laluan
                    </label>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-floating">
                    <input type="password" class="form-control" 
                           id="password_confirmation" name="password_confirmation" 
                           placeholder="Confirm Password" required>
                    <label for="password_confirmation">
                        <i class="bi bi-lock-fill me-2"></i>Sahkan Kata Laluan
                    </label>
                </div>
                
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="terms" name="terms" {{ old('terms') ? 'checked' : '' }} required>
                    <label class="form-check-label" for="terms">
                        Saya bersetuju dengan <a href="#" target="_blank">Terma dan Syarat</a> yang ditetapkan
                    </label>
                </div>
                
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-person-plus me-2"></i>
                    Daftar Akaun
                </button>
                
                <div class="login-link">
                    <p class="mb-0">Sudah mempunyai akaun? 
                        <a href="{{ route('login') }}">Log masuk di sini</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>