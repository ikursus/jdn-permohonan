@extends('admin.template-induk')

@section('title', 'Pengurusan Pemohon')
@section('page-title', 'Pengurusan Pemohon')

@section('content')
<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card stats-card">
            <div class="card-body text-center">
                <i class="fas fa-users fa-2x mb-3"></i>
                <h3 class="mb-1">{{ $totalPemohon ?? 156 }}</h3>
                <p class="mb-0">Total Pemohon</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stats-card">
            <div class="card-body text-center">
                <i class="fas fa-user-check fa-2x mb-3"></i>
                <h3 class="mb-1">{{ $pemohonAktif ?? 142 }}</h3>
                <p class="mb-0">Pemohon Aktif</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stats-card">
            <div class="card-body text-center">
                <i class="fas fa-user-plus fa-2x mb-3"></i>
                <h3 class="mb-1">{{ $pemohonBaru ?? 8 }}</h3>
                <p class="mb-0">Pemohon Baru (Bulan Ini)</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stats-card">
            <div class="card-body text-center">
                <i class="fas fa-user-times fa-2x mb-3"></i>
                <h3 class="mb-1">{{ $pemohonTidakAktif ?? 14 }}</h3>
                <p class="mb-0">Pemohon Tidak Aktif</p>
            </div>
        </div>
    </div>
</div>

