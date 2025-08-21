@extends('pemohon.template-induk')

@section('page-title')
Senarai Permohonan
@endsection

@push('styles')
<style>
.status-badge {
    font-size: 0.75rem;
    padding: 0.25rem 0.5rem;
}
.card-hover {
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}
.card-hover:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}
.search-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 15px;
    padding: 2rem;
    margin-bottom: 2rem;
    color: white;
}
.stats-card {
    border: none;
    border-radius: 15px;
    background: white;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}
</style>
@endpush

@section('content')
<!-- Header Section -->
<div class="search-section">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h4 class="mb-1"><i class="fas fa-file-alt me-2"></i>Senarai Permohonan</h4>
            <p class="mb-0 opacity-75">Urus dan pantau semua permohonan anda di sini</p>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('pemohon.permohonan.baru') }}" class="btn btn-light btn-lg">
                <i class="fas fa-plus me-2"></i>Permohonan Baru
            </a>
        </div>
    </div>
    
    <!-- Search and Filter -->
    <div class="row mt-4">
        <div class="col-md-8">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0">
                    <i class="fas fa-search text-muted"></i>
                </span>
                <input type="text" class="form-control border-start-0" placeholder="Cari permohonan..." id="searchInput">
            </div>
        </div>
        <div class="col-md-4">
            <select class="form-select" id="statusFilter">
                <option value="">Semua Status</option>
                <option value="pending">Pending</option>
                <option value="diproses">Diproses</option>
                <option value="lulus">Lulus</option>
                <option value="ditolak">Ditolak</option>
            </select>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="card stats-card text-center">
            <div class="card-body">
                <div class="text-primary mb-2">
                    <i class="fas fa-file-alt fa-2x"></i>
                </div>
                <h5 class="card-title mb-1">{{ count($senaraiPermohonan ?? []) }}</h5>
                <p class="card-text text-muted small">Jumlah Permohonan</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card stats-card text-center">
            <div class="card-body">
                <div class="text-warning mb-2">
                    <i class="fas fa-clock fa-2x"></i>
                </div>
                <h5 class="card-title mb-1">{{ collect($senaraiPermohonan ?? [])->where('status', 'pending')->count() }}</h5>
                <p class="card-text text-muted small">Dalam Proses</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card stats-card text-center">
            <div class="card-body">
                <div class="text-success mb-2">
                    <i class="fas fa-check-circle fa-2x"></i>
                </div>
                <h5 class="card-title mb-1">{{ collect($senaraiPermohonan ?? [])->where('status', 'lulus')->count() }}</h5>
                <p class="card-text text-muted small">Lulus</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card stats-card text-center">
            <div class="card-body">
                <div class="text-danger mb-2">
                    <i class="fas fa-times-circle fa-2x"></i>
                </div>
                <h5 class="card-title mb-1">{{ collect($senaraiPermohonan ?? [])->where('status', 'ditolak')->count() }}</h5>
                <p class="card-text text-muted small">Ditolak</p>
            </div>
        </div>
    </div>
</div>

