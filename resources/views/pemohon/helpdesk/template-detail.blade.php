@extends('pemohon.template-induk')

@section('title', 'Detail Tiket Helpdesk')
@section('page-title', 'Detail Tiket Helpdesk')

@section('content')
@php
    // Sample ticket data
    $tiket = [
        'id' => 'TK001',
        'subjek' => 'Masalah muat naik dokumen',
        'kategori' => 'Teknikal',
        'status' => 'in_progress',
        'keutamaan' => 'tinggi',
        'penerangan' => 'Saya menghadapi masalah ketika cuba memuat naik dokumen PDF untuk permohonan saya. Sistem menunjukkan ralat "Upload failed" walaupun saiz fail adalah dalam had yang dibenarkan.',
        'langkah_diambil' => 'Saya telah cuba menggunakan pelayar yang berbeza (Chrome dan Firefox) dan juga telah clear cache. Masalah masih berlaku.',
        'tarikh_dibuat' => '2024-01-15 09:30:00',
        'tarikh_kemaskini' => '2024-01-16 14:20:00',
        'lampiran' => [
            ['nama' => 'screenshot_error.png', 'saiz' => '245 KB'],
            ['nama' => 'dokumen_gagal.pdf', 'saiz' => '1.2 MB']
        ],
        'assigned_to' => 'Ahmad Razak',
        'estimated_resolution' => '2024-01-17 17:00:00'
    ];
    
    $komunikasi = [
        [
            'id' => 1,
            'pengirim' => 'Pemohon',
            'nama' => 'Siti Aminah',
            'mesej' => 'Saya menghadapi masalah ketika cuba memuat naik dokumen PDF untuk permohonan saya. Sistem menunjukkan ralat "Upload failed" walaupun saiz fail adalah dalam had yang dibenarkan.',
            'tarikh' => '2024-01-15 09:30:00',
            'lampiran' => ['screenshot_error.png']
        ],
        [
            'id' => 2,
            'pengirim' => 'Admin',
            'nama' => 'Ahmad Razak',
            'mesej' => 'Terima kasih atas laporan anda. Kami sedang menyiasat masalah ini. Boleh anda cuba menggunakan format JPG untuk dokumen tersebut buat sementara waktu?',
            'tarikh' => '2024-01-15 11:45:00',
            'lampiran' => []
        ],
        [
            'id' => 3,
            'pengirim' => 'Pemohon',
            'nama' => 'Siti Aminah',
            'mesej' => 'Saya telah cuba menggunakan format JPG tetapi masalah yang sama berlaku. Adakah terdapat penyelesaian lain?',
            'tarikh' => '2024-01-15 15:20:00',
            'lampiran' => []
        ],
        [
            'id' => 4,
            'pengirim' => 'Admin',
            'nama' => 'Ahmad Razak',
            'mesej' => 'Kami telah mengenal pasti punca masalah dan sedang bekerja untuk menyelesaikannya. Jangkaan penyelesaian adalah dalam 24 jam. Kami akan maklumkan kepada anda sebaik sahaja masalah diselesaikan.',
            'tarikh' => '2024-01-16 14:20:00',
            'lampiran' => []
        ]
    ];
@endphp

