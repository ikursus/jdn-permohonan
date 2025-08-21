@extends('pemohon.template-induk')

@section('title', 'Edit Permohonan')
@section('page-title', 'Edit Permohonan')

@section('content')
<div class="content-header">
    <h1 class="page-title">Edit Permohonan</h1>
    <p class="page-subtitle">Kemaskini maklumat permohonan anda</p>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Kemaskini Maklumat Permohonan</h5>
                <span class="badge bg-warning">{{ ucfirst($permohonan->status ?? 'pending') }}</span>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <i class="bi bi-info-circle me-2"></i>
                    <strong>Nota:</strong> Permohonan yang sedang dalam proses masih boleh dikemaskini. Sebarang perubahan akan memerlukan semakan semula.
                </div>
                
                <form method="POST" action="{{ route('pemohon.permohonan.update', $permohonan->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <strong>No. Rujukan:</strong>
                        </div>
                        <div class="col-md-9">
                            <span class="text-primary">#JDN{{ str_pad($permohonan->id, 7, '0', STR_PAD_LEFT) }}</span>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="jenis_permohonan" class="form-label">Jenis Permohonan <span class="text-danger">*</span></label>
                                <select class="form-select @error('jenis_permohonan') is-invalid @enderror" 
                                        id="jenis_permohonan" name="jenis_permohonan" required>
                                    <option value="">Pilih Jenis Permohonan</option>
                                    <option value="permit_kerja" {{ old('jenis_permohonan', $permohonan->jenis_permohonan) == 'permit_kerja' ? 'selected' : '' }}>Permit Kerja</option>
                                    <option value="visa_kerja" {{ old('jenis_permohonan', $permohonan->jenis_permohonan) == 'visa_kerja' ? 'selected' : '' }}>Visa Kerja</option>
                                    <option value="permit_tinggal" {{ old('jenis_permohonan', $permohonan->jenis_permohonan) == 'permit_tinggal' ? 'selected' : '' }}>Permit Tinggal</option>
                                    <option value="lain_lain" {{ old('jenis_permohonan', $permohonan->jenis_permohonan) == 'lain_lain' ? 'selected' : '' }}>Lain-lain</option>
                                </select>
                                @error('jenis_permohonan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="wilayah_asal" class="form-label">Wilayah Asal <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('wilayah_asal') is-invalid @enderror" 
                                       id="wilayah_asal" name="wilayah_asal" 
                                       value="{{ old('wilayah_asal', $permohonan->wilayah_asal) }}" 
                                       placeholder="Contoh: Selangor, Malaysia" required>
                                @error('wilayah_asal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="wilayah_ibu_negara" class="form-label">Wilayah Ibu Negara <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('wilayah_ibu_negara') is-invalid @enderror" 
                                       id="wilayah_ibu_negara" name="wilayah_ibu_negara" 
                                       value="{{ old('wilayah_ibu_negara', $permohonan->wilayah_ibu_negara) }}" 
                                       placeholder="Contoh: Kuala Lumpur" required>
                                @error('wilayah_ibu_negara')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tarikh_lapor_diri" class="form-label">Tarikh Lapor Diri <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('tarikh_lapor_diri') is-invalid @enderror" 
                                       id="tarikh_lapor_diri" name="tarikh_lapor_diri" 
                                       value="{{ old('tarikh_lapor_diri', $permohonan->tarikh_lapor_diri) }}" required>
                                @error('tarikh_lapor_diri')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tarikh_terakhir_kemudahan" class="form-label">Tarikh Terakhir Kemudahan</label>
                                <input type="date" class="form-control @error('tarikh_terakhir_kemudahan') is-invalid @enderror" 
                                       id="tarikh_terakhir_kemudahan" name="tarikh_terakhir_kemudahan" 
                                       value="{{ old('tarikh_terakhir_kemudahan', $permohonan->tarikh_terakhir_kemudahan) }}">
                                @error('tarikh_terakhir_kemudahan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tarikh_kemudahan_diperlukan" class="form-label">Tarikh Kemudahan Diperlukan</label>
                                <input type="date" class="form-control @error('tarikh_kemudahan_diperlukan') is-invalid @enderror" 
                                       id="tarikh_kemudahan_diperlukan" name="tarikh_kemudahan_diperlukan" 
                                       value="{{ old('tarikh_kemudahan_diperlukan', $permohonan->tarikh_kemudahan_diperlukan) }}">
                                @error('tarikh_kemudahan_diperlukan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="pengakuan" class="form-label">Pengakuan <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('pengakuan') is-invalid @enderror" 
                                  id="pengakuan" name="pengakuan" rows="4" 
                                  placeholder="Nyatakan pengakuan anda..." required>{{ old('pengakuan', $permohonan->pengakuan) }}</textarea>
                        @error('pengakuan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="pengakuan_tarikh" class="form-label">Tarikh Pengakuan <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('pengakuan_tarikh') is-invalid @enderror" 
                                       id="pengakuan_tarikh" name="pengakuan_tarikh" 
                                       value="{{ old('pengakuan_tarikh', $permohonan->pengakuan_tarikh) }}" required>
                                @error('pengakuan_tarikh')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select @error('status') is-invalid @enderror" 
                                        id="status" name="status">
                                    <option value="pending" {{ old('status', $permohonan->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="diproses" {{ old('status', $permohonan->status) == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                    <option value="lulus" {{ old('status', $permohonan->status) == 'lulus' ? 'selected' : '' }}>Lulus</option>
                                    <option value="ditolak" {{ old('status', $permohonan->status) == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <div>
                            <a href="{{ route('pemohon.permohonan.detail', $permohonan->id) }}" class="btn btn-secondary me-2">
                                <i class="bi bi-arrow-left me-2"></i>Kembali
                            </a>
                            <a href="{{ route('pemohon.permohonan.senarai') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-list me-2"></i>Ke Senarai
                            </a>
                        </div>
                        <div>
                            <button type="button" class="btn btn-outline-danger me-2" onclick="resetForm()">
                                <i class="bi bi-arrow-clockwise me-2"></i>Reset
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle me-2"></i>Kemaskini Permohonan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Maklumat Permohonan</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <small class="text-muted">Tarikh Permohonan</small>
                    <div>{{ date('d/m/Y', strtotime($permohonan->created_at)) }}</div>
                </div>
                <div class="mb-3">
                    <small class="text-muted">Tarikh Kemaskini Terakhir</small>
                    <div>{{ date('d/m/Y H:i', strtotime($permohonan->updated_at)) }}</div>
                </div>
                <div class="mb-3">
                    <small class="text-muted">Status Semasa</small>
                    <div>
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
                </div>
            </div>
        </div>
        
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Panduan</h5>
            </div>
            <div class="card-body">
                <div class="alert alert-warning">
                    <h6><i class="bi bi-exclamation-triangle me-2"></i>Penting</h6>
                    <ul class="mb-0 small">
                        <li>Perubahan pada permohonan akan memerlukan semakan semula</li>
                        <li>Status permohonan mungkin berubah kepada "Dalam Semakan"</li>
                        <li>Pastikan maklumat yang dikemaskini adalah tepat</li>
                        <li>Semua field bertanda (*) adalah wajib diisi</li>
                    </ul>
                </div>
                
                <div class="alert alert-info">
                    <h6><i class="bi bi-info-circle me-2"></i>Tips</h6>
                    <ul class="mb-0 small">
                        <li>Gunakan butang "Reset" untuk kembali ke data asal</li>
                        <li>Simpan perubahan sebelum meninggalkan halaman</li>
                        <li>Pastikan tarikh yang dimasukkan adalah betul</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let formChanged = false;

// Track form changes
const form = document.querySelector('form');
const inputs = form.querySelectorAll('input, select, textarea');

inputs.forEach(input => {
    input.addEventListener('change', function() {
        formChanged = true;
    });
});

// Warn before leaving if form has changes
window.addEventListener('beforeunload', function(e) {
    if (formChanged) {
        e.preventDefault();
        e.returnValue = '';
    }
});

// Reset form function
function resetForm() {
    if (confirm('Adakah anda pasti ingin reset semua perubahan?')) {
        form.reset();
        formChanged = false;
        // Reset select values to original
        @if(isset($permohonan))
        document.getElementById('jenis_permohonan').value = '{{ $permohonan->jenis_permohonan }}';
        document.getElementById('status').value = '{{ $permohonan->status }}';
        @endif
    }
}

// Form submission
form.addEventListener('submit', function() {
    formChanged = false;
});
</script>
@endsection