@if (Session::has('error'))
    <div class="toast-container position-fixed top-0 end-0 p-3">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <i class="ri-close-circle-fill font-size-20 me-2 icon-danger"></i>
                <strong class="me-auto fw-bold">Gagal</strong>
                <small id="toast-time"></small>
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
                var toastEl = document.querySelector('.toast');
                var toast = new bootstrap.Toast(toastEl);
                toast.show();

                var toastTime = document.getElementById('toast-time');
                var startTime = new Date().getTime();

                function updateToastTime() {
                    var currentTime = new Date().getTime();
                    var elapsedTime = Math.floor((currentTime - startTime) / 1000);

                    var timeAgo;
                    if (elapsedTime < 5) {
                        timeAgo = 'Baru saja';
                    } else if (elapsedTime < 60) {
                        timeAgo = elapsedTime + ' detik yang lalu';
                    } else if (elapsedTime < 3600) {
                        var minutes = Math.floor(elapsedTime / 60);
                        timeAgo = minutes + ' menit yang lalu';
                    } else {
                        var hours = Math.floor(elapsedTime / 3600);
                        timeAgo = hours + ' jam yang lalu';
                    }

                    toastTime.textContent = timeAgo;
                    setTimeout(updateToastTime, 1000);
                }

                updateToastTime();
            });
        </script>
    @endpush
@endif
