@extends('admin.template-induk')

@section('title', 'Pengurusan Permohonan')
@section('page-title', 'Pengurusan Permohonan')

@section('content')
<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card stats-card">
            <div class="card-body text-center">
                <i class="fas fa-file-alt fa-2x mb-3"></i>
                <h3 class="mb-1">{{ $totalPermohonan ?? 89 }}</h3>
                <p class="mb-0">Total Permohonan</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stats-card">
            <div class="card-body text-center">
                <i class="fas fa-clock fa-2x mb-3"></i>
                <h3 class="mb-1">{{ $permohonanPending ?? 23 }}</h3>
                <p class="mb-0">Pending</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stats-card">
            <div class="card-body text-center">
                <i class="fas fa-check-circle fa-2x mb-3"></i>
                <h3 class="mb-1">{{ $permohonanApproved ?? 52 }}</h3>
                <p class="mb-0">Diluluskan</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stats-card">
            <div class="card-body text-center">
                <i class="fas fa-times-circle fa-2x mb-3"></i>
                <h3 class="mb-1">{{ $permohonanRejected ?? 14 }}</h3>
                <p class="mb-0">Ditolak</p>
            </div>
        </div>
    </div>
</div>

<!-- Search and Filter -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.permohonan') }}">
            <div class="row">
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="search" class="form-label">Cari Permohonan</label>
                        <input type="text" class="form-control" id="search" name="search" 
                               placeholder="ID, Nama Pemohon" value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="mb-3">
                        <label for="jenis" class="form-label">Jenis</label>
                        <select class="form-select" id="jenis" name="jenis">
                            <option value="">Semua Jenis</option>
                            <option value="sijil_kelahiran" {{ request('jenis') == 'sijil_kelahiran' ? 'selected' : '' }}>Sijil Kelahiran</option>
                            <option value="sijil_perkahwinan" {{ request('jenis') == 'sijil_perkahwinan' ? 'selected' : '' }}>Sijil Perkahwinan</option>
                            <option value="sijil_kematian" {{ request('jenis') == 'sijil_kematian' ? 'selected' : '' }}>Sijil Kematian</option>
                            <option value="sijil_perceraian" {{ request('jenis') == 'sijil_perceraian' ? 'selected' : '' }}>Sijil Perceraian</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Diproses</option>
                            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Diluluskan</option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="mb-3">
                        <label for="priority" class="form-label">Keutamaan</label>
                        <select class="form-select" id="priority" name="priority">
                            <option value="">Semua</option>
                            <option value="urgent" {{ request('priority') == 'urgent' ? 'selected' : '' }}>Segera</option>
                            <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>Tinggi</option>
                            <option value="normal" {{ request('priority') == 'normal' ? 'selected' : '' }}>Normal</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="mb-3">
                        <label for="date_range" class="form-label">Tarikh</label>
                        <select class="form-select" id="date_range" name="date_range">
                            <option value="">Semua Tarikh</option>
                            <option value="today" {{ request('date_range') == 'today' ? 'selected' : '' }}>Hari Ini</option>
                            <option value="week" {{ request('date_range') == 'week' ? 'selected' : '' }}>Minggu Ini</option>
                            <option value="month" {{ request('date_range') == 'month' ? 'selected' : '' }}>Bulan Ini</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="mb-3">
                        <label class="form-label">&nbsp;</label>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Permohonan List -->
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-file-alt me-2"></i>Senarai Permohonan</h5>
        <div>
            <button class="btn btn-outline-secondary btn-sm me-2" onclick="exportData()">
                <i class="fas fa-download"></i> Export
            </button>
            <button class="btn btn-outline-info btn-sm" onclick="bulkAction()">
                <i class="fas fa-tasks"></i> Tindakan Pukal
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" id="selectAll" onchange="toggleSelectAll()">
                        </th>
                        <th>ID</th>
                        <th>Pemohon</th>
                        <th>Jenis Permohonan</th>
                        <th>Tarikh Diperlukan</th>
                        <th>Keutamaan</th>
                        <th>Status</th>
                        <th>Tarikh Mohon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($permohonanList ?? [] as $permohonan)
                    <tr>
                        <td>
                            <input type="checkbox" class="row-checkbox" value="{{ $permohonan->id }}">
                        </td>
                        <td><strong>#{{ str_pad($permohonan->id, 4, '0', STR_PAD_LEFT) }}</strong></td>
                        <td>
                            <div>
                                <strong>{{ $permohonan->pemohon->nama }}</strong><br>
                                <small class="text-muted">{{ $permohonan->pemohon->email }}</small>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-info">{{ ucwords(str_replace('_', ' ', $permohonan->jenis)) }}</span>
                        </td>
                        <td>
                            {{ $permohonan->tarikh_diperlukan ? $permohonan->tarikh_diperlukan->format('d/m/Y') : '-' }}
                            @if($permohonan->tarikh_diperlukan && $permohonan->tarikh_diperlukan->isPast())
                                <i class="fas fa-exclamation-triangle text-danger ms-1" title="Tarikh telah berlalu"></i>
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-{{ $permohonan->keutamaan == 'urgent' ? 'danger' : ($permohonan->keutamaan == 'high' ? 'warning' : 'secondary') }}">
                                {{ ucfirst($permohonan->keutamaan) }}
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-{{ $permohonan->status == 'pending' ? 'warning' : ($permohonan->status == 'approved' ? 'success' : ($permohonan->status == 'rejected' ? 'danger' : 'info')) }}">
                                {{ ucfirst($permohonan->status) }}
                            </span>
                        </td>
                        <td>{{ $permohonan->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <button class="btn btn-sm btn-outline-primary" onclick="viewPermohonan({{ $permohonan->id }})" title="Lihat">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-success" onclick="processPermohonan({{ $permohonan->id }})" title="Proses">
                                    <i class="fas fa-cog"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-info" onclick="downloadDocuments({{ $permohonan->id }})" title="Muat Turun">
                                    <i class="fas fa-download"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <!-- Sample Data -->
                    <tr>
                        <td><input type="checkbox" class="row-checkbox" value="1"></td>
                        <td><strong>#0001</strong></td>
                        <td>
                            <div>
                                <strong>Ahmad Bin Ali</strong><br>
                                <small class="text-muted">ahmad@email.com</small>
                            </div>
                        </td>
                        <td><span class="badge bg-info">Sijil Kelahiran</span></td>
                        <td>
                            20/01/2024
                        </td>
                        <td><span class="badge bg-warning">High</span></td>
                        <td><span class="badge bg-warning">Pending</span></td>
                        <td>15/01/2024 10:30</td>
                        <td>
                            <div class="btn-group" role="group">
                                <button class="btn btn-sm btn-outline-primary" title="Lihat">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-success" title="Proses">
                                    <i class="fas fa-cog"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-info" title="Muat Turun">
                                    <i class="fas fa-download"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" class="row-checkbox" value="2"></td>
                        <td><strong>#0002</strong></td>
                        <td>
                            <div>
                                <strong>Siti Fatimah</strong><br>
                                <small class="text-muted">siti@email.com</small>
                            </div>
                        </td>
                        <td><span class="badge bg-info">Sijil Perkahwinan</span></td>
                        <td>18/01/2024</td>
                        <td><span class="badge bg-secondary">Normal</span></td>
                        <td><span class="badge bg-success">Approved</span></td>
                        <td>14/01/2024 09:15</td>
                        <td>
                            <div class="btn-group" role="group">
                                <button class="btn btn-sm btn-outline-primary" title="Lihat">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-success" title="Proses">
                                    <i class="fas fa-cog"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-info" title="Muat Turun">
                                    <i class="fas fa-download"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" class="row-checkbox" value="3"></td>
                        <td><strong>#0003</strong></td>
                        <td>
                            <div>
                                <strong>Muhammad Hafiz</strong><br>
                                <small class="text-muted">hafiz@email.com</small>
                            </div>
                        </td>
                        <td><span class="badge bg-info">Sijil Kematian</span></td>
                        <td>
                            12/01/2024
                            <i class="fas fa-exclamation-triangle text-danger ms-1" title="Tarikh telah berlalu"></i>
                        </td>
                        <td><span class="badge bg-danger">Urgent</span></td>
                        <td><span class="badge bg-info">Processing</span></td>
                        <td>13/01/2024 14:20</td>
                        <td>
                            <div class="btn-group" role="group">
                                <button class="btn btn-sm btn-outline-primary" title="Lihat">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-success" title="Proses">
                                    <i class="fas fa-cog"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-info" title="Muat Turun">
                                    <i class="fas fa-download"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if(isset($permohonanList) && $permohonanList->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $permohonanList->links() }}
        </div>
        @endif
    </div>
</div>

<!-- Process Modal -->
<div class="modal fade" id="processModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Proses Permohonan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="processForm">
                <div class="modal-body">
                    <input type="hidden" id="permohonan_id" name="permohonan_id">
                    <div class="mb-3">
                        <label for="new_status" class="form-label">Status Baru</label>
                        <select class="form-select" id="new_status" name="status" required>
                            <option value="">Pilih Status</option>
                            <option value="processing">Diproses</option>
                            <option value="approved">Diluluskan</option>
                            <option value="rejected">Ditolak</option>
                            <option value="completed">Selesai</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="remarks" class="form-label">Catatan</label>
                        <textarea class="form-control" id="remarks" name="remarks" rows="3" 
                                  placeholder="Masukkan catatan untuk permohonan ini..."></textarea>
                    </div>
                    <div class="mb-3" id="rejection_reason_div" style="display: none;">
                        <label for="rejection_reason" class="form-label">Sebab Penolakan</label>
                        <textarea class="form-control" id="rejection_reason" name="rejection_reason" rows="2" 
                                  placeholder="Nyatakan sebab penolakan..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Kemaskini</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.table th {
    border-top: none;
    font-weight: 600;
    color: #2c3e50;
}

