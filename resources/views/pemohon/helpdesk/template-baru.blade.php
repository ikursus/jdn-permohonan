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
                            <label for="category" class="form-label">Kategori <span class="text-danger">*</span></label>
                            <select class="form-select @error('category') is-invalid @enderror" 
                                    id="category" name="category" required>
                                <option value="">Pilih Kategori</option>
                                <option value="General" {{ old('category') == 'General' ? 'selected' : '' }}>General</option>
                                <option value="Technical" {{ old('category') == 'Technical' ? 'selected' : '' }}>Technical</option>
                                <option value="Application" {{ old('category') == 'Application' ? 'selected' : '' }}>Application</option>
                                <option value="Document" {{ old('category') == 'Document' ? 'selected' : '' }}>Document</option>
                                <option value="Account" {{ old('category') == 'Account' ? 'selected' : '' }}>Account</option>
                            </select>
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="priority" class="form-label">Tahap Keutamaan <span class="text-danger">*</span></label>
                            <select class="form-select @error('priority') is-invalid @enderror" 
                                    id="priority" name="priority" required>
                                <option value="">Pilih Keutamaan</option>
                                <option value="Low" {{ old('priority') == 'Low' ? 'selected' : '' }}>Low</option>
                                <option value="Medium" {{ old('priority') == 'Medium' ? 'selected' : '' }}>Medium</option>
                                <option value="High" {{ old('priority') == 'High' ? 'selected' : '' }}>High</option>
                                <option value="Urgent" {{ old('priority') == 'Urgent' ? 'selected' : '' }}>Urgent</option>
                            </select>
                            @error('priority')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="subject" class="form-label">Subjek <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('subject') is-invalid @enderror" 
                               id="subject" 
                               name="subject" 
                               value="{{ old('subject') }}"
                               placeholder="Masukkan subjek tiket anda"
                               maxlength="200"
                               required>
                        @error('subject')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Maksimum 200 aksara</div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Penerangan Masalah <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" 
                                  name="description" 
                                  rows="6"
                                  placeholder="Terangkan masalah atau pertanyaan anda dengan terperinci..."
                                  maxlength="2000"
                                  required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Maksimum 2000 aksara. Sila berikan maklumat yang terperinci untuk membantu kami memahami masalah anda.</div>
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
            const category = document.getElementById('category').value;
            const priority = document.getElementById('priority').value;
            const subject = document.getElementById('subject').value.trim();
            const description = document.getElementById('description').value.trim();
            const pengesahan = document.getElementById('pengesahan').checked;
            
            if (!category || !priority || !subject || !description || !pengesahan) {
                e.preventDefault();
                alert('Sila lengkapkan semua medan yang diperlukan.');
                return false;
            }
            
            if (subject.length < 10) {
                e.preventDefault();
                alert('Subjek mestilah sekurang-kurangnya 10 aksara.');
                return false;
            }
            
            if (description.length < 20) {
                e.preventDefault();
                alert('Penerangan mestilah sekurang-kurangnya 20 aksara.');
                return false;
            }
        });
    });
</script>
@endpush