<!-- Applications List -->
@if(isset($senaraiPermohonan) && count($senaraiPermohonan) > 0)
    <div class="row" id="applicationsList">
        @foreach($senaraiPermohonan as $item)
        <div class="col-md-6 col-lg-4 mb-4 application-card" data-status="{{ $item->status ?? 'pending' }}">
            <div class="card h-100 card-hover">
                <div class="card-header bg-transparent border-bottom-0 pb-0">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="card-title mb-1">Permohonan #JDN{{ str_pad($item->id, 7, '0', STR_PAD_LEFT) }}</h6>
                            <small class="text-muted">{{ date('d/m/Y', strtotime($item->created_at)) }}</small>
                        </div>
                        @php
                            $status = $item->status ?? 'pending';
                            $statusClass = match($status) {
                                'lulus' => 'bg-success',
                                'ditolak' => 'bg-danger', 
                                'pending' => 'bg-warning',
                                'diproses' => 'bg-info',
                                default => 'bg-secondary'
                            };
                            $statusText = match($status) {
                                'lulus' => 'Lulus',
                                'ditolak' => 'Ditolak',
                                'pending' => 'Pending', 
                                'diproses' => 'Diproses',
                                default => 'Tidak Diketahui'
                            };
                        @endphp
                        <span class="badge {{ $statusClass }} status-badge">{{ $statusText }}</span>
                    </div>
                </div>
                <div class="card-body pt-2">
                    <div class="mb-3">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-user text-muted me-2"></i>
                            <strong>{{ $item->nama }}</strong>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-envelope text-muted me-2"></i>
                            <span class="text-muted">{{ $item->email }}</span>
                        </div>
                    </div>
                    
                    @if($item->jenis_permohonan)
                    <div class="mb-3">
                        <small class="text-muted">Jenis Permohonan:</small>
                        @php
                            $jenisText = match($item->jenis_permohonan) {
                                'permit_kerja' => 'Permit Kerja',
                                'visa_kerja' => 'Visa Kerja',
                                'permit_tinggal' => 'Permit Tinggal',
                                'lain_lain' => 'Lain-lain',
                                default => ucfirst($item->jenis_permohonan)
                            };
                        @endphp
                        <div class="fw-medium">{{ $jenisText }}</div>
                    </div>
                    @endif
                </div>
                <div class="card-footer bg-transparent border-top-0">
                    <div class="d-flex gap-2">
                        <a href="{{ route('pemohon.permohonan.detail', $item->id) }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-eye"></i> Lihat
                        </a>
                        @if($status === 'pending' || $status === 'diproses')
                        <a href="{{ route('pemohon.permohonan.edit', $item->id) }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        @endif
                        @if($status === 'pending')
                        <button type="button" class="btn btn-outline-danger btn-sm" onclick="confirmDelete({{ $item->id }})">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        <nav aria-label="Pagination">
            <ul class="pagination">
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
    </div>
@else
    <!-- Empty State -->
    <div class="text-center py-5">
        <div class="mb-4">
            <i class="fas fa-file-alt fa-4x text-muted opacity-50"></i>
        </div>
        <h5 class="text-muted mb-3">Tiada Permohonan Dijumpai</h5>
        <p class="text-muted mb-4">Anda belum membuat sebarang permohonan lagi.</p>
        <a href="{{ route('pemohon.permohonan.baru') }}" class="btn btn-primary btn-lg">
            <i class="fas fa-plus me-2"></i>Buat Permohonan Pertama
        </a>
    </div>
@endif
@endsection

@push('scripts')
<script>
// Search functionality
document.getElementById('searchInput').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const cards = document.querySelectorAll('.application-card');
    
    cards.forEach(card => {
        const text = card.textContent.toLowerCase();
        if (text.includes(searchTerm)) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
});

// Status filter
document.getElementById('statusFilter').addEventListener('change', function() {
    const selectedStatus = this.value;
    const cards = document.querySelectorAll('.application-card');
    
    cards.forEach(card => {
        const cardStatus = card.getAttribute('data-status');
        if (selectedStatus === '' || cardStatus === selectedStatus) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
});

function confirmDelete(id) {
    if (confirm('Adakah anda pasti untuk menghapuskan permohonan ini?')) {
        // Create form and submit
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `{{ url('/permohonan') }}/${id}`;
        
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'DELETE';
        
        const tokenInput = document.createElement('input');
        tokenInput.type = 'hidden';
        tokenInput.name = '_token';
        tokenInput.value = '{{ csrf_token() }}';
        
        form.appendChild(methodInput);
        form.appendChild(tokenInput);
        document.body.appendChild(form);
        form.submit();
    }
}

// Auto-hide alerts
setTimeout(function() {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        alert.style.transition = 'opacity 0.5s';
        alert.style.opacity = '0';
        setTimeout(() => alert.remove(), 500);
    });
}, 5000);
</script>
@endpush