<!-- Search and Filter -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.pemohon') }}">
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="search" class="form-label">Cari Pemohon</label>
                        <input type="text" class="form-control" id="search" name="search" 
                               placeholder="Nama, Email, atau No. KP" value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="">Semua Status</option>
                            <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="tidak_aktif" {{ request('status') == 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending Verifikasi</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="sort" class="form-label">Susun Mengikut</label>
                        <select class="form-select" id="sort" name="sort">
                            <option value="nama" {{ request('sort') == 'nama' ? 'selected' : '' }}>Nama</option>
                            <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Tarikh Daftar</option>
                            <option value="last_login" {{ request('sort') == 'last_login' ? 'selected' : '' }}>Login Terakhir</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="mb-3">
                        <label class="form-label">&nbsp;</label>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i> Cari
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Pemohon List -->
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-users me-2"></i>Senarai Pemohon</h5>
        <div>
            <button class="btn btn-success btn-sm me-2" data-bs-toggle="modal" data-bs-target="#addPemohonModal">
                <i class="fas fa-plus"></i> Tambah Pemohon
            </button>
            <button class="btn btn-outline-secondary btn-sm" onclick="exportData()">
                <i class="fas fa-download"></i> Export
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No. KP</th>
                        <th>No. Telefon</th>
                        <th>Status</th>
                        <th>Tarikh Daftar</th>
                        <th>Login Terakhir</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pemohonList ?? [] as $index => $pemohon)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm bg-primary rounded-circle d-flex align-items-center justify-content-center me-2">
                                    <span class="text-white">{{ substr($pemohon->nama, 0, 1) }}</span>
                                </div>
                                <div>
                                    <strong>{{ $pemohon->nama }}</strong>
                                    @if($pemohon->is_verified)
                                        <i class="fas fa-check-circle text-success ms-1" title="Terverifikasi"></i>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>{{ $pemohon->email }}</td>
                        <td>{{ $pemohon->no_kp }}</td>
                        <td>{{ $pemohon->no_telefon }}</td>
                        <td>
                            <span class="badge bg-{{ $pemohon->status == 'aktif' ? 'success' : ($pemohon->status == 'pending' ? 'warning' : 'danger') }}">
                                {{ ucfirst($pemohon->status) }}
                            </span>
                        </td>
                        <td>{{ $pemohon->created_at->format('d/m/Y') }}</td>
                        <td>{{ $pemohon->last_login ? $pemohon->last_login->format('d/m/Y H:i') : 'Belum Login' }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <button class="btn btn-sm btn-outline-primary" onclick="viewPemohon({{ $pemohon->id }})" title="Lihat">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-warning" onclick="editPemohon({{ $pemohon->id }})" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger" onclick="deletePemohon({{ $pemohon->id }})" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <!-- Sample Data -->
                    <tr>
                        <td>1</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm bg-primary rounded-circle d-flex align-items-center justify-content-center me-2">
                                    <span class="text-white">A</span>
                                </div>
                                <div>
                                    <strong>Ahmad Bin Ali</strong>
                                    <i class="fas fa-check-circle text-success ms-1" title="Terverifikasi"></i>
                                </div>
                            </div>
                        </td>
                        <td>ahmad@email.com</td>
                        <td>901234-56-7890</td>
                        <td>012-3456789</td>
                        <td><span class="badge bg-success">Aktif</span></td>
                        <td>15/01/2024</td>
                        <td>16/01/2024 10:30</td>
                        <td>
                            <div class="btn-group" role="group">
                                <button class="btn btn-sm btn-outline-primary" title="Lihat">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm bg-info rounded-circle d-flex align-items-center justify-content-center me-2">
                                    <span class="text-white">S</span>
                                </div>
                                <div>
                                    <strong>Siti Fatimah</strong>
                                    <i class="fas fa-check-circle text-success ms-1" title="Terverifikasi"></i>
                                </div>
                            </div>
                        </td>
                        <td>siti@email.com</td>
                        <td>851234-56-7891</td>
                        <td>013-4567890</td>
                        <td><span class="badge bg-success">Aktif</span></td>
                        <td>14/01/2024</td>
                        <td>16/01/2024 09:15</td>
                        <td>
                            <div class="btn-group" role="group">
                                <button class="btn btn-sm btn-outline-primary" title="Lihat">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm bg-warning rounded-circle d-flex align-items-center justify-content-center me-2">
                                    <span class="text-white">M</span>
                                </div>
                                <div>
                                    <strong>Muhammad Hafiz</strong>
                                </div>
                            </div>
                        </td>
                        <td>hafiz@email.com</td>
                        <td>921234-56-7892</td>
                        <td>014-5678901</td>
                        <td><span class="badge bg-warning">Pending</span></td>
                        <td>13/01/2024</td>
                        <td>Belum Login</td>
                        <td>
                            <div class="btn-group" role="group">
                                <button class="btn btn-sm btn-outline-primary" title="Lihat">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if(isset($pemohonList) && $pemohonList->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $pemohonList->links() }}
        </div>
        @endif
    </div>
</div>

<!-- Add Pemohon Modal -->
<div class="modal fade" id="addPemohonModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Pemohon Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="addPemohonForm">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Penuh *</label>
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email *</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="no_kp" class="form-label">No. Kad Pengenalan *</label>
                                <input type="text" class="form-control" id="no_kp" name="no_kp" 
                                       placeholder="901234-56-7890" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="no_telefon" class="form-label">No. Telefon *</label>
                                <input type="text" class="form-control" id="no_telefon" name="no_telefon" 
                                       placeholder="012-3456789" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea class="form-control" id="alamat" name="alamat" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="password" class="form-label">Kata Laluan *</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status_pemohon" class="form-label">Status</label>
                                <select class="form-select" id="status_pemohon" name="status">
                                    <option value="aktif">Aktif</option>
                                    <option value="pending">Pending Verifikasi</option>
                                    <option value="tidak_aktif">Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.avatar-sm {
    width: 35px;
    height: 35px;
    font-size: 14px;
}

.table th {
    border-top: none;
    font-weight: 600;
    color: #2c3e50;
}

.btn-group .btn {
    border-radius: 4px;
    margin-right: 2px;
}
</style>
@endpush

@push('scripts')
<script>
function viewPemohon(id) {
    // Implement view pemohon functionality
    alert('View pemohon ID: ' + id);
}

function editPemohon(id) {
    // Implement edit pemohon functionality
    alert('Edit pemohon ID: ' + id);
}

function deletePemohon(id) {
    if (confirm('Adakah anda pasti untuk menghapus pemohon ini?')) {
        // Implement delete pemohon functionality
        alert('Delete pemohon ID: ' + id);
    }
}

function exportData() {
    // Implement export functionality
    alert('Export data pemohon');
}

// Add Pemohon Form Submit
document.getElementById('addPemohonForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Get form data
    const formData = new FormData(this);
    
    // Implement AJAX submission here
    alert('Pemohon baru akan ditambah');
    
    // Close modal
    bootstrap.Modal.getInstance(document.getElementById('addPemohonModal')).hide();
    
    // Reset form
    this.reset();
});

// Initialize tooltips
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
});
</script>
@endpush