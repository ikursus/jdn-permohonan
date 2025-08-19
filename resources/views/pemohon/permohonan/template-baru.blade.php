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
                <form method="POST" action="{{ route('pemohon.permohonan.proses') }}" enctype="multipart/form-data">
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
                                <label for="tarikh_diperlukan" class="form-label">Tarikh Diperlukan <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('tarikh_diperlukan') is-invalid @enderror" 
                                       id="tarikh_diperlukan" name="tarikh_diperlukan" 
                                       value="{{ old('tarikh_diperlukan') }}" required>
                                @error('tarikh_diperlukan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="tujuan" class="form-label">Tujuan Permohonan <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('tujuan') is-invalid @enderror" 
                                  id="tujuan" name="tujuan" rows="3" 
                                  placeholder="Nyatakan tujuan permohonan anda..." required>{{ old('tujuan') }}</textarea>
                        @error('tujuan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nama_syarikat" class="form-label">Nama Syarikat/Majikan</label>
                                <input type="text" class="form-control @error('nama_syarikat') is-invalid @enderror" 
                                       id="nama_syarikat" name="nama_syarikat" 
                                       value="{{ old('nama_syarikat') }}" 
                                       placeholder="Nama syarikat atau majikan">
                                @error('nama_syarikat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="jawatan" class="form-label">Jawatan</label>
                                <input type="text" class="form-control @error('jawatan') is-invalid @enderror" 
                                       id="jawatan" name="jawatan" 
                                       value="{{ old('jawatan') }}" 
                                       placeholder="Jawatan yang dipohon">
                                @error('jawatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="alamat_syarikat" class="form-label">Alamat Syarikat/Majikan</label>
                        <textarea class="form-control @error('alamat_syarikat') is-invalid @enderror" 
                                  id="alamat_syarikat" name="alamat_syarikat" rows="2" 
                                  placeholder="Alamat lengkap syarikat atau majikan">{{ old('alamat_syarikat') }}</textarea>
                        @error('alamat_syarikat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="dokumen" class="form-label">Muat Naik Dokumen Sokongan</label>
                        <input type="file" class="form-control @error('dokumen') is-invalid @enderror" 
                               id="dokumen" name="dokumen[]" multiple 
                               accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                        <div class="form-text">Format yang diterima: PDF, JPG, PNG, DOC, DOCX (Maksimum 5MB setiap fail)</div>
                        @error('dokumen')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="catatan" class="form-label">Catatan Tambahan</label>
                        <textarea class="form-control @error('catatan') is-invalid @enderror" 
                                  id="catatan" name="catatan" rows="3" 
                                  placeholder="Sebarang catatan atau maklumat tambahan...">{{ old('catatan') }}</textarea>
                        @error('catatan')
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