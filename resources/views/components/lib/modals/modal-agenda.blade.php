<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Tambah Agenda</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createForm" action="{{ route('admin.agenda.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="createNama" class="form-label">Nama Tipe Agenda</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="createNama"
                            name="nama">
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" id="submitBtn">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Agenda</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" action="{{ route('admin.agenda.update', '') }}" method="POST">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="editItemId" id="editItemId">
                    <div class="mb-3">
                        <label for="editNama" class="form-label">Nama Tipe Agenda</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="editNama"
                            name="nama">
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" id="submitBtn">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#createForm').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#createModal').modal('hide');
                        $('#createNama').val('');
                        $('#createNama').removeClass('is-invalid');
                        $('.alert-success').html(response.success).show();
                        window.location.reload();
                    },
                    error: function(xhr, status, error) {
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            var inputField = $('#createNama');
                            inputField.addClass('is-invalid');
                            inputField.next('.invalid-feedback').remove();
                            inputField.after('<div class="invalid-feedback">' + value[
                                0] + '</div>');
                        });
                    }
                });
            });


            const editModal = document.getElementById('editModal');

            editModal.addEventListener('show.bs.modal', event => {
                const button = event.relatedTarget;
                const id = button.getAttribute('data-bs-id');
                const nama = button.getAttribute('data-bs-nama');

                const editItemId = document.getElementById('editItemId');
                const editNama = document.getElementById('editNama');

                editItemId.value = id;
                editNama.value = nama;
            });

            $('#editForm').submit(function(e) {
                e.preventDefault();

                const actionUrl = "{{ route('admin.agenda.update', '') }}/" + $('#editItemId').val();

                $.ajax({
                    type: "POST",
                    url: actionUrl,
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#editModal').modal('hide');

                        $('#editNama').val('');
                        $('#editNama').removeClass('is-invalid');

                        $('.alert-success').html(response.success).show();

                        window.location.reload();
                    },
                    error: function(xhr, status, error) {
                        var errors = xhr.responseJSON.errors;

                        $('#editNama').removeClass('is-invalid').next('.invalid-feedback')
                            .remove();

                        if (errors) {
                            var namaError = errors['nama'];
                            if (namaError) {
                                $('#editNama').addClass('is-invalid').after(
                                    '<div class="invalid-feedback">' +
                                    namaError + '</div>');
                            }
                        } else {
                            console.error('Error occurred:', error);
                        }

                        $('#editModal').modal('show');
                    }
                });
            });

            $('#createModal').on('hidden.bs.modal', function() {
                $(this).find('.is-invalid').removeClass('is-invalid');
                $(this).find('.invalid-feedback').remove();
            });

            $('#editModal').on('hidden.bs.modal', function() {
                $(this).find('.is-invalid').removeClass('is-invalid');
                $(this).find('.invalid-feedback').remove();
            });

            $('input').on('input', function() {
                $(this).removeClass('is-invalid').next('.invalid-feedback').remove();
            });

        });
    </script>
@endpush