.btn-group .btn {
    border-radius: 4px;
    margin-right: 2px;
}

.badge {
    font-size: 0.75em;
}

.row-checkbox {
    transform: scale(1.2);
}
</style>
@endpush

@push('scripts')
<script>
function viewPermohonan(id) {
    // Implement view permohonan functionality
    window.open('/admin/permohonan/' + id, '_blank');
}

function processPermohonan(id) {
    document.getElementById('permohonan_id').value = id;
    new bootstrap.Modal(document.getElementById('processModal')).show();
}

function downloadDocuments(id) {
    // Implement download documents functionality
    window.open('/admin/permohonan/' + id + '/download', '_blank');
}

function exportData() {
    // Implement export functionality
    const params = new URLSearchParams(window.location.search);
    params.set('export', 'excel');
    window.open('/admin/permohonan?' + params.toString(), '_blank');
}

function bulkAction() {
    const selected = document.querySelectorAll('.row-checkbox:checked');
    if (selected.length === 0) {
        alert('Sila pilih sekurang-kurangnya satu permohonan');
        return;
    }
    
    const ids = Array.from(selected).map(cb => cb.value);
    alert('Tindakan pukal untuk ID: ' + ids.join(', '));
}

function toggleSelectAll() {
    const selectAll = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('.row-checkbox');
    
    checkboxes.forEach(cb => {
        cb.checked = selectAll.checked;
    });
}

// Handle status change in process modal
document.getElementById('new_status').addEventListener('change', function() {
    const rejectionDiv = document.getElementById('rejection_reason_div');
    if (this.value === 'rejected') {
        rejectionDiv.style.display = 'block';
        document.getElementById('rejection_reason').required = true;
    } else {
        rejectionDiv.style.display = 'none';
        document.getElementById('rejection_reason').required = false;
    }
});

// Process Form Submit
document.getElementById('processForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const id = formData.get('permohonan_id');
    
    // Implement AJAX submission here
    alert('Permohonan #' + id + ' akan dikemaskini kepada status: ' + formData.get('status'));
    
    // Close modal
    bootstrap.Modal.getInstance(document.getElementById('processModal')).hide();
    
    // Reset form
    this.reset();
    document.getElementById('rejection_reason_div').style.display = 'none';
});

// Initialize tooltips
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
});
</script>
@endpush