<div class="content-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title">Tiket #{{ $tiket['id'] }}</h1>
            <p class="page-subtitle">{{ $tiket['subjek'] }}</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('pemohon.helpdesk.senarai') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>
            @if($tiket['status'] !== 'closed')
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#replyModal">
                <i class="bi bi-reply me-2"></i>Balas
            </button>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <!-- Maklumat Tiket -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-info-circle me-2"></i>Maklumat Tiket
                </h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>ID Tiket:</strong>
                        <span class="text-primary">#{{ $tiket['id'] }}</span>
                    </div>
                    <div class="col-md-6">
                        <strong>Kategori:</strong>
                        <span class="badge bg-secondary">{{ $tiket['kategori'] }}</span>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Status:</strong>
                        @php
                            $statusClass = match($tiket['status']) {
                                'pending' => 'bg-warning',
                                'in_progress' => 'bg-info',
                                'resolved' => 'bg-success',
                                'closed' => 'bg-secondary',
                                default => 'bg-secondary'
                            };
                            $statusText = match($tiket['status']) {
                                'pending' => 'Menunggu',
                                'in_progress' => 'Dalam Proses',
                                'resolved' => 'Selesai',
                                'closed' => 'Ditutup',
                                default => 'Tidak Diketahui'
                            };
                        @endphp
                        <span class="badge {{ $statusClass }}">{{ $statusText }}</span>
                    </div>
                    <div class="col-md-6">
                        <strong>Keutamaan:</strong>
                        @php
                            $keutamaanClass = match($tiket['keutamaan']) {
                                'tinggi' => 'text-danger',
                                'sederhana' => 'text-warning',
                                'rendah' => 'text-success',
                                'kritikal' => 'text-danger fw-bold',
                                default => 'text-secondary'
                            };
                        @endphp
                        <span class="{{ $keutamaanClass }} text-capitalize fw-medium">{{ $tiket['keutamaan'] }}</span>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Tarikh Dibuat:</strong>
                        <span>{{ date('d/m/Y H:i', strtotime($tiket['tarikh_dibuat'])) }}</span>
                    </div>
                    <div class="col-md-6">
                        <strong>Kemaskini Terakhir:</strong>
                        <span>{{ date('d/m/Y H:i', strtotime($tiket['tarikh_kemaskini'])) }}</span>
                    </div>
                </div>
                
                @if($tiket['assigned_to'])
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Ditugaskan Kepada:</strong>
                        <span>{{ $tiket['assigned_to'] }}</span>
                    </div>
                    @if($tiket['estimated_resolution'])
                    <div class="col-md-6">
                        <strong>Jangkaan Penyelesaian:</strong>
                        <span>{{ date('d/m/Y H:i', strtotime($tiket['estimated_resolution'])) }}</span>
                    </div>
                    @endif
                </div>
                @endif
                
                <div class="mb-3">
                    <strong>Penerangan Masalah:</strong>
                    <div class="mt-2 p-3 bg-light rounded">
                        {{ $tiket['penerangan'] }}
                    </div>
                </div>
                
                @if($tiket['langkah_diambil'])
                <div class="mb-3">
                    <strong>Langkah Yang Telah Diambil:</strong>
                    <div class="mt-2 p-3 bg-light rounded">
                        {{ $tiket['langkah_diambil'] }}
                    </div>
                </div>
                @endif
                
                @if(count($tiket['lampiran']) > 0)
                <div>
                    <strong>Lampiran Asal:</strong>
                    <div class="mt-2">
                        @foreach($tiket['lampiran'] as $lampiran)
                        <div class="d-inline-block me-3 mb-2">
                            <a href="#" class="text-decoration-none">
                                <i class="bi bi-paperclip me-1"></i>
                                {{ $lampiran['nama'] }}
                                <small class="text-muted">({{ $lampiran['saiz'] }})</small>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
        
        <!-- Sejarah Komunikasi -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-chat-dots me-2"></i>Sejarah Komunikasi
                </h5>
            </div>
            <div class="card-body">
                <div class="timeline">
                    @foreach($komunikasi as $index => $mesej)
                    <div class="timeline-item {{ $mesej['pengirim'] === 'Admin' ? 'timeline-admin' : 'timeline-user' }}">
                        <div class="timeline-marker">
                            @if($mesej['pengirim'] === 'Admin')
                                <i class="bi bi-person-badge text-primary"></i>
                            @else
                                <i class="bi bi-person text-success"></i>
                            @endif
                        </div>
                        <div class="timeline-content">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <strong class="{{ $mesej['pengirim'] === 'Admin' ? 'text-primary' : 'text-success' }}">
                                        {{ $mesej['nama'] }}
                                    </strong>
                                    <span class="badge bg-light text-dark ms-2">{{ $mesej['pengirim'] }}</span>
                                </div>
                                <small class="text-muted">
                                    {{ date('d/m/Y H:i', strtotime($mesej['tarikh'])) }}
                                </small>
                            </div>
                            <div class="message-content p-3 rounded {{ $mesej['pengirim'] === 'Admin' ? 'bg-primary bg-opacity-10' : 'bg-success bg-opacity-10' }}">
                                {{ $mesej['mesej'] }}
                                
                                @if(count($mesej['lampiran']) > 0)
                                <div class="mt-2 pt-2 border-top">
                                    <small class="text-muted">Lampiran:</small>
                                    @foreach($mesej['lampiran'] as $lampiran)
                                    <div class="mt-1">
                                        <a href="#" class="text-decoration-none small">
                                            <i class="bi bi-paperclip me-1"></i>{{ $lampiran }}
                                        </a>
                                    </div>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <!-- Status Tracking -->
        <div class="card mb-4">
            <div class="card-header">
                <h6 class="card-title mb-0">
                    <i class="bi bi-list-check me-2"></i>Status Tracking
                </h6>
            </div>
            <div class="card-body">
                <div class="progress-steps">
                    <div class="step completed">
                        <div class="step-icon">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>
                        <div class="step-content">
                            <strong>Tiket Dibuat</strong>
                            <small class="text-muted d-block">15/01/2024 09:30</small>
                        </div>
                    </div>
                    
                    <div class="step completed">
                        <div class="step-icon">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>
                        <div class="step-content">
                            <strong>Tiket Diterima</strong>
                            <small class="text-muted d-block">15/01/2024 10:00</small>
                        </div>
                    </div>
                    
                    <div class="step active">
                        <div class="step-icon">
                            <i class="bi bi-arrow-repeat"></i>
                        </div>
                        <div class="step-content">
                            <strong>Dalam Proses</strong>
                            <small class="text-muted d-block">15/01/2024 11:45</small>
                        </div>
                    </div>
                    
                    <div class="step">
                        <div class="step-icon">
                            <i class="bi bi-circle"></i>
                        </div>
                        <div class="step-content">
                            <strong>Penyelesaian</strong>
                            <small class="text-muted d-block">Menunggu</small>
                        </div>
                    </div>
                    
                    <div class="step">
                        <div class="step-icon">
                            <i class="bi bi-circle"></i>
                        </div>
                        <div class="step-content">
                            <strong>Ditutup</strong>
                            <small class="text-muted d-block">Menunggu</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Tindakan Pantas -->
        <div class="card mb-4">
            <div class="card-header">
                <h6 class="card-title mb-0">
                    <i class="bi bi-lightning me-2"></i>Tindakan Pantas
                </h6>
            </div>
            <div class="card-body">
                @if($tiket['status'] !== 'closed')
                <div class="d-grid gap-2">
                    <button type="button" class="btn btn-primary btn-sm" 
                            data-bs-toggle="modal" data-bs-target="#replyModal">
                        <i class="bi bi-reply me-2"></i>Balas Tiket
                    </button>
                    <button type="button" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-paperclip me-2"></i>Tambah Lampiran
                    </button>
                    @if($tiket['status'] === 'resolved')
                    <button type="button" class="btn btn-success btn-sm">
                        <i class="bi bi-check-circle me-2"></i>Tutup Tiket
                    </button>
                    @endif
                </div>
                @else
                <div class="text-center text-muted">
                    <i class="bi bi-lock"></i>
                    <p class="mb-0 small">Tiket telah ditutup</p>
                </div>
                @endif
            </div>
        </div>
        
        <!-- Maklumat Sokongan -->
        <div class="card">
            <div class="card-header">
                <h6 class="card-title mb-0">
                    <i class="bi bi-headset me-2"></i>Maklumat Sokongan
                </h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong class="small">Pegawai Bertugas:</strong>
                    <p class="mb-1">{{ $tiket['assigned_to'] ?? 'Belum ditugaskan' }}</p>
                </div>
                
                <div class="mb-3">
                    <strong class="small">Masa Operasi:</strong>
                    <p class="mb-1 small">Isnin - Jumaat: 8:00 AM - 5:00 PM</p>
                    <p class="mb-1 small">Sabtu: 8:00 AM - 12:00 PM</p>
                </div>
                
                <div>
                    <strong class="small">Hubungi Kami:</strong>
                    <p class="mb-1 small">
                        <i class="bi bi-telephone me-2"></i>03-1234 5678
                    </p>
                    <p class="mb-0 small">
                        <i class="bi bi-envelope me-2"></i>support@jdn.gov.my
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Balas -->
<div class="modal fade" id="replyModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-reply me-2"></i>Balas Tiket #{{ $tiket['id'] }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="reply-form" method="POST" action="{{ route('pemohon.helpdesk.reply', $tiket['id']) }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="reply-message" class="form-label">Mesej <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="reply-message" name="mesej" rows="5" 
                                  placeholder="Tulis balasan anda di sini..." required></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="reply-attachment" class="form-label">Lampiran</label>
                        <input type="file" class="form-control" id="reply-attachment" 
                               name="lampiran[]" multiple 
                               accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.txt">
                        <div class="form-text">
                            Format yang dibenarkan: JPG, PNG, PDF, DOC, DOCX, TXT. Maksimum 5MB setiap fail.
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-2"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-send me-2"></i>Hantar Balasan
                    </button>
                </div>
            </form>
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
    margin-bottom: 30px;
}

