<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Panel Pemohon') - JDN Permohonan</title>
    
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <style>
        :root {
            --sidebar-width: 280px;
            --header-height: 70px;
            --primary-color: #2563eb;
            --secondary-color: #64748b;
            --success-color: #059669;
            --warning-color: #d97706;
            --danger-color: #dc2626;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8fafc;
            margin: 0;
            padding: 0;
        }
        
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
            z-index: 1000;
            transition: transform 0.3s ease;
            overflow-y: auto;
        }
        
        .sidebar.collapsed {
            transform: translateX(-100%);
        }
        
        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .sidebar-brand {
            color: white;
            font-size: 1.25rem;
            font-weight: 600;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        
        .sidebar-brand:hover {
            color: #e2e8f0;
        }
        
        .sidebar-nav {
            padding: 1rem 0;
        }
        
        .nav-item {
            margin: 0.25rem 1rem;
        }
        
        .nav-link {
            color: #cbd5e1;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            transition: all 0.2s ease;
        }
        
        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
        }
        
        .nav-link.active {
            background-color: var(--primary-color);
            color: white;
        }
        
        .main-wrapper {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: margin-left 0.3s ease;
        }
        
        .main-wrapper.expanded {
            margin-left: 0;
        }
        
        .header {
            background: white;
            height: var(--header-height);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            padding: 0 2rem;
            position: sticky;
            top: 0;
            z-index: 999;
        }
        
        .header-left {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .sidebar-toggle {
            background: none;
            border: none;
            font-size: 1.25rem;
            color: var(--secondary-color);
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 0.375rem;
            transition: background-color 0.2s ease;
        }
        
        .sidebar-toggle:hover {
            background-color: #f1f5f9;
        }
        
        .header-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: #1e293b;
            margin: 0;
        }
        
        .header-right {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .user-menu {
            position: relative;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            cursor: pointer;
        }
        
        .main-content {
            padding: 2rem;
        }
        
        .content-header {
            margin-bottom: 2rem;
        }
        
        .page-title {
            font-size: 1.875rem;
            font-weight: 700;
            color: #1e293b;
            margin: 0 0 0.5rem 0;
        }
        
        .page-subtitle {
            color: var(--secondary-color);
            margin: 0;
        }
        
        .card {
            border: none;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border-radius: 0.75rem;
        }
        
        .card-header {
            background: white;
            border-bottom: 1px solid #e2e8f0;
            padding: 1.5rem;
            border-radius: 0.75rem 0.75rem 0 0 !important;
        }
        
        .card-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: #1e293b;
            margin: 0;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            border-radius: 0.5rem;
        }
        
        .btn-primary:hover {
            background-color: #1d4ed8;
            border-color: #1d4ed8;
        }
        
        .alert {
            border: none;
            border-radius: 0.75rem;
            padding: 1rem 1.5rem;
        }
        
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .main-wrapper {
                margin-left: 0;
            }
            
            .header {
                padding: 0 1rem;
            }
            
            .main-content {
                padding: 1rem;
            }
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="{{ route('pemohon.dashboard') }}" class="sidebar-brand">
                <i class="bi bi-file-earmark-text"></i>
                JDN Permohonan
            </a>
        </div>
        
        <nav class="sidebar-nav">
            <div class="nav-item">
                <a href="{{ route('pemohon.dashboard') }}" class="nav-link {{ request()->routeIs('pemohon.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i>
                    Dashboard
                </a>
            </div>
            
            <div class="nav-item">
                <a href="{{ route('pemohon.permohonan.senarai') }}" class="nav-link {{ request()->routeIs('pemohon.permohonan.*') ? 'active' : '' }}">
                    <i class="bi bi-file-earmark-plus"></i>
                    Permohonan Saya
                </a>
            </div>
            
            <div class="nav-item">
                <a href="" class="nav-link {{ request()->routeIs('pemohon.dokumen.*') ? 'active' : '' }}">
                    <i class="bi bi-folder"></i>
                    Dokumen
                </a>
            </div>
            
            <div class="nav-item">
                <a href="" class="nav-link {{ request()->routeIs('pemohon.riwayat.*') ? 'active' : '' }}">
                    <i class="bi bi-clock-history"></i>
                    Riwayat
                </a>
            </div>
            
            <div class="nav-item">
                <a href="" class="nav-link {{ request()->routeIs('pemohon.profil.*') ? 'active' : '' }}">
                    <i class="bi bi-person"></i>
                    Profil
                </a>
            </div>
            
            <hr style="border-color: rgba(255, 255, 255, 0.1); margin: 1rem;">
            
            <div class="nav-item">
                <a href="" class="nav-link {{ request()->routeIs('pemohon.bantuan') ? 'active' : '' }}">
                    <i class="bi bi-question-circle"></i>
                    Bantuan
                </a>
            </div>
            
            <div class="nav-item">
                <form action="" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" class="nav-link" style="background: none; border: none; width: 100%; text-align: left;">
                        <i class="bi bi-box-arrow-right"></i>
                        Keluar
                    </button>
                </form>
            </div>
        </nav>
    </div>
    
    <!-- Main Content -->
    <div class="main-wrapper" id="mainWrapper">
        <!-- Header -->
        <header class="header">
            <div class="header-left">
                <button class="sidebar-toggle" id="sidebarToggle">
                    <i class="bi bi-list"></i>
                </button>
                <h1 class="header-title">@yield('page-title', 'Dashboard')</h1>
            </div>
            
            <div class="header-right">
                <!-- Notifications -->
                <div class="dropdown">
                    <button class="btn btn-link text-secondary" type="button" data-bs-toggle="dropdown">
                        <i class="bi bi-bell" style="font-size: 1.25rem;"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">3</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><h6 class="dropdown-header">Notifikasi</h6></li>
                        <li><a class="dropdown-item" href="#">Permohonan Anda sedang diproses</a></li>
                        <li><a class="dropdown-item" href="#">Dokumen perlu dilengkapi</a></li>
                        <li><a class="dropdown-item" href="#">Permohonan telah disetujui</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-center" href="#">Lihat Semua</a></li>
                    </ul>
                </div>
                
                <!-- User Menu -->
                <div class="dropdown">
                    <div class="user-avatar" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><h6 class="dropdown-header">{{ auth()->user()->name ?? 'User' }}</h6></li>
                        <li><a class="dropdown-item" href=""><i class="bi bi-person me-2"></i>Profil</a></li>
                        <li><a class="dropdown-item" href=""><i class="bi bi-gear me-2"></i>Pengaturan</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="" method="POST" style="margin: 0;">
                                @csrf
                                <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right me-2"></i>Keluar</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </header>
        
        <!-- Main Content Area -->
        <main class="main-content">
            @include('alert')
                        
            @yield('content')
        </main>
    </div>
    
    <!-- Bootstrap 5.3 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Sidebar Toggle Functionality
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.getElementById('sidebar');
            const mainWrapper = document.getElementById('mainWrapper');
            
            sidebarToggle.addEventListener('click', function() {
                if (window.innerWidth <= 768) {
                    sidebar.classList.toggle('show');
                } else {
                    sidebar.classList.toggle('collapsed');
                    mainWrapper.classList.toggle('expanded');
                }
            });
            
            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(event) {
                if (window.innerWidth <= 768) {
                    if (!sidebar.contains(event.target) && !sidebarToggle.contains(event.target)) {
                        sidebar.classList.remove('show');
                    }
                }
            });
            
            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth > 768) {
                    sidebar.classList.remove('show');
                }
            });
        });
        
        // Auto-hide alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert:not(.alert-permanent)');
            alerts.forEach(function(alert) {
                setTimeout(function() {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000);
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>