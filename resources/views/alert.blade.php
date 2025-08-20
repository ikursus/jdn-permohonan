@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert" style="border: none; border-radius: 0.75rem; background-color: #d1fae5; color: #065f46; border-left: 4px solid #10b981;">
        <i class="bi bi-check-circle-fill me-3 fs-5"></i>
        <div class="flex-grow-1">
            <strong>Berjaya!</strong> {{ session('success') }}
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert" style="border: none; border-radius: 0.75rem; background-color: #fee2e2; color: #991b1b; border-left: 4px solid #ef4444;">
        <i class="bi bi-exclamation-circle-fill me-3 fs-5"></i>
        <div class="flex-grow-1">
            <strong>Ralat!</strong> {{ session('error') }}
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('warning'))
    <div class="alert alert-warning alert-dismissible fade show d-flex align-items-center" role="alert" style="border: none; border-radius: 0.75rem; background-color: #fef3c7; color: #92400e; border-left: 4px solid #f59e0b;">
        <i class="bi bi-exclamation-triangle-fill me-3 fs-5"></i>
        <div class="flex-grow-1">
            <strong>Amaran!</strong> {{ session('warning') }}
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('info'))
    <div class="alert alert-info alert-dismissible fade show d-flex align-items-center" role="alert" style="border: none; border-radius: 0.75rem; background-color: #dbeafe; color: #1e40af; border-left: 4px solid #3b82f6;">
        <i class="bi bi-info-circle-fill me-3 fs-5"></i>
        <div class="flex-grow-1">
            <strong>Maklumat:</strong> {{ session('info') }}
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif