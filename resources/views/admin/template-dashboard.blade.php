@extends('admin.template-induk')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard Admin')

@section('content')
<div class="row">
    <!-- Statistics Cards -->
    <div class="col-md-3 mb-4">
        <div class="card stats-card">
            <div class="card-body text-center">
                <i class="fas fa-users fa-2x mb-3"></i>
                <h3 class="mb-1">{{ $totalPemohon ?? 156 }}</h3>
                <p class="mb-0">Total Pemohon</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-4">
        <div class="card stats-card">
            <div class="card-body text-center">
                <i class="fas fa-file-alt fa-2x mb-3"></i>
                <h3 class="mb-1">{{ $totalPermohonan ?? 89 }}</h3>
                <p class="mb-0">Total Permohonan</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-4">
        <div class="card stats-card">
            <div class="card-body text-center">
                <i class="fas fa-clock fa-2x mb-3"></i>
                <h3 class="mb-1">{{ $permohonanPending ?? 23 }}</h3>
                <p class="mb-0">Permohonan Pending</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-4">
        <div class="card stats-card">
            <div class="card-body text-center">
                <i class="fas fa-headset fa-2x mb-3"></i>
                <h3 class="mb-1">{{ $tiketHelpdesk ?? 12 }}</h3>
                <p class="mb-0">Tiket Helpdesk</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Recent Applications -->
    <div class="col-md-8 mb-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-file-alt me-2"></i>Permohonan Terbaru</h5>
                <a href="{{ route('admin.permohonan') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Pemohon</th>
                                <th>Jenis</th>
                                <th>Status</th>
                                <th>Tarikh</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentApplications ?? [] as $application)
                            <tr>
                                <td>#{{ $application->id }}</td>
                                <td>{{ $application->pemohon->nama }}</td>
                                <td>{{ $application->jenis }}</td>
                                <td>
                                    <span class="badge bg-{{ $application->status == 'pending' ? 'warning' : ($application->status == 'approved' ? 'success' : 'danger') }}">
                                        {{ ucfirst($application->status) }}
                                    </span>
                                </td>
                                <td>{{ $application->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-outline-primary">Lihat</a>
                                </td>
                            </tr>
                            @empty
                            <!-- Sample Data -->
                            <tr>
                                <td>#001</td>
                                <td>Ahmad Bin Ali</td>
                                <td>Sijil Kelahiran</td>
                                <td><span class="badge bg-warning">Pending</span></td>
                                <td>15/01/2024</td>
                                <td><a href="#" class="btn btn-sm btn-outline-primary">Lihat</a></td>
                            </tr>
                            <tr>
                                <td>#002</td>
                                <td>Siti Fatimah</td>
                                <td>Sijil Perkahwinan</td>
                                <td><span class="badge bg-success">Approved</span></td>
                                <td>14/01/2024</td>
                                <td><a href="#" class="btn btn-sm btn-outline-primary">Lihat</a></td>
                            </tr>
                            <tr>
                                <td>#003</td>
                                <td>Muhammad Hafiz</td>
                                <td>Sijil Kematian</td>
                                <td><span class="badge bg-warning">Pending</span></td>
                                <td>13/01/2024</td>
                                <td><a href="#" class="btn btn-sm btn-outline-primary">Lihat</a></td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Quick Actions -->
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-bolt me-2"></i>Tindakan Pantas</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.permohonan') }}" class="btn btn-outline-primary">
                        <i class="fas fa-file-alt me-2"></i>Semak Permohonan
                    </a>
                    <a href="{{ route('admin.pemohon') }}" class="btn btn-outline-info">
                        <i class="fas fa-users me-2"></i>Urus Pemohon
                    </a>
                    <a href="{{ route('admin.helpdesk') }}" class="btn btn-outline-warning">
                        <i class="fas fa-headset me-2"></i>Tiket Helpdesk
                    </a>
                    <a href="#" class="btn btn-outline-success">
                        <i class="fas fa-chart-bar me-2"></i>Laporan
                    </a>
                </div>
            </div>
        </div>
        
        <!-- System Status -->
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-server me-2"></i>Status Sistem</h5>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span>Server Status</span>
                    <span class="badge bg-success">Online</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span>Database</span>
                    <span class="badge bg-success">Connected</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span>Storage</span>
                    <span class="badge bg-warning">75% Used</span>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <span>Last Backup</span>
                    <span class="text-muted">2 hours ago</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-history me-2"></i>Aktiviti Terkini</h5>
            </div>
            <div class="card-body">
                <div class="timeline">
                    @forelse($recentActivities ?? [] as $activity)
                    <div class="timeline-item">
                        <div class="timeline-marker bg-primary"></div>
                        <div class="timeline-content">
                            <h6 class="timeline-title">{{ $activity->title }}</h6>
                            <p class="timeline-text">{{ $activity->description }}</p>
                            <small class="text-muted">{{ $activity->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                    @empty
                    <!-- Sample Activities -->
                    <div class="timeline-item">
                        <div class="timeline-marker bg-success"></div>
                        <div class="timeline-content">
                            <h6 class="timeline-title">Permohonan Diluluskan</h6>
                            <p class="timeline-text">Permohonan #002 oleh Siti Fatimah telah diluluskan</p>
                            <small class="text-muted">2 jam yang lalu</small>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-marker bg-info"></div>
                        <div class="timeline-content">
                            <h6 class="timeline-title">Pemohon Baru Mendaftar</h6>
                            <p class="timeline-text">Muhammad Hafiz telah mendaftar sebagai pemohon baru</p>
                            <small class="text-muted">4 jam yang lalu</small>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-marker bg-warning"></div>
                        <div class="timeline-content">
                            <h6 class="timeline-title">Tiket Helpdesk Baru</h6>
                            <p class="timeline-text">Tiket #HD001 telah dibuka oleh Ahmad Bin Ali</p>
                            <small class="text-muted">6 jam yang lalu</small>
                        </div>
                    </div>
                    @endforelse
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

.timeline-item {
    position: relative;
    margin-bottom: 30px;
}

.timeline-item:not(:last-child)::before {
    content: '';
    position: absolute;
    left: -21px;
    top: 20px;
    height: calc(100% + 10px);
    width: 2px;
    background-color: #e9ecef;
}

.timeline-marker {
    position: absolute;
    left: -25px;
    top: 5px;
    width: 10px;
    height: 10px;
    border-radius: 50%;
    border: 2px solid white;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.timeline-content {
    background: white;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.timeline-title {
    margin-bottom: 5px;
    color: #2c3e50;
}

.timeline-text {
    margin-bottom: 5px;
    color: #6c757d;
}
</style>
@endpush

@push('scripts')
<script>
// Auto refresh dashboard data every 5 minutes
setInterval(function() {
    // You can add AJAX call here to refresh dashboard data
    console.log('Dashboard data refreshed');
}, 300000);

// Initialize tooltips
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
});
</script>
@endpush