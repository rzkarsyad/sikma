<div class="modal fade download-modal" id="downloadModal" tabindex="-1" aria-labelledby="downloadModalLabel"
    aria-hidden="true">
    <div class="modal-dialog w-600">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="downloadModalLabel">Unduh PDF</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col mb-4">
                    <p class="h4">Rekap Data Agenda</p>
                    <p class="text-mute">Pilih data agenda yang akan diunduh</p>
                </div>
                <div class="row g-3 justify-content-start">
                    @include('components.lib.filters.filter-download-agenda')
                </div>
                @include('components.lib.chip-download-filter')

                <div class="alert alert-warning" role="alert" id="downloadInfoAlert">
                    <i class="fas fa-info-circle me-2"></i>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                <a href="{{ route('dosen.agenda.pdf') }}" class="btn btn-primary">Unduh Berkas</a>
            </div>
        </div>
    </div>
</div>

<script>
    const downloadModal = document.getElementById('downloadModal');
    if (downloadModal) {
        downloadModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            const title = button.getAttribute('data-bs-title');
            const fileFormat = button.getAttribute('data-bs-file');
            const modalTitle = downloadModal.querySelector('.modal-title');
            const alertElement = document.getElementById('downloadInfoAlert');
            modalTitle.textContent = title;

            let fileName = '';
            let route = '';
            switch (fileFormat) {
                case 'pdf':
                    fileName = '.pdf';
                    route = '{{ route('dosen.agenda.pdf') }}';
                    break;
                case 'xlsx':
                    fileName = '.xlsx';
                    break;
                default:
                    break;
            }

            alertElement.innerHTML =
                `<i class="fas fa-info-circle me-2"></i> Format berkas yang akan diunduh berupa <strong>${fileName}</strong>.`;

            const downloadButton = downloadModal.querySelector(
                '.btn-download');
            downloadButton.addEventListener('click', function() {
                window.location.href = route;
            });
        });
    }
</script>
