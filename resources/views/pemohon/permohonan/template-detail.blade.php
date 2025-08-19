@extends('pemohon.template-induk')

@section('title', 'Detail Permohonan')
@section('page-title', 'Detail Permohonan')

@section('content')
<div class="content-header">
    <h1 class="page-title">Detail Permohonan</h1>
    <p class="page-subtitle">Maklumat lengkap permohonan anda</p>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Maklumat Permohonan</h5>
                <span class="badge bg-warning">Dalam Proses</span>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>No. Rujukan:</strong>
                    </div>
                    <div class="col-md-9">
                        <span class="text-primary">#JDN2024001</span>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>Jenis Permohonan:</strong>
                    </div>
                    <div class="col-md-9">
                        Permit Kerja
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>Tarikh Permohonan:</strong>
                    </div>
                    <div class="col-md-9">
                        15 Januari 2024
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>Tarikh Diperlukan:</strong>
                    </div>
                    <div class="col-md-9">
                        30 Januari 2024
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>Status:</strong>
                    </div>
                    <div class="col-md-9">
                        <span class="badge bg-warning">Dalam Proses</span>
                    </div>
                </div>
                
                <hr>
                
                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>Tujuan:</strong>
                    </div>
                    <div class="col-md-9">
                        Permohonan permit kerja untuk jawatan Software Developer di syarikat teknologi tempatan.
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>Nama Syarikat:</strong>
                    </div>
                    <div class="col-md-9">
                        Tech Solutions Sdn Bhd
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>Jawatan:</strong>
                    </div>
                    <div class="col-md-9">
                        Software Developer
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>Alamat Syarikat:</strong>
                    </div>
                    <div class="col-md-9">
                        No. 123, Jalan Teknologi 1, Cyberjaya, 63000 Selangor
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>Catatan:</strong>
                    </div>
                    <div class="col-md-9">
                        Memerlukan permit kerja segera untuk memulakan tugas pada 1 Februari 2024.
                    </div>
                </div>
                
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('pemohon.permohonan.senarai') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Kembali ke Senarai
                    </a>
                    <div>
                        <a href="{{ route('pemohon.permohonan.edit', ['id' => 1]) }}" class="btn btn-warning me-2">
                            <i class="bi bi-pencil me-2"></i>Edit
                        </a>
                        <button type="button" class="btn btn-danger" onclick="confirmCancel()">
                            <i class="bi bi-x-circle me-2"></i>Batal Permohonan
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Dokumen Sokongan -->
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Dokumen Sokongan</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="d-flex align-items-center p-3 border rounded">
                            <i class="bi bi-file-earmark-pdf text-danger fs-2 me-3"></i>
                            <div>
                                <h6 class="mb-1">Kad Pengenalan</h6>
                                <small class="text-muted">ic_copy.pdf (1.2 MB)</small>
                            </div>
                            <a href="#" class="btn btn-sm btn-outline-primary ms-auto">
                                <i class="bi bi-download"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="d-flex align-items-center p-3 border rounded">
                            <i class="bi bi-file-earmark-text text-primary fs-2 me-3"></i>
                            <div>
                                <h6 class="mb-1">Surat Tawaran Kerja</h6>
                                <small class="text-muted">offer_letter.pdf (856 KB)</small>
                            </div>
                            <a href="#" class="btn btn-sm btn-outline-primary ms-auto">
                                <i class="bi bi-download"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="d-flex align-items-center p-3 border rounded">
                            <i class="bi bi-file-earmark-image text-success fs-2 me-3"></i>
                            <div>
                                <h6 class="mb-1">Sijil Kelayakan</h6>
                                <small class="text-muted">certificate.jpg (2.1 MB)</small>
                            </div>
                            <a href="#" class="btn btn-sm btn-outline-primary ms-auto">
                                <i class="bi bi-download"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <!-- Timeline Status -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Timeline Permohonan</h5>
            </div>
            <div class="card-body">
                <div class="timeline">
                    <div class="timeline-item completed">
                        <div class="timeline-marker bg-success"></div>
                        <div class="timeline-content">
                            <h6 class="mb-1">Permohonan Dihantar</h6>
                            <small class="text-muted">15 Jan 2024, 10:30 AM</small>
                        </div>
                    </div>
                    <div class="timeline-item completed">
                        <div class="timeline-marker bg-success"></div>
                        <div class="timeline-content">
                            <h6 class="mb-1">Dokumen Disemak</h6>
                            <small class="text-muted">16 Jan 2024, 2:15 PM</small>
                        </div>
                    </div>
                    <div class="timeline-item active">
                        <div class="timeline-marker bg-warning"></div>
                        <div class="timeline-content">
                            <h6 class="mb-1">Dalam Proses</h6>
                            <small class="text-muted">17 Jan 2024, 9:00 AM</small>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-marker bg-light"></div>
                        <div class="timeline-content">
                            <h6 class="mb-1 text-muted">Keputusan</h6>
                            <small class="text-muted">Menunggu</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Maklumat Pemprosesan -->
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Maklumat Pemprosesan</h5>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <h6><i class="bi bi-info-circle me-2"></i>Status Semasa</h6>
                    <p class="mb-2 small">Permohonan anda sedang dalam proses semakan oleh pegawai yang berkenaan.</p>
                    <p class="mb-0 small"><strong>Anggaran masa pemprosesan:</strong> 7-14 hari bekerja</p>
                </div>
                
                <div class="alert alert-warning">
                    <h6><i class="bi bi-exclamation-triangle me-2"></i>Tindakan Diperlukan</h6>
                    <p class="mb-0 small">Tiada tindakan diperlukan pada masa ini. Kami akan menghubungi anda jika memerlukan maklumat tambahan.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 15px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #dee2e6;
}

.timeline-item {
    position: relative;
    margin-bottom: 20px;
}

.timeline-marker {
    position: absolute;
    left: -23px;
    top: 0;
    width: 16px;
    height: 16px;
    border-radius: 50%;
    border: 3px solid #fff;
    box-shadow: 0 0 0 2px #dee2e6;
}

.timeline-item.completed .timeline-marker {
    box-shadow: 0 0 0 2px #198754;
}

.timeline-item.active .timeline-marker {
    box-shadow: 0 0 0 2px #ffc107;
}

.timeline-content h6 {
    font-size: 0.9rem;
}
</style>
@endpush

@push('scripts')
<script>
function confirmCancel() {
    if (confirm('Adakah anda pasti ingin membatalkan permohonan ini? Tindakan ini tidak boleh dibatalkan.')) {
        // Handle cancellation logic here
        alert('Permohonan telah dibatalkan.');
    }
}
</script>
@endpush