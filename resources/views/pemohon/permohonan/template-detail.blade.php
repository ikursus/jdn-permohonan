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
                @php
                    $statusClass = match($permohonan->status) {
                        'pending' => 'bg-warning',
                        'diproses' => 'bg-info',
                        'lulus' => 'bg-success',
                        'ditolak' => 'bg-danger',
                        default => 'bg-secondary'
                    };
                    $statusText = match($permohonan->status) {
                        'pending' => 'Pending',
                        'diproses' => 'Diproses',
                        'lulus' => 'Lulus',
                        'ditolak' => 'Ditolak',
                        default => 'Tidak Diketahui'
                    };
                @endphp
                <span class="badge {{ $statusClass }}">{{ $statusText }}</span>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>No. Rujukan:</strong>
                    </div>
                    <div class="col-md-9">
                        <span class="text-primary">#JDN{{ str_pad($permohonan->id, 7, '0', STR_PAD_LEFT) }}</span>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>Jenis Permohonan:</strong>
                    </div>
                    <div class="col-md-9">
                        @php
                            $jenisText = match($permohonan->jenis_permohonan) {
                                'permit_kerja' => 'Permit Kerja',
                                'visa_kerja' => 'Visa Kerja',
                                'permit_tinggal' => 'Permit Tinggal',
                                'lain_lain' => 'Lain-lain',
                                default => ucfirst($permohonan->jenis_permohonan)
                            };
                        @endphp
                        {{ $jenisText }}
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>Tarikh Permohonan:</strong>
                    </div>
                    <div class="col-md-9">
                        {{ date('d M Y', strtotime($permohonan->created_at)) }}
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>Wilayah Asal:</strong>
                    </div>
                    <div class="col-md-9">
                        {{ $permohonan->wilayah_asal }}
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>Wilayah Ibu Negara:</strong>
                    </div>
                    <div class="col-md-9">
                        {{ $permohonan->wilayah_ibu_negara }}
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>Tarikh Lapor Diri:</strong>
                    </div>
                    <div class="col-md-9">
                        {{ date('d M Y', strtotime($permohonan->tarikh_lapor_diri)) }}
                    </div>
                </div>
                
                @if($permohonan->tarikh_terakhir_kemudahan)
                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>Tarikh Terakhir Kemudahan:</strong>
                    </div>
                    <div class="col-md-9">
                        {{ date('d M Y', strtotime($permohonan->tarikh_terakhir_kemudahan)) }}
                    </div>
                </div>
                @endif
                
                @if($permohonan->tarikh_kemudahan_diperlukan)
                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>Tarikh Kemudahan Diperlukan:</strong>
                    </div>
                    <div class="col-md-9">
                        {{ date('d M Y', strtotime($permohonan->tarikh_kemudahan_diperlukan)) }}
                    </div>
                </div>
                @endif
                
                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>Status:</strong>
                    </div>
                    <div class="col-md-9">
                        <span class="badge {{ $statusClass }}">{{ $statusText }}</span>
                    </div>
                </div>
                
                <hr>
                
                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>Pengakuan:</strong>
                    </div>
                    <div class="col-md-9">
                        <div class="border rounded p-3 bg-light">
                            {{ $permohonan->pengakuan }}
                        </div>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>Tarikh Pengakuan:</strong>
                    </div>
                    <div class="col-md-9">
                        {{ date('d M Y', strtotime($permohonan->pengakuan_tarikh)) }}
                    </div>
                </div>
                
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('pemohon.permohonan.senarai') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Kembali ke Senarai
                    </a>
                    <div>
                        @if(in_array($permohonan->status, ['pending', 'diproses']))
                        <a href="{{ route('pemohon.permohonan.edit', $permohonan->id) }}" class="btn btn-warning me-2">
                            <i class="bi bi-pencil me-2"></i>Edit
                        </a>
                        @endif
                        @if($permohonan->status == 'pending')
                        <button type="button" class="btn btn-danger" onclick="confirmCancel()">
                            <i class="bi bi-x-circle me-2"></i>Batal Permohonan
                        </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Maklumat Pemohon -->
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Maklumat Pemohon</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>Nama:</strong>
                    </div>
                    <div class="col-md-9">
                        {{ $permohonan->nama_pemohon }}
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>Email:</strong>
                    </div>
                    <div class="col-md-9">
                        {{ $permohonan->email }}
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
                            <small class="text-muted">{{ date('d M Y, H:i', strtotime($permohonan->created_at)) }}</small>
                        </div>
                    </div>
                    
                    @if(in_array($permohonan->status, ['diproses', 'lulus', 'ditolak']))
                    <div class="timeline-item completed">
                        <div class="timeline-marker bg-success"></div>
                        <div class="timeline-content">
                            <h6 class="mb-1">Dokumen Disemak</h6>
                            <small class="text-muted">{{ date('d M Y, H:i', strtotime($permohonan->updated_at)) }}</small>
                        </div>
                    </div>
                    @endif
                    
                    @if($permohonan->status == 'diproses')
                    <div class="timeline-item active">
                        <div class="timeline-marker bg-warning"></div>
                        <div class="timeline-content">
                            <h6 class="mb-1">Dalam Proses</h6>
                            <small class="text-muted">{{ date('d M Y, H:i', strtotime($permohonan->updated_at)) }}</small>
                        </div>
                    </div>
                    @elseif(in_array($permohonan->status, ['lulus', 'ditolak']))
                    <div class="timeline-item completed">
                        <div class="timeline-marker bg-info"></div>
                        <div class="timeline-content">
                            <h6 class="mb-1">Dalam Proses</h6>
                            <small class="text-muted">Selesai</small>
                        </div>
                    </div>
                    @endif
                    
                    @if($permohonan->status == 'lulus')
                    <div class="timeline-item completed">
                        <div class="timeline-marker bg-success"></div>
                        <div class="timeline-content">
                            <h6 class="mb-1">Permohonan Lulus</h6>
                            <small class="text-muted">{{ date('d M Y, H:i', strtotime($permohonan->updated_at)) }}</small>
                        </div>
                    </div>
                    @elseif($permohonan->status == 'ditolak')
                    <div class="timeline-item completed">
                        <div class="timeline-marker bg-danger"></div>
                        <div class="timeline-content">
                            <h6 class="mb-1">Permohonan Ditolak</h6>
                            <small class="text-muted">{{ date('d M Y, H:i', strtotime($permohonan->updated_at)) }}</small>
                        </div>
                    </div>
                    @else
                    <div class="timeline-item">
                        <div class="timeline-marker bg-light"></div>
                        <div class="timeline-content">
                            <h6 class="mb-1 text-muted">Keputusan</h6>
                            <small class="text-muted">Menunggu</small>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Maklumat Pemprosesan -->
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Maklumat Pemprosesan</h5>
            </div>
            <div class="card-body">
                @if($permohonan->status == 'pending')
                <div class="alert alert-warning">
                    <h6><i class="bi bi-clock me-2"></i>Status Semasa</h6>
                    <p class="mb-2 small">Permohonan anda telah diterima dan menunggu untuk diproses.</p>
                    <p class="mb-0 small"><strong>Anggaran masa pemprosesan:</strong> 7-14 hari bekerja</p>
                </div>
                @elseif($permohonan->status == 'diproses')
                <div class="alert alert-info">
                    <h6><i class="bi bi-info-circle me-2"></i>Status Semasa</h6>
                    <p class="mb-2 small">Permohonan anda sedang dalam proses semakan oleh pegawai yang berkenaan.</p>
                    <p class="mb-0 small"><strong>Anggaran masa pemprosesan:</strong> 3-7 hari bekerja</p>
                </div>
                @elseif($permohonan->status == 'lulus')
                <div class="alert alert-success">
                    <h6><i class="bi bi-check-circle me-2"></i>Permohonan Lulus</h6>
                    <p class="mb-0 small">Tahniah! Permohonan anda telah diluluskan. Sila tunggu untuk maklumat lanjut.</p>
                </div>
                @elseif($permohonan->status == 'ditolak')
                <div class="alert alert-danger">
                    <h6><i class="bi bi-x-circle me-2"></i>Permohonan Ditolak</h6>
                    <p class="mb-0 small">Permohonan anda tidak dapat diluluskan. Sila hubungi pejabat untuk maklumat lanjut.</p>
                </div>
                @endif
                
                @if(in_array($permohonan->status, ['pending', 'diproses']))
                <div class="alert alert-info">
                    <h6><i class="bi bi-exclamation-triangle me-2"></i>Tindakan Diperlukan</h6>
                    <p class="mb-0 small">Tiada tindakan diperlukan pada masa ini. Kami akan menghubungi anda jika memerlukan maklumat tambahan.</p>
                </div>
                @endif
            </div>
        </div>
        
        <!-- Maklumat Tambahan -->
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Maklumat Tambahan</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <small class="text-muted">Tarikh Kemaskini Terakhir</small>
                    <div>{{ date('d/m/Y H:i', strtotime($permohonan->updated_at)) }}</div>
                </div>
                
                <div class="mb-3">
                    <small class="text-muted">ID Permohonan</small>
                    <div class="font-monospace">{{ $permohonan->id }}</div>
                </div>
                
                @if($permohonan->deleted_at)
                <div class="mb-3">
                    <small class="text-muted">Status</small>
                    <div><span class="badge bg-secondary">Dibatalkan</span></div>
                </div>
                @endif
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
        // Create form to submit delete request
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route("pemohon.permohonan.delete", $permohonan->id) }}';
        
        // Add CSRF token
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        form.appendChild(csrfToken);
        
        // Add method override
        const methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = 'DELETE';
        form.appendChild(methodField);
        
        // Submit form
        document.body.appendChild(form);
        form.submit();
    }
}
</script>
@endpush