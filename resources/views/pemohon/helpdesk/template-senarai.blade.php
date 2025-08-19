@extends('pemohon.template-induk')

@section('title', 'Helpdesk')
@section('page-title', 'Helpdesk')

@section('content')
<div class="content-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title">Senarai Tiket Helpdesk</h1>
            <p class="page-subtitle">Kelola tiket sokongan dan pertanyaan anda</p>
        </div>
        <a href="{{ route('pemohon.helpdesk.baru') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Tiket Baru
        </a>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <div class="text-primary mb-2">
                    <i class="bi bi-ticket-perforated" style="font-size: 2rem;"></i>
                </div>
                <h5 class="card-title">12</h5>
                <p class="card-text text-muted">Jumlah Tiket</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <div class="text-warning mb-2">
                    <i class="bi bi-clock" style="font-size: 2rem;"></i>
                </div>
                <h5 class="card-title">5</h5>
                <p class="card-text text-muted">Menunggu</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <div class="text-info mb-2">
                    <i class="bi bi-arrow-repeat" style="font-size: 2rem;"></i>
                </div>
                <h5 class="card-title">4</h5>
                <p class="card-text text-muted">Dalam Proses</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <div class="text-success mb-2">
                    <i class="bi bi-check-circle" style="font-size: 2rem;"></i>
                </div>
                <h5 class="card-title">3</h5>
                <p class="card-text text-muted">Selesai</p>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Tiket Helpdesk Saya</h5>
            <div class="d-flex gap-2">
                <select class="form-select form-select-sm" style="width: auto;">
                    <option value="">Semua Status</option>
                    <option value="pending">Menunggu</option>
                    <option value="in_progress">Dalam Proses</option>
                    <option value="resolved">Selesai</option>
                    <option value="closed">Ditutup</option>
                </select>
                <select class="form-select form-select-sm" style="width: auto;">
                    <option value="">Semua Kategori</option>
                    <option value="teknikal">Teknikal</option>
                    <option value="permohonan">Permohonan</option>
                    <option value="dokumen">Dokumen</option>
                    <option value="lain">Lain-lain</option>
                </select>
            </div>
        </div>
    </div>
    <div class="card-body">
        @php
            $senaraiTiket = [
                [
                    'id' => 'TK001',
                    'subjek' => 'Masalah muat naik dokumen',
                    'kategori' => 'Teknikal',
                    'status' => 'pending',
                    'keutamaan' => 'tinggi',
                    'tarikh_dibuat' => '2024-01-15',
                    'tarikh_kemaskini' => '2024-01-15'
                ],
                [
                    'id' => 'TK002',
                    'subjek' => 'Pertanyaan status permohonan',
                    'kategori' => 'Permohonan',
                    'status' => 'in_progress',
                    'keutamaan' => 'sederhana',
                    'tarikh_dibuat' => '2024-01-14',
                    'tarikh_kemaskini' => '2024-01-16'
                ],
                [
                    'id' => 'TK003',
                    'subjek' => 'Permintaan salinan dokumen',
                    'kategori' => 'Dokumen',
                    'status' => 'resolved',
                    'keutamaan' => 'rendah',
                    'tarikh_dibuat' => '2024-01-10',
                    'tarikh_kemaskini' => '2024-01-12'
                ],
                [
                    'id' => 'TK004',
                    'subjek' => 'Masalah log masuk sistem',
                    'kategori' => 'Teknikal',
                    'status' => 'pending',
                    'keutamaan' => 'tinggi',
                    'tarikh_dibuat' => '2024-01-16',
                    'tarikh_kemaskini' => '2024-01-16'
                ],
                [
                    'id' => 'TK005',
                    'subjek' => 'Pertanyaan prosedur permohonan',
                    'kategori' => 'Lain-lain',
                    'status' => 'resolved',
                    'keutamaan' => 'sederhana',
                    'tarikh_dibuat' => '2024-01-08',
                    'tarikh_kemaskini' => '2024-01-09'
                ]
            ];
        @endphp
        
        @if(count($senaraiTiket) > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>ID Tiket</th>
                            <th>Subjek</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th>Keutamaan</th>
                            <th>Tarikh Dibuat</th>
                            <th>Kemaskini Terakhir</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($senaraiTiket as $tiket)
                        <tr>
                            <td>
                                <strong class="text-primary">{{ $tiket['id'] }}</strong>
                            </td>
                            <td>
                                <a href="{{ route('pemohon.helpdesk.detail', $tiket['id']) }}" 
                                   class="text-decoration-none fw-medium">
                                    {{ $tiket['subjek'] }}
                                </a>
                            </td>
                            <td>
                                <span class="badge bg-secondary">{{ $tiket['kategori'] }}</span>
                            </td>
                            <td>
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
                            </td>
                            <td>
                                @php
                                    $keutamaanClass = match($tiket['keutamaan']) {
                                        'tinggi' => 'text-danger',
                                        'sederhana' => 'text-warning',
                                        'rendah' => 'text-success',
                                        default => 'text-secondary'
                                    };
                                    $keutamaanIcon = match($tiket['keutamaan']) {
                                        'tinggi' => 'bi-arrow-up-circle-fill',
                                        'sederhana' => 'bi-dash-circle-fill',
                                        'rendah' => 'bi-arrow-down-circle-fill',
                                        default => 'bi-circle-fill'
                                    };
                                @endphp
                                <i class="bi {{ $keutamaanIcon }} {{ $keutamaanClass }}"></i>
                                <span class="{{ $keutamaanClass }} text-capitalize">{{ $tiket['keutamaan'] }}</span>
                            </td>
                            <td>
                                <small class="text-muted">
                                    {{ date('d/m/Y', strtotime($tiket['tarikh_dibuat'])) }}
                                </small>
                            </td>
                            <td>
                                <small class="text-muted">
                                    {{ date('d/m/Y', strtotime($tiket['tarikh_kemaskini'])) }}
                                </small>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('pemohon.helpdesk.detail', $tiket['id']) }}" 
                                       class="btn btn-outline-primary" title="Lihat Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    @if($tiket['status'] !== 'closed')
                                    <button type="button" class="btn btn-outline-secondary" 
                                            title="Tambah Komen">
                                        <i class="bi bi-chat-dots"></i>
                                    </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <nav aria-label="Pagination">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <span class="page-link">Sebelumnya</span>
                    </li>
                    <li class="page-item active">
                        <span class="page-link">1</span>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">3</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">Seterusnya</a>
                    </li>
                </ul>
            </nav>
        @else
            <div class="text-center py-5">
                <i class="bi bi-ticket-perforated text-muted" style="font-size: 4rem;"></i>
                <h5 class="mt-3 text-muted">Tiada Tiket Helpdesk</h5>
                <p class="text-muted">Anda belum mempunyai sebarang tiket helpdesk.</p>
                <a href="{{ route('pemohon.helpdesk.baru') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>Buat Tiket Baru
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Filter functionality
    document.addEventListener('DOMContentLoaded', function() {
        const statusFilter = document.querySelector('select[name="status"]');
        const categoryFilter = document.querySelector('select[name="category"]');
        
        if (statusFilter) {
            statusFilter.addEventListener('change', function() {
                // Implement filter logic here
                console.log('Status filter changed:', this.value);
            });
        }
        
        if (categoryFilter) {
            categoryFilter.addEventListener('change', function() {
                // Implement filter logic here
                console.log('Category filter changed:', this.value);
            });
        }
    });
</script>
@endpush