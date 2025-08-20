<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} - Sistem Permohonan Digital</title>

    <!-- Bootstrap CSS 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #3b82f6;
            --primary-dark: #1d4ed8;
            --secondary: #64748b;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
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
            background-color: white;
            color: var(--dark);
            line-height: 1.6;
        }

        /* Header */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border);
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary) !important;
        }

        .navbar-nav .nav-link {
            font-weight: 500;
            color: var(--dark) !important;
            margin: 0 0.5rem;
            padding: 0.5rem 1rem !important;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
        }

        .navbar-nav .nav-link:hover {
            background-color: var(--light);
            color: var(--primary) !important;
        }

        .btn-outline-primary {
            border: 2px solid var(--primary);
            color: var(--primary);
            font-weight: 500;
            border-radius: 0.75rem;
            padding: 0.5rem 1.5rem;
            transition: all 0.2s ease;
        }

        .btn-outline-primary:hover {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
            transform: translateY(-1px);
        }

        .btn-primary {
            background: var(--primary);
            border: none;
            font-weight: 600;
            border-radius: 0.75rem;
            padding: 0.75rem 2rem;
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 120px 0 80px;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" fill="white" opacity="0.1"><polygon points="0,0 0,100 1000,100"/></svg>');
            background-size: cover;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero h1 {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }

        .hero .lead {
            font-size: 1.25rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }

        .hero-image {
            position: relative;
            z-index: 2;
        }

        .hero-image img {
            max-width: 100%;
            height: auto;
            border-radius: 1rem;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
        }

        /* Features Section */
        .features {
            padding: 80px 0;
            background-color: var(--light);
        }

        .feature-card {
            background: white;
            border-radius: 1rem;
            padding: 2.5rem 2rem;
            text-align: center;
            border: 1px solid var(--border);
            transition: all 0.3s ease;
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 2rem;
            color: white;
        }

        .feature-card h4 {
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--dark);
        }

        .feature-card p {
            color: var(--secondary);
            margin-bottom: 0;
        }

        /* Services Section */
        .services {
            padding: 80px 0;
            background: white;
        }

        .service-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 2rem;
            padding: 1.5rem;
            border-radius: 0.75rem;
            transition: all 0.2s ease;
        }

        .service-item:hover {
            background-color: var(--light);
        }

        .service-icon {
            width: 50px;
            height: 50px;
            background: var(--primary);
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            flex-shrink: 0;
            color: white;
        }

        .service-content h5 {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--dark);
        }

        .service-content p {
            color: var(--secondary);
            margin-bottom: 0;
            font-size: 0.9rem;
        }

        /* CTA Section */
        .cta {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            padding: 80px 0;
            color: white;
            text-align: center;
        }

        .cta h2 {
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .cta p {
            font-size: 1.1rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }

        .btn-light {
            background: white;
            color: var(--primary);
            border: none;
            font-weight: 600;
            border-radius: 0.75rem;
            padding: 0.75rem 2rem;
            transition: all 0.2s ease;
        }

        .btn-light:hover {
            background: var(--light);
            color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 255, 255, 0.3);
        }

        /* Footer */
        .footer {
            background: var(--dark);
            color: white;
            padding: 40px 0 20px;
        }

        .footer h5 {
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .footer a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .footer a:hover {
            color: white;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin-top: 2rem;
            padding-top: 1rem;
            text-align: center;
            color: rgba(255, 255, 255, 0.7);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }

            .hero .lead {
                font-size: 1.1rem;
            }

            .hero {
                padding: 100px 0 60px;
            }

            .features, .services, .cta {
                padding: 60px 0;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="bi bi-file-earmark-text me-2"></i>
                {{ config('app.name') }}
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#beranda">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#perkhidmatan">Perkhidmatan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tentang">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#hubungi">Hubungi</a>
                    </li>
                </ul>

                @if (Route::has('login'))
                    <div class="ms-3">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn btn-outline-primary">
                                <i class="bi bi-speedometer2 me-2"></i>Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Log Masuk
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-primary">
                                    <i class="bi bi-person-plus me-2"></i>Daftar
                                </a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero" id="beranda">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="hero-content">
                        <h1>Sistem Permohonan Digital</h1>
                        <p class="lead">Platform digital yang memudahkan proses permohonan dokumen dan perkhidmatan secara online dengan pantas dan selamat.</p>
                        <div class="d-flex flex-wrap gap-3">
                            <a href="{{ route('register') }}" class="btn btn-light btn-lg">
                                <i class="bi bi-person-plus me-2"></i>Mula Sekarang
                            </a>
                            <a href="#perkhidmatan" class="btn btn-outline-light btn-lg">
                                <i class="bi bi-arrow-down me-2"></i>Ketahui Lebih Lanjut
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-image">
                        <div class="bg-white p-4 rounded shadow-lg">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-primary rounded-circle p-2 me-3">
                                    <i class="bi bi-file-earmark-text text-white"></i>
                                </div>
                                <h5 class="mb-0 text-dark">Permohonan Online</h5>
                            </div>
                            <div class="progress mb-3" style="height: 8px;">
                                <div class="progress-bar bg-primary" style="width: 75%"></div>
                            </div>
                            <small class="text-muted">Proses permohonan yang mudah dan pantas</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features" id="tentang">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="h1 fw-bold mb-3">Mengapa Pilih Kami?</h2>
                    <p class="lead text-muted">Platform yang direka untuk memberikan pengalaman terbaik dalam urusan permohonan dokumen</p>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-lightning-charge"></i>
                        </div>
                        <h4>Pantas & Efisien</h4>
                        <p>Proses permohonan yang dipermudahkan dengan teknologi terkini untuk menjimatkan masa anda.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h4>Selamat & Terpercaya</h4>
                        <p>Sistem keselamatan berlapis untuk melindungi maklumat peribadi dan dokumen anda.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-clock-history"></i>
                        </div>
                        <h4>24/7 Akses</h4>
                        <p>Akses perkhidmatan pada bila-bila masa dan di mana sahaja dengan platform online kami.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services" id="perkhidmatan">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="h1 fw-bold mb-3">Perkhidmatan Kami</h2>
                    <p class="lead text-muted">Pelbagai perkhidmatan permohonan dokumen yang tersedia untuk memudahkan urusan anda</p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="service-item">
                        <div class="service-icon">
                            <i class="bi bi-file-earmark-person"></i>
                        </div>
                        <div class="service-content">
                            <h5>Sijil Kelahiran</h5>
                            <p>Permohonan sijil kelahiran baharu atau salinan sijil kelahiran yang hilang</p>
                        </div>
                    </div>
                    <div class="service-item">
                        <div class="service-icon">
                            <i class="bi bi-heart"></i>
                        </div>
                        <div class="service-content">
                            <h5>Sijil Perkahwinan</h5>
                            <p>Permohonan sijil perkahwinan dan salinan dokumen perkahwinan</p>
                        </div>
                    </div>
                    <div class="service-item">
                        <div class="service-icon">
                            <i class="bi bi-file-earmark-x"></i>
                        </div>
                        <div class="service-content">
                            <h5>Sijil Kematian</h5>
                            <p>Permohonan sijil kematian dan dokumen berkaitan</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="service-item">
                        <div class="service-icon">
                            <i class="bi bi-building"></i>
                        </div>
                        <div class="service-content">
                            <h5>Lesen Perniagaan</h5>
                            <p>Permohonan lesen perniagaan dan permit berkaitan</p>
                        </div>
                    </div>
                    <div class="service-item">
                        <div class="service-icon">
                            <i class="bi bi-house"></i>
                        </div>
                        <div class="service-content">
                            <h5>Dokumen Hartanah</h5>
                            <p>Permohonan geran tanah, surat hak milik dan dokumen hartanah</p>
                        </div>
                    </div>
                    <div class="service-item">
                        <div class="service-icon">
                            <i class="bi bi-headset"></i>
                        </div>
                        <div class="service-content">
                            <h5>Sokongan Teknikal</h5>
                            <p>Bantuan dan sokongan untuk semua perkhidmatan dalam talian</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h2>Sedia untuk Memulakan?</h2>
                    <p>Daftar sekarang dan nikmati kemudahan perkhidmatan permohonan digital yang pantas dan selamat.</p>
                    <a href="{{ route('register') }}" class="btn btn-light btn-lg">
                        <i class="bi bi-person-plus me-2"></i>Daftar Sekarang
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer" id="hubungi">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h5>{{ config('app.name') }}</h5>
                    <p class="text-muted">Sistem permohonan digital yang memudahkan urusan dokumen dan perkhidmatan awam.</p>
                </div>
                <div class="col-lg-2 mb-4">
                    <h5>Pautan</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#beranda">Beranda</a></li>
                        <li class="mb-2"><a href="#perkhidmatan">Perkhidmatan</a></li>
                        <li class="mb-2"><a href="#tentang">Tentang</a></li>
                        <li class="mb-2"><a href="#hubungi">Hubungi</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 mb-4">
                    <h5>Perkhidmatan</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#">Sijil Kelahiran</a></li>
                        <li class="mb-2"><a href="#">Sijil Perkahwinan</a></li>
                        <li class="mb-2"><a href="#">Lesen Perniagaan</a></li>
                        <li class="mb-2"><a href="#">Dokumen Hartanah</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 mb-4">
                    <h5>Hubungi Kami</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="bi bi-telephone me-2"></i>
                            +60 3-2000 0000
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-envelope me-2"></i>
                            info@jdn.gov.my
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-geo-alt me-2"></i>
                            Kuala Lumpur, Malaysia
                        </li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} {{ config('app.name') }}. Hak Cipta Terpelihara.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Navbar background on scroll
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.style.background = 'rgba(255, 255, 255, 0.98)';
            } else {
                navbar.style.background = 'rgba(255, 255, 255, 0.95)';
            }
        });
    </script>
</body>
</html>