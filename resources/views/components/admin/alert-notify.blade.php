@if (session('error'))
    <div class="toast show bg-danger" role="alert" aria-live="assertive" aria-atomic="true" id="notification" style="margin-right:20px">
        <div class="toast-header">
            <i class="ki-duotone ki-abstract-39 fs-2s text-primary me-3"><span class="path1"></span><span
                    class="path2"></span></i>
            <strong class="me-auto">Thông báo</strong>

            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            {{ session('error') }}
        </div>
    </div>
@endif
@if (session('success'))
    <div class="toast show bg-success" role="alert" aria-live="assertive" aria-atomic="true" id="notification" style="margin-right:20px">
        <div class="toast-header">
            <i class="ki-duotone ki-abstract-39 fs-2s text-primary me-3"><span class="path1"></span><span
                    class="path2"></span></i>
            <strong class="me-auto">Thông báo</strong>

            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            {{ session('success') }}
        </div>
    </div>
@endif

