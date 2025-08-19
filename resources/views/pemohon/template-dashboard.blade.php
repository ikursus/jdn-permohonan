@extends('pemohon.template-induk')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="row">
    <!-- Welcome Card -->
    <div class="col-12 mb-4">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <h4 class="card-title mb-1">Selamat Datang, {{ auth()->user()->name ?? 'Pengguna' }}!</h4>
                        <p class="card-text mb-0">Anda boleh menguruskan permohonan dan tiket helpdesk anda di sini.</p>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-person-circle" style="font-size: 3rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Statistik Permohonan -->
    <div class="col-md-3 col-sm-6 mb-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center">
                <div class="text-primary mb-2">
                    <i class="bi bi-file-earmark-plus" style="font-size: 2.5rem;"></i>
                </div>
                <h3 class="mb-1">5</h3>
                <p class="text-muted mb-0">Jumlah Permohonan</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 col-sm-6 mb-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center">
                <div class="text-warning mb-2">
                    <i class="bi bi-clock-history" style="font-size: 2.5rem;"></i>
                </div>
                <h3 class="mb-1">2</h3>
                <p class="text-muted mb-0">Dalam Proses</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 col-sm-6 mb-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center">
                <div class="text-success mb-2">
                    <i class="bi bi-check-circle" style="font-size: 2.5rem;"></i>
                </div>
                <h3 class="mb-1">3</h3>
                <p class="text-muted mb-0">Diluluskan</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 col-sm-6 mb-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center">
                <div class="text-info mb-2">
                    <i class="bi bi-headset" style="font-size: 2.5rem;"></i>
                </div>
                <h3 class="mb-1">1</h3>
                <p class="text-muted mb-0">Tiket Helpdesk</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Aksi Cepat -->
    <div class="col-lg-6 mb-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">
                    <i class="bi bi-lightning-charge text-primary me-2"></i>
                    Aksi Cepat
                </h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-6">
                        <a href="{{ route('pemohon.permohonan.baru') }}" class="btn btn-outline-primary w-100 py-3">
                            <i class="bi bi-plus-circle d-block mb-2" style="font-size: 1.5rem;"></i>
                            Permohonan Baru
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('pemohon.permohonan.senarai') }}" class="btn btn-outline-secondary w-100 py-3">
                            <i class="bi bi-list-ul d-block mb-2" style="font-size: 1.5rem;"></i>
                            Senarai Permohonan
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('pemohon.helpdesk.baru') }}" class="btn btn-outline-info w-100 py-3">
                            <i class="bi bi-headset d-block mb-2" style="font-size: 1.5rem;"></i>
                            Tiket Helpdesk
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="#" class="btn btn-outline-success w-100 py-3">
                            <i class="bi bi-person d-block mb-2" style="font-size: 1.5rem;"></i>
                            Profil Saya
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Status Terkini -->
    <div class="col-lg-6 mb-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">
                    <i class="bi bi-bell text-warning me-2"></i>
                    Status Terkini
                </h5>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    <div class="list-group-item border-0 px-0">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <span class="badge bg-warning rounded-pill">Proses</span>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">Permohonan #001</h6>
                                <p class="mb-0 text-muted small">Sedang dalam proses semakan</p>
                            </div>
                            <div class="flex-shrink-0">
                                <small class="text-muted">2 hari lalu</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="list-group-item border-0 px-0">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <span class="badge bg-success rounded-pill">Lulus</span>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">Permohonan #002</h6>
                                <p class="mb-0 text-muted small">Permohonan telah diluluskan</p>
                            </div>
                            <div class="flex-shrink-0">
                                <small class="text-muted">5 hari lalu</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="list-group-item border-0 px-0">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <span class="badge bg-info rounded-pill">Baru</span>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">Tiket #HLP001</h6>
                                <p class="mb-0 text-muted small">Bantuan teknikal diperlukan</p>
                            </div>
                            <div class="flex-shrink-0">
                                <small class="text-muted">1 hari lalu</small>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="text-center mt-3">
                    <a href="{{ route('pemohon.permohonan.senarai') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Panduan Ringkas -->
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">
                    <i class="bi bi-info-circle text-info me-2"></i>
                    Panduan Ringkas
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="d-flex align-items-start">
                            <div class="flex-shrink-0">
                                <span class="badge bg-primary rounded-circle" style="width: 30px; height: 30px; display: flex; align-items: center; justify-content: center;">1</span>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">Buat Permohonan</h6>
                                <p class="mb-0 text-muted small">Klik "Permohonan Baru" untuk memulakan permohonan anda.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <div class="d-flex align-items-start">
                            <div class="flex-shrink-0">
                                <span class="badge bg-primary rounded-circle" style="width: 30px; height: 30px; display: flex; align-items: center; justify-content: center;">2</span>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">Pantau Status</h6>
                                <p class="mb-0 text-muted small">Semak status permohonan anda di senarai permohonan.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <div class="d-flex align-items-start">
                            <div class="flex-shrink-0">
                                <span class="badge bg-primary rounded-circle" style="width: 30px; height: 30px; display: flex; align-items: center; justify-content: center;">3</span>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">Dapatkan Bantuan</h6>
                                <p class="mb-0 text-muted small">Buat tiket helpdesk jika memerlukan bantuan.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .card {
        transition: transform 0.2s ease-in-out;
    }
    
    .card:hover {
        transform: translateY(-2px);
    }
    
    .btn:hover {
        transform: translateY(-1px);
    }
</style>
@endpush