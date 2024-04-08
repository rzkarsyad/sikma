@if (Session::has('error'))
    <div class="toast-container position-fixed top-0 end-0 p-3">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <i class="ri-close-circle-fill font-size-20 me-2"></i>
                <strong class="me-auto">Gagal</strong>
                <small>Baru saja</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{ Session::get('error') }}
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var toastEl = document.querySelector('.toast')
                var toast = new bootstrap.Toast(toastEl)
                toast.show()
            });
        </script>
    @endpush
@endif
