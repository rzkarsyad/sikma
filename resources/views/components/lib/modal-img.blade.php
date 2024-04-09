<div class="modal fade" id="imgModal" tabindex="-1" aria-labelledby="imgModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imgModalLabel">Lihat Gambar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img id="modalImage" src="" class="img-fluid w-100">
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var imgModal = new bootstrap.Modal(document.getElementById('imgModal'));

            $(document).on('click', '.image-clickable', function() {
                var imageSrc = $(this).data('image');
                $('#modalImage').attr('src', imageSrc);
                imgModal.show();
            });
        });
    </script>
@endpush
