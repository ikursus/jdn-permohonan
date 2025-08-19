@extends('admin.template-induk')

@section('title', 'Pengurusan Helpdesk')
@section('page-title', 'Pengurusan Helpdesk')

@section('content')
<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card stats-card">
            <div class="card-body text-center">
                <i class="fas fa-ticket-alt fa-2x mb-3"></i>
                <h3 class="mb-1">{{ $totalTickets ?? 156 }}</h3>
                <p class="mb-0">Total Tiket</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stats-card">
            <div class="card-body text-center">
                <i class="fas fa-clock fa-2x mb-3"></i>
                <h3 class="mb-1">{{ $openTickets ?? 42 }}</h3>
                <p class="mb-0">Tiket Terbuka</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stats-card">
            <div class="card-body text-center">
                <i class="fas fa-user-clock fa-2x mb-3"></i>
                <h3 class="mb-1">{{ $pendingTickets ?? 18 }}</h3>
                <p class="mb-0">Menunggu Respons</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stats-card">
            <div class="card-body text-center">
                <i class="fas fa-check-circle fa-2x mb-3"></i>
                <h3 class="mb-1">{{ $resolvedTickets ?? 96 }}</h3>
                <p class="mb-0">Diselesaikan</p>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row mb-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Tindakan Pantas</h6>
                <div class="row">
                    <div class="col-md-3">
                        <button class="btn btn-outline-primary w-100" onclick="filterByStatus('open')">
                            <i class="fas fa-folder-open"></i> Tiket Terbuka
                        </button>
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-outline-warning w-100" onclick="filterByPriority('high')">
                            <i class="fas fa-exclamation-triangle"></i> Keutamaan Tinggi
                        </button>
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-outline-danger w-100" onclick="filterOverdue()">
                            <i class="fas fa-clock"></i> Tiket Tertunggak
                        </button>
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-outline-info w-100" onclick="showAssignModal()">
                            <i class="fas fa-user-plus"></i> Tugaskan Tiket
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Search and Filter -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.helpdesk') }}">
            <div class="row">
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="search" class="form-label">Cari Tiket</label>
                        <input type="text" class="form-control" id="search" name="search" 
                               placeholder="ID, Subjek, Pemohon" value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="mb-3">
                        <label for="category" class="form-label">Kategori</label>
                        <select class="form-select" id="category" name="category">
                            <option value="">Semua Kategori</option>
                            <option value="technical" {{ request('category') == 'technical' ? 'selected' : '' }}>Teknikal</option>
                            <option value="account" {{ request('category') == 'account' ? 'selected' : '' }}>Akaun</option>
                            <option value="application" {{ request('category') == 'application' ? 'selected' : '' }}>Permohonan</option>
                            <option value="general" {{ request('category') == 'general' ? 'selected' : '' }}>Am</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="">Semua Status</option>
                            <option value="open" {{ request('status') == 'open' ? 'selected' : '' }}>Terbuka</option>
                            <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>Dalam Proses</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                            <option value="resolved" {{ request('status') == 'resolved' ? 'selected' : '' }}>Diselesaikan</option>
                            <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Ditutup</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="mb-3">
                        <label for="priority" class="form-label">Keutamaan</label>
                        <select class="form-select" id="priority" name="priority">
                            <option value="">Semua</option>
                            <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Rendah</option>
                            <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>Sederhana</option>
                            <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>Tinggi</option>
                            <option value="urgent" {{ request('priority') == 'urgent' ? 'selected' : '' }}>Segera</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="mb-3">
                        <label for="assigned_to" class="form-label">Ditugaskan</label>
                        <select class="form-select" id="assigned_to" name="assigned_to">
                            <option value="">Semua</option>
                            <option value="unassigned" {{ request('assigned_to') == 'unassigned' ? 'selected' : '' }}>Belum Ditugaskan</option>
                            <option value="me" {{ request('assigned_to') == 'me' ? 'selected' : '' }}>Saya</option>
                            <!-- Add more admin users here -->
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