.timeline-marker {
    position: absolute;
    left: -22px;
    top: 5px;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background: white;
    border: 2px solid #dee2e6;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
}

.timeline-admin .timeline-marker {
    border-color: #0d6efd;
    background: #e7f1ff;
}

.timeline-user .timeline-marker {
    border-color: #198754;
    background: #e8f5e8;
}

.timeline-content {
    margin-left: 15px;
}

.message-content {
    word-wrap: break-word;
}

.progress-steps .step {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
    position: relative;
}

.progress-steps .step:not(:last-child)::after {
    content: '';
    position: absolute;
    left: 15px;
    top: 30px;
    width: 2px;
    height: 20px;
    background: #dee2e6;
}

.progress-steps .step.completed::after {
    background: #198754;
}

.progress-steps .step.active::after {
    background: #ffc107;
}

.step-icon {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    font-size: 16px;
}

.step.completed .step-icon {
    background: #198754;
    color: white;
}

.step.active .step-icon {
    background: #ffc107;
    color: white;
}

.step .step-icon {
    background: #dee2e6;
    color: #6c757d;
}
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Reply form validation
        const replyForm = document.getElementById('reply-form');
        if (replyForm) {
            replyForm.addEventListener('submit', function(e) {
                const message = document.getElementById('reply-message').value.trim();
                
                if (message.length < 10) {
                    e.preventDefault();
                    alert('Mesej mestilah sekurang-kurangnya 10 aksara.');
                    return false;
                }
            });
        }
        
        // Auto-scroll to latest message
        const timeline = document.querySelector('.timeline');
        if (timeline) {
            const lastItem = timeline.querySelector('.timeline-item:last-child');
            if (lastItem) {
                lastItem.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }
        }
    });
</script>
@endpush