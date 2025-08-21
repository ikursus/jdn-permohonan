@extends('pemohon.template-induk')

@section('title', 'Permohonan Baru')
@section('page-title', 'Permohonan Baru')

@section('content')
<div class="content-header">
    <h1 class="page-title">Permohonan Baru</h1>
    <p class="page-subtitle">Sila lengkapkan maklumat permohonan anda</p>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Maklumat Permohonan</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('pemohon.permohonan.store') }}" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="jenis_permohonan" class="form-label">Jenis Permohonan <span class="text-danger">*</span></label>
                                <select class="form-select @error('jenis_permohonan') is-invalid @enderror" 
                                        id="jenis_permohonan" name="jenis_permohonan" required>
                                    <option value="">Pilih Jenis Permohonan</option>
                                    <option value="permit_kerja" {{ old('jenis_permohonan') == 'permit_kerja' ? 'selected' : '' }}>Permit Kerja</option>
                                    <option value="visa_kerja" {{ old('jenis_permohonan') == 'visa_kerja' ? 'selected' : '' }}>Visa Kerja</option>
                                    <option value="permit_tinggal" {{ old('jenis_permohonan') == 'permit_tinggal' ? 'selected' : '' }}>Permit Tinggal</option>
                                    <option value="lain_lain" {{ old('jenis_permohonan') == 'lain_lain' ? 'selected' : '' }}>Lain-lain</option>
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
                                       value="{{ old('wilayah_asal') }}" 
                                       placeholder="Masukkan wilayah asal" required>
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
                                       value="{{ old('wilayah_ibu_negara') }}" 
                                       placeholder="Masukkan wilayah ibu negara" required>
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
                                       value="{{ old('tarikh_lapor_diri') }}" required>
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
                                       value="{{ old('tarikh_terakhir_kemudahan') }}">
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
                                       value="{{ old('tarikh_kemudahan_diperlukan') }}">
                                @error('tarikh_kemudahan_diperlukan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="pengakuan" class="form-label">Pengakuan <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('pengakuan') is-invalid @enderror" 
                                  id="pengakuan" name="pengakuan" rows="3" 
                                  placeholder="Nyatakan pengakuan anda..." required>{{ old('pengakuan') }}</textarea>
                        @error('pengakuan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="pengakuan_tarikh" class="form-label">Tarikh Pengakuan <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('pengakuan_tarikh') is-invalid @enderror" 
                               id="pengakuan_tarikh" name="pengakuan_tarikh" 
                               value="{{ old('pengakuan_tarikh') }}" required>
                        @error('pengakuan_tarikh')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select @error('status') is-invalid @enderror" 
                                id="status" name="status">
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="diproses" {{ old('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                            <option value="lulus" {{ old('status') == 'lulus' ? 'selected' : '' }}>Lulus</option>
                            <option value="ditolak" {{ old('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('pemohon.permohonan.senarai') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-2"></i>Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-send me-2"></i>Hantar Permohonan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Panduan Permohonan</h5>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <h6><i class="bi bi-info-circle me-2"></i>Maklumat Penting</h6>
                    <ul class="mb-0 small">
                        <li>Pastikan semua maklumat yang diisi adalah tepat dan benar</li>
                        <li>Muat naik dokumen sokongan yang lengkap</li>
                        <li>Permohonan akan diproses dalam tempoh 7-14 hari bekerja</li>
                        <li>Anda akan menerima notifikasi melalui email</li>
                    </ul>
                </div>
                
                <div class="alert alert-warning">
                    <h6><i class="bi bi-exclamation-triangle me-2"></i>Dokumen Diperlukan</h6>
                    <ul class="mb-0 small">
                        <li>Salinan kad pengenalan</li>
                        <li>Surat tawaran kerja (jika ada)</li>
                        <li>Sijil kelayakan</li>
                        <li>Passport (untuk warga asing)</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Auto-hide alerts after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
        const alerts = document.querySelectorAll('.alert-dismissible');
        alerts.forEach(function(alert) {
            setTimeout(function() {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }, 5000);
        });
    });
    
    // File upload validation
    document.getElementById('dokumen').addEventListener('change', function() {
        const files = this.files;
        const maxSize = 5 * 1024 * 1024; // 5MB
        
        for (let i = 0; i < files.length; i++) {
            if (files[i].size > maxSize) {
                alert('Fail ' + files[i].name + ' melebihi saiz maksimum 5MB');
                this.value = '';
                break;
            }
        }
    });
</script>
@endpush