<!-- Helpdesk Tickets List -->
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-ticket-alt me-2"></i>Senarai Tiket Helpdesk</h5>
        <div>
            <button class="btn btn-outline-secondary btn-sm me-2" onclick="exportTickets()">
                <i class="fas fa-download"></i> Export
            </button>
            <button class="btn btn-outline-info btn-sm" onclick="bulkAssign()">
                <i class="fas fa-users"></i> Tugaskan Pukal
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
                        <th>Subjek</th>
                        <th>Pemohon</th>
                        <th>Kategori</th>
                        <th>Keutamaan</th>
                        <th>Status</th>
                        <th>Ditugaskan</th>
                        <th>Tarikh Dibuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ticketList ?? [] as $ticket)
                    <tr class="{{ $ticket->priority == 'urgent' ? 'table-danger' : ($ticket->priority == 'high' ? 'table-warning' : '') }}">
                        <td>
                            <input type="checkbox" class="row-checkbox" value="{{ $ticket->id }}">
                        </td>
                        <td><strong>#{{ str_pad($ticket->id, 4, '0', STR_PAD_LEFT) }}</strong></td>
                        <td>
                            <div>
                                <strong>{{ Str::limit($ticket->subject, 40) }}</strong>
                                @if($ticket->has_attachments)
                                    <i class="fas fa-paperclip text-muted ms-1" title="Ada lampiran"></i>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div>
                                <strong>{{ $ticket->pemohon->nama }}</strong><br>
                                <small class="text-muted">{{ $ticket->pemohon->email }}</small>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-secondary">{{ ucfirst($ticket->category) }}</span>
                        </td>
                        <td>
                            <span class="badge bg-{{ $ticket->priority == 'urgent' ? 'danger' : ($ticket->priority == 'high' ? 'warning' : ($ticket->priority == 'medium' ? 'info' : 'secondary')) }}">
                                {{ ucfirst($ticket->priority) }}
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-{{ $ticket->status == 'open' ? 'primary' : ($ticket->status == 'resolved' ? 'success' : ($ticket->status == 'closed' ? 'dark' : 'warning')) }}">
                                {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                            </span>
                        </td>
                        <td>
                            @if($ticket->assigned_to)
                                <small>{{ $ticket->assignedAdmin->name }}</small>
                            @else
                                <span class="text-muted">Belum ditugaskan</span>
                            @endif
                        </td>
                        <td>{{ $ticket->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <button class="btn btn-sm btn-outline-primary" onclick="viewTicket({{ $ticket->id }})" title="Lihat">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-success" onclick="replyTicket({{ $ticket->id }})" title="Balas">
                                    <i class="fas fa-reply"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-warning" onclick="assignTicket({{ $ticket->id }})" title="Tugaskan">
                                    <i class="fas fa-user-plus"></i>
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
                                <strong>Masalah log masuk ke sistem</strong>
                                <i class="fas fa-paperclip text-muted ms-1" title="Ada lampiran"></i>
                            </div>
                        </td>
                        <td>
                            <div>
                                <strong>Ahmad Bin Ali</strong><br>
                                <small class="text-muted">ahmad@email.com</small>
                            </div>
                        </td>
                        <td><span class="badge bg-secondary">Technical</span></td>
                        <td><span class="badge bg-danger">Urgent</span></td>
                        <td><span class="badge bg-primary">Open</span></td>
                        <td><span class="text-muted">Belum ditugaskan</span></td>
                        <td>15/01/2024 10:30</td>
                        <td>
                            <div class="btn-group" role="group">
                                <button class="btn btn-sm btn-outline-primary" title="Lihat">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-success" title="Balas">
                                    <i class="fas fa-reply"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-warning" title="Tugaskan">
                                    <i class="fas fa-user-plus"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" class="row-checkbox" value="2"></td>
                        <td><strong>#0002</strong></td>
                        <td>
                            <div>
                                <strong>Pertanyaan tentang status permohonan</strong>
                            </div>
                        </td>
                        <td>
                            <div>
                                <strong>Siti Fatimah</strong><br>
                                <small class="text-muted">siti@email.com</small>
                            </div>
                        </td>
                        <td><span class="badge bg-secondary">Application</span></td>
                        <td><span class="badge bg-info">Medium</span></td>
                        <td><span class="badge bg-warning">In Progress</span></td>
                        <td><small>Admin User</small></td>
                        <td>14/01/2024 09:15</td>
                        <td>
                            <div class="btn-group" role="group">
                                <button class="btn btn-sm btn-outline-primary" title="Lihat">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-success" title="Balas">
                                    <i class="fas fa-reply"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-warning" title="Tugaskan">
                                    <i class="fas fa-user-plus"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" class="row-checkbox" value="3"></td>
                        <td><strong>#0003</strong></td>
                        <td>
                            <div>
                                <strong>Permintaan reset kata laluan</strong>
                            </div>
                        </td>
                        <td>
                            <div>
                                <strong>Muhammad Hafiz</strong><br>
                                <small class="text-muted">hafiz@email.com</small>
                            </div>
                        </td>
                        <td><span class="badge bg-secondary">Account</span></td>
                        <td><span class="badge bg-secondary">Low</span></td>
                        <td><span class="badge bg-success">Resolved</span></td>
                        <td><small>Admin User</small></td>
                        <td>13/01/2024 14:20</td>
                        <td>
                            <div class="btn-group" role="group">
                                <button class="btn btn-sm btn-outline-primary" title="Lihat">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-success" title="Balas">
                                    <i class="fas fa-reply"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-warning" title="Tugaskan">
                                    <i class="fas fa-user-plus"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if(isset($ticketList) && $ticketList->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $ticketList->links() }}
        </div>
        @endif
    </div>
</div>

<!-- Assign Modal -->
<div class="modal fade" id="assignModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tugaskan Tiket</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="assignForm">
                <div class="modal-body">
                    <input type="hidden" id="ticket_id" name="ticket_id">
                    <div class="mb-3">
                        <label for="assign_to" class="form-label">Tugaskan kepada</label>
                        <select class="form-select" id="assign_to" name="assign_to" required>
                            <option value="">Pilih Admin</option>
                            <option value="1">Admin User 1</option>
                            <option value="2">Admin User 2</option>
                            <option value="3">Admin User 3</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="assign_notes" class="form-label">Catatan</label>
                        <textarea class="form-control" id="assign_notes" name="notes" rows="3" 
                                  placeholder="Catatan untuk admin yang ditugaskan..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tugaskan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Reply Modal -->
<div class="modal fade" id="replyModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Balas Tiket</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="replyForm">
                <div class="modal-body">
                    <input type="hidden" id="reply_ticket_id" name="ticket_id">
                    <div class="mb-3">
                        <label for="reply_message" class="form-label">Mesej Balasan</label>
                        <textarea class="form-control" id="reply_message" name="message" rows="5" 
                                  placeholder="Tulis balasan anda di sini..." required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="reply_status" class="form-label">Kemaskini Status</label>
                        <select class="form-select" id="reply_status" name="status">
                            <option value="">Kekalkan status semasa</option>
                            <option value="in_progress">Dalam Proses</option>
                            <option value="pending">Menunggu Respons Pemohon</option>
                            <option value="resolved">Diselesaikan</option>
                            <option value="closed">Tutup Tiket</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="reply_attachments" class="form-label">Lampiran</label>
                        <input type="file" class="form-control" id="reply_attachments" name="attachments[]" multiple>
                        <small class="text-muted">Maksimum 5MB setiap fail. Format yang dibenarkan: PDF, DOC, DOCX, JPG, PNG</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Hantar Balasan</button>
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

.table-danger {
    background-color: rgba(220, 53, 69, 0.1);
}

.table-warning {
    background-color: rgba(255, 193, 7, 0.1);
}
</style>
@endpush

@push('scripts')
<script>
function viewTicket(id) {
    window.open('/admin/helpdesk/' + id, '_blank');
}

function replyTicket(id) {
    document.getElementById('reply_ticket_id').value = id;
    new bootstrap.Modal(document.getElementById('replyModal')).show();
}

function assignTicket(id) {
    document.getElementById('ticket_id').value = id;
    new bootstrap.Modal(document.getElementById('assignModal')).show();
}

function exportTickets() {
    const params = new URLSearchParams(window.location.search);
    params.set('export', 'excel');
    window.open('/admin/helpdesk?' + params.toString(), '_blank');
}

function bulkAssign() {
    const selected = document.querySelectorAll('.row-checkbox:checked');
    if (selected.length === 0) {
        alert('Sila pilih sekurang-kurangnya satu tiket');
        return;
    }
    
    const ids = Array.from(selected).map(cb => cb.value);
    alert('Tugaskan tiket untuk ID: ' + ids.join(', '));
}

function toggleSelectAll() {
    const selectAll = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('.row-checkbox');
    
    checkboxes.forEach(cb => {
        cb.checked = selectAll.checked;
    });
}

function filterByStatus(status) {
    document.getElementById('status').value = status;
    document.querySelector('form').submit();
}

function filterByPriority(priority) {
    document.getElementById('priority').value = priority;
    document.querySelector('form').submit();
}

function filterOverdue() {
    // Implement overdue filter logic
    alert('Filter tiket tertunggak');
}

function showAssignModal() {
    new bootstrap.Modal(document.getElementById('assignModal')).show();
}

// Assign Form Submit
document.getElementById('assignForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const ticketId = formData.get('ticket_id');
    const assignTo = formData.get('assign_to');
    
    alert('Tiket #' + ticketId + ' akan ditugaskan kepada admin ID: ' + assignTo);
    
    bootstrap.Modal.getInstance(document.getElementById('assignModal')).hide();
    this.reset();
});

// Reply Form Submit
document.getElementById('replyForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const ticketId = formData.get('ticket_id');
    
    alert('Balasan untuk tiket #' + ticketId + ' akan dihantar');
    
    bootstrap.Modal.getInstance(document.getElementById('replyModal')).hide();
    this.reset();
});

// Initialize tooltips
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
});
</script>
@endpush