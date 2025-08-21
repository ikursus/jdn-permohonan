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
                    <option value="Open">Terbuka</option>
                    <option value="In Progress">Dalam Proses</option>
                    <option value="Resolved">Selesai</option>
                    <option value="Closed">Ditutup</option>
                </select>
                <select class="form-select form-select-sm" style="width: auto;">
                    <option value="">Semua Kategori</option>
                    <option value="General">Umum</option>
                    <option value="Technical">Teknikal</option>
                    <option value="Application">Aplikasi</option>
                    <option value="Document">Dokumen</option>
                    <option value="Account">Akaun</option>
                </select>
            </div>
        </div>
    </div>
    <div class="card-body">
        @php
            // Data will be passed from controller
            $senaraiTiket = $helpdesks ?? [];
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
                                <strong class="text-primary">{{ $tiket->ticket_id }}</strong>
                            </td>
                            <td>
                                <a href="{{ route('pemohon.helpdesk.detail', $tiket->id) }}" 
                                   class="text-decoration-none fw-medium">
                                    {{ $tiket->subject }}
                                </a>
                            </td>
                            <td>
                                <span class="badge bg-secondary">{{ $tiket->category }}</span>
                            </td>
                            <td>
                                @php
                                    $statusClass = match($tiket->status) {
                                        'Open' => 'bg-warning',
                                        'In Progress' => 'bg-info',
                                        'Resolved' => 'bg-success',
                                        'Closed' => 'bg-secondary',
                                        default => 'bg-secondary'
                                    };
                                    $statusText = match($tiket->status) {
                                        'Open' => 'Terbuka',
                                        'In Progress' => 'Dalam Proses',
                                        'Resolved' => 'Selesai',
                                        'Closed' => 'Ditutup',
                                        default => 'Tidak Diketahui'
                                    };
                                @endphp
                                <span class="badge {{ $statusClass }}">{{ $statusText }}</span>
                            </td>
                            <td>
                                @php
                                    $priorityClass = match($tiket->priority) {
                                        'Urgent' => 'text-danger',
                                        'High' => 'text-warning',
                                        'Medium' => 'text-info',
                                        'Low' => 'text-success',
                                        default => 'text-secondary'
                                    };
                                    $priorityIcon = match($tiket->priority) {
                                        'Urgent' => 'bi-exclamation-triangle-fill',
                                        'High' => 'bi-arrow-up-circle-fill',
                                        'Medium' => 'bi-dash-circle-fill',
                                        'Low' => 'bi-arrow-down-circle-fill',
                                        default => 'bi-circle-fill'
                                    };
                                @endphp
                                <i class="bi {{ $priorityIcon }} {{ $priorityClass }}"></i>
                                <span class="{{ $priorityClass }}">{{ $tiket->priority }}</span>
                            </td>
                            <td>
                                <small class="text-muted">
                                    {{ $tiket->created_at->format('d/m/Y') }}
                                </small>
                            </td>
                            <td>
                                <small class="text-muted">
                                    {{ $tiket->updated_at->format('d/m/Y') }}
                                </small>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('pemohon.helpdesk.detail', $tiket->id) }}" 
                                       class="btn btn-outline-primary" title="Lihat Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    @if($tiket->status !== 'Closed')
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