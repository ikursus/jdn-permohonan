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
                <span class="badge bg-warning">Dalam Proses</span>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <i class="bi bi-info-circle me-2"></i>
                    <strong>Nota:</strong> Permohonan yang sedang dalam proses masih boleh dikemaskini. Sebarang perubahan akan memerlukan semakan semula.
                </div>
                
                <form method="POST" action="{{ route('pemohon.permohonan.update', ['id' => 1]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <strong>No. Rujukan:</strong>
                        </div>
                        <div class="col-md-9">
                            <span class="text-primary">#JDN2024001</span>
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
                                    <option value="permit_kerja" selected>Permit Kerja</option>
                                    <option value="visa_kerja">Visa Kerja</option>
                                    <option value="permit_tinggal">Permit Tinggal</option>
                                    <option value="lain_lain">Lain-lain</option>
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
                                       value="2024-01-30" required>
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
                                  placeholder="Nyatakan tujuan permohonan anda..." required>Permohonan permit kerja untuk jawatan Software Developer di syarikat teknologi tempatan.</textarea>
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
                                       value="Tech Solutions Sdn Bhd" 
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
                                       value="Software Developer" 
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
                                  placeholder="Alamat lengkap syarikat atau majikan">No. 123, Jalan Teknologi 1, Cyberjaya, 63000 Selangor</textarea>
                        @error('alamat_syarikat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="dokumen" class="form-label">Muat Naik Dokumen Sokongan Tambahan</label>
                        <input type="file" class="form-control @error('dokumen') is-invalid @enderror" 
                               id="dokumen" name="dokumen[]" multiple 
                               accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                        <div class="form-text">Format yang diterima: PDF, JPG, PNG, DOC, DOCX (Maksimum 5MB setiap fail)</div>
                        <div class="form-text text-info">Biarkan kosong jika tidak ingin menambah dokumen baru</div>
                        @error('dokumen')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="catatan" class="form-label">Catatan Tambahan</label>
                        <textarea class="form-control @error('catatan') is-invalid @enderror" 
                                  id="catatan" name="catatan" rows="3" 
                                  placeholder="Sebarang catatan atau maklumat tambahan...">Memerlukan permit kerja segera untuk memulakan tugas pada 1 Februari 2024.</textarea>
                        @error('catatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <div>
                            <a href="{{ route('pemohon.permohonan.detail', ['id' => 1]) }}" class="btn btn-secondary me-2">
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
        
        <!-- Dokumen Sedia Ada -->
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Dokumen Sedia Ada</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="d-flex align-items-center p-3 border rounded">
                            <i class="bi bi-file-earmark-pdf text-danger fs-2 me-3"></i>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Kad Pengenalan</h6>
                                <small class="text-muted">ic_copy.pdf (1.2 MB)</small>
                            </div>
                            <div>
                                <a href="#" class="btn btn-sm btn-outline-primary me-1">
                                    <i class="bi bi-download"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDelete('ic_copy.pdf')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="d-flex align-items-center p-3 border rounded">
                            <i class="bi bi-file-earmark-text text-primary fs-2 me-3"></i>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Surat Tawaran Kerja</h6>
                                <small class="text-muted">offer_letter.pdf (856 KB)</small>
                            </div>
                            <div>
                                <a href="#" class="btn btn-sm btn-outline-primary me-1">
                                    <i class="bi bi-download"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDelete('offer_letter.pdf')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="d-flex align-items-center p-3 border rounded">
                            <i class="bi bi-file-earmark-image text-success fs-2 me-3"></i>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Sijil Kelayakan</h6>
                                <small class="text-muted">certificate.jpg (2.1 MB)</small>
                            </div>
                            <div>
                                <a href="#" class="btn btn-sm btn-outline-primary me-1">
                                    <i class="bi bi-download"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDelete('certificate.jpg')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Panduan Edit</h5>
            </div>
            <div class="card-body">
                <div class="alert alert-warning">
                    <h6><i class="bi bi-exclamation-triangle me-2"></i>Penting</h6>
                    <ul class="mb-0 small">
                        <li>Perubahan pada permohonan akan memerlukan semakan semula</li>
                        <li>Status permohonan mungkin berubah kepada "Dalam Semakan"</li>
                        <li>Pastikan maklumat yang dikemaskini adalah tepat</li>
                        <li>Dokumen baru akan ditambah kepada dokumen sedia ada</li>
                    </ul>
                </div>
                
                <div class="alert alert-info">
                    <h6><i class="bi bi-info-circle me-2"></i>Tips</h6>
                    <ul class="mb-0 small">
                        <li>Gunakan butang "Reset" untuk kembali ke data asal</li>
                        <li>Anda boleh memadamkan dokumen lama jika perlu</li>
                        <li>Simpan perubahan sebelum meninggalkan halaman</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Status Permohonan -->
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Status Semasa</h5>
            </div>
            <div class="card-body">
                <div class="text-center">
                    <span class="badge bg-warning fs-6 px-3 py-2">Dalam Proses</span>
                    <p class="mt-3 mb-0 small text-muted">Permohonan sedang diproses oleh pegawai berkenaan</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Reset form to original values
    function resetForm() {
        if (confirm('Adakah anda pasti ingin reset semua perubahan? Data akan kembali ke nilai asal.')) {
            location.reload();
        }
    }
    
    // Confirm delete document
    function confirmDelete(filename) {
        if (confirm('Adakah anda pasti ingin memadamkan dokumen "' + filename + '"? Tindakan ini tidak boleh dibatalkan.')) {
            // Handle document deletion logic here
            alert('Dokumen "' + filename + '" telah dipadamkan.');
        }
    }
    
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
    
    // Form change detection
    let formChanged = false;
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
            e.returnValue = 'Anda mempunyai perubahan yang belum disimpan. Adakah anda pasti ingin meninggalkan halaman ini?';
        }
    });
    
    // Reset form changed flag on submit
    form.addEventListener('submit', function() {
        formChanged = false;
    });
</script>
@endpush