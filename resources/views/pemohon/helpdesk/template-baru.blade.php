@extends('pemohon.template-induk')

@section('title', 'Tiket Helpdesk Baru')
@section('page-title', 'Tiket Helpdesk Baru')

@section('content')
<div class="content-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title">Buat Tiket Helpdesk Baru</h1>
            <p class="page-subtitle">Hantar pertanyaan atau laporan masalah kepada pasukan sokongan</p>
        </div>
        <a href="{{ route('pemohon.helpdesk.senarai') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-2"></i>Kembali ke Senarai
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-ticket-perforated me-2"></i>Maklumat Tiket
                </h5>
            </div>
            <div class="card-body">
                <form id="helpdesk-form" method="POST" action="{{ route('pemohon.helpdesk.store') }}" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="kategori" class="form-label">Kategori <span class="text-danger">*</span></label>
                            <select class="form-select @error('kategori') is-invalid @enderror" 
                                    id="kategori" name="kategori" required>
                                <option value="">Pilih Kategori</option>
                                <option value="teknikal" {{ old('kategori') == 'teknikal' ? 'selected' : '' }}>Masalah Teknikal</option>
                                <option value="permohonan" {{ old('kategori') == 'permohonan' ? 'selected' : '' }}>Pertanyaan Permohonan</option>
                                <option value="dokumen" {{ old('kategori') == 'dokumen' ? 'selected' : '' }}>Masalah Dokumen</option>
                                <option value="akaun" {{ old('kategori') == 'akaun' ? 'selected' : '' }}>Masalah Akaun</option>
                                <option value="lain" {{ old('kategori') == 'lain' ? 'selected' : '' }}>Lain-lain</option>
                            </select>
                            @error('kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="keutamaan" class="form-label">Tahap Keutamaan <span class="text-danger">*</span></label>
                            <select class="form-select @error('keutamaan') is-invalid @enderror" 
                                    id="keutamaan" name="keutamaan" required>
                                <option value="">Pilih Keutamaan</option>
                                <option value="rendah" {{ old('keutamaan') == 'rendah' ? 'selected' : '' }}>Rendah</option>
                                <option value="sederhana" {{ old('keutamaan') == 'sederhana' ? 'selected' : '' }}>Sederhana</option>
                                <option value="tinggi" {{ old('keutamaan') == 'tinggi' ? 'selected' : '' }}>Tinggi</option>
                                <option value="kritikal" {{ old('keutamaan') == 'kritikal' ? 'selected' : '' }}>Kritikal</option>
                            </select>
                            @error('keutamaan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="subjek" class="form-label">Subjek <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('subjek') is-invalid @enderror" 
                               id="subjek" 
                               name="subjek" 
                               value="{{ old('subjek') }}"
                               placeholder="Masukkan subjek tiket anda"
                               maxlength="200"
                               required>
                        @error('subjek')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Maksimum 200 aksara</div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="penerangan" class="form-label">Penerangan Masalah <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('penerangan') is-invalid @enderror" 
                                  id="penerangan" 
                                  name="penerangan" 
                                  rows="6"
                                  placeholder="Terangkan masalah atau pertanyaan anda dengan terperinci..."
                                  maxlength="2000"
                                  required>{{ old('penerangan') }}</textarea>
                        @error('penerangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Maksimum 2000 aksara. Sila berikan maklumat yang terperinci untuk membantu kami memahami masalah anda.</div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="langkah_diambil" class="form-label">Langkah Yang Telah Diambil</label>
                        <textarea class="form-control @error('langkah_diambil') is-invalid @enderror" 
                                  id="langkah_diambil" 
                                  name="langkah_diambil" 
                                  rows="3"
                                  placeholder="Nyatakan langkah-langkah yang telah anda cuba untuk menyelesaikan masalah ini (jika ada)..."
                                  maxlength="1000">{{ old('langkah_diambil') }}</textarea>
                        @error('langkah_diambil')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Maksimum 1000 aksara (pilihan)</div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="lampiran" class="form-label">Lampiran</label>
                        <input type="file" 
                               class="form-control @error('lampiran') is-invalid @enderror" 
                               id="lampiran" 
                               name="lampiran[]" 
                               multiple
                               accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.txt">
                        @error('lampiran')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            Format yang dibenarkan: JPG, PNG, PDF, DOC, DOCX, TXT. Maksimum 5MB setiap fail. Maksimum 3 fail.
                        </div>
                        <div id="file-preview" class="mt-2"></div>
                    </div>
                    
                    <div class="mb-4">
                        <div class="form-check">
                            <input class="form-check-input @error('pengesahan') is-invalid @enderror" 
                                   type="checkbox" 
                                   id="pengesahan" 
                                   name="pengesahan" 
                                   value="1"
                                   {{ old('pengesahan') ? 'checked' : '' }}
                                   required>
                            <label class="form-check-label" for="pengesahan">
                                Saya mengesahkan bahawa maklumat yang diberikan adalah benar dan tepat. <span class="text-danger">*</span>
                            </label>
                            @error('pengesahan')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('pemohon.helpdesk.senarai') }}" class="btn btn-secondary">
                            <i class="bi bi-x-circle me-2"></i>Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-send me-2"></i>Hantar Tiket
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <!-- Panduan Helpdesk -->
        <div class="card mb-4">
            <div class="card-header">
                <h6 class="card-title mb-0">
                    <i class="bi bi-info-circle me-2"></i>Panduan Helpdesk
                </h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <h6 class="text-primary">Sebelum Menghantar Tiket:</h6>
                    <ul class="list-unstyled small">
                        <li class="mb-1"><i class="bi bi-check-circle text-success me-2"></i>Semak FAQ untuk jawapan pantas</li>
                        <li class="mb-1"><i class="bi bi-check-circle text-success me-2"></i>Cuba langkah penyelesaian asas</li>
                        <li class="mb-1"><i class="bi bi-check-circle text-success me-2"></i>Sediakan maklumat yang terperinci</li>
                    </ul>
                </div>
                
                <div class="mb-3">
                    <h6 class="text-primary">Masa Respons:</h6>
                    <ul class="list-unstyled small">
                        <li class="mb-1"><span class="badge bg-danger me-2">Kritikal</span>1-2 jam</li>
                        <li class="mb-1"><span class="badge bg-warning me-2">Tinggi</span>4-6 jam</li>
                        <li class="mb-1"><span class="badge bg-info me-2">Sederhana</span>1-2 hari</li>
                        <li class="mb-1"><span class="badge bg-secondary me-2">Rendah</span>3-5 hari</li>
                    </ul>
                </div>
                
                <div>
                    <h6 class="text-primary">Hubungi Kami:</h6>
                    <p class="small mb-1">
                        <i class="bi bi-telephone me-2"></i>03-1234 5678
                    </p>
                    <p class="small mb-0">
                        <i class="bi bi-envelope me-2"></i>support@jdn.gov.my
                    </p>
                </div>
            </div>
        </div>
        
        <!-- FAQ Ringkas -->
        <div class="card">
            <div class="card-header">
                <h6 class="card-title mb-0">
                    <i class="bi bi-question-circle me-2"></i>Soalan Lazim
                </h6>
            </div>
            <div class="card-body">
                <div class="accordion accordion-flush" id="faqAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" 
                                    data-bs-toggle="collapse" data-bs-target="#faq1">
                                Bagaimana untuk semak status permohonan?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body small">
                                Anda boleh semak status permohonan di bahagian "Senarai Permohonan" dalam dashboard anda.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" 
                                    data-bs-toggle="collapse" data-bs-target="#faq2">
                                Masalah muat naik dokumen?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body small">
                                Pastikan fail tidak melebihi 5MB dan dalam format yang dibenarkan (PDF, JPG, PNG, DOC).
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" 
                                    data-bs-toggle="collapse" data-bs-target="#faq3">
                                Lupa kata laluan?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body small">
                                Klik "Lupa Kata Laluan" di halaman log masuk dan ikuti arahan yang diberikan.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // File upload preview
        const fileInput = document.getElementById('lampiran');
        const filePreview = document.getElementById('file-preview');
        
        fileInput.addEventListener('change', function() {
            filePreview.innerHTML = '';
            
            if (this.files.length > 3) {
                alert('Maksimum 3 fail sahaja dibenarkan.');
                this.value = '';
                return;
            }
            
            Array.from(this.files).forEach((file, index) => {
                if (file.size > 5 * 1024 * 1024) {
                    alert(`Fail "${file.name}" melebihi saiz maksimum 5MB.`);
                    this.value = '';
                    filePreview.innerHTML = '';
                    return;
                }
                
                const fileItem = document.createElement('div');
                fileItem.className = 'alert alert-info alert-dismissible fade show py-2';
                fileItem.innerHTML = `
                    <small>
                        <i class="bi bi-paperclip me-2"></i>
                        <strong>${file.name}</strong> 
                        <span class="text-muted">(${(file.size / 1024).toFixed(1)} KB)</span>
                    </small>
                    <button type="button" class="btn-close btn-close-sm" 
                            onclick="removeFile(${index})"></button>
                `;
                filePreview.appendChild(fileItem);
            });
        });
        
        // Character counter for textarea
        const textareas = document.querySelectorAll('textarea[maxlength]');
        textareas.forEach(textarea => {
            const maxLength = textarea.getAttribute('maxlength');
            const counter = document.createElement('div');
            counter.className = 'form-text text-end';
            counter.innerHTML = `<span id="${textarea.id}-counter">0</span>/${maxLength} aksara`;
            textarea.parentNode.appendChild(counter);
            
            textarea.addEventListener('input', function() {
                const currentLength = this.value.length;
                document.getElementById(`${this.id}-counter`).textContent = currentLength;
                
                if (currentLength > maxLength * 0.9) {
                    counter.classList.add('text-warning');
                } else {
                    counter.classList.remove('text-warning');
                }
            });
        });
        
        // Form validation
        const form = document.getElementById('helpdesk-form');
        form.addEventListener('submit', function(e) {
            const kategori = document.getElementById('kategori').value;
            const keutamaan = document.getElementById('keutamaan').value;
            const subjek = document.getElementById('subjek').value.trim();
            const penerangan = document.getElementById('penerangan').value.trim();
            const pengesahan = document.getElementById('pengesahan').checked;
            
            if (!kategori || !keutamaan || !subjek || !penerangan || !pengesahan) {
                e.preventDefault();
                alert('Sila lengkapkan semua medan yang diperlukan.');
                return false;
            }
            
            if (subjek.length < 10) {
                e.preventDefault();
                alert('Subjek mestilah sekurang-kurangnya 10 aksara.');
                return false;
            }
            
            if (penerangan.length < 20) {
                e.preventDefault();
                alert('Penerangan mestilah sekurang-kurangnya 20 aksara.');
                return false;
            }
        });
    });
    
    function removeFile(index) {
        const fileInput = document.getElementById('lampiran');
        const dt = new DataTransfer();
        
        Array.from(fileInput.files).forEach((file, i) => {
            if (i !== index) {
                dt.items.add(file);
            }
        });
        
        fileInput.files = dt.files;
        fileInput.dispatchEvent(new Event('change'));
    }
</script>
@endpush