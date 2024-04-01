<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Tambah Kegiatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createForm" action="{{ route('admin.prodi.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="list_jenjang">Jenjang</label>
                        <select name="id_jenjang" class="form-select @error('id_jenjang') is-invalid @enderror">
                            <option value="">Pilih Jenjang</option>
                            @foreach ($jenjang as $id => $nama)
                                <option value="{{ $id }}" {{ old('id_jenjang') == $id ? 'selected' : null }}>
                                    {{ $nama }}</option>
                            @endforeach
                        </select>
                        @error('id_jenjang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="list_fakultas">Fakultas</label>
                        <select name="id_fakultas" class="form-select @error('id_fakultas') is-invalid @enderror">
                            <option value="">Pilih Fakultas</option>
                            @foreach ($fakultas as $id => $nama)
                                <option value="{{ $id }}" {{ old('id_fakultas') == $id ? 'selected' : null }}>
                                    {{ $nama }}</option>
                            @endforeach
                        </select>
                        @error('id_fakultas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="createNama" class="form-label">Nama Program Studi</label>
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
                <h1 class="modal-title fs-5" id="editModalLabel">Edit Data Program Studi</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Program Studi</label>
                        <input type="text" class="form-control" id="nama" name="nama">
                    </div>
                    <input type="hidden" id="editItemId" name="id">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" id="submitButton">Simpan</button>
                    </div>
                </form>
            </div>
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
        });

        function fillModalData(itemId, nama) {
            const editForm = document.getElementById('editForm');
            const namaInput = document.getElementById('nama');
            const itemIdInput = document.getElementById('editItemId');

            itemIdInput.value = itemId;
            editForm.action = "{{ route('admin.prodi.update', '') }}/" + itemId;
            namaInput.value = nama;
        }

        document.addEventListener('DOMContentLoaded', function() {
            const editModal = new bootstrap.Modal(document.getElementById('editModal'));

            document.querySelectorAll('.edit-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const itemId = this.getAttribute('data-bs-id');
                    const nama = this.getAttribute('data-bs-nama');

                    fillModalData(itemId, nama);
                    editModal.show();
                });
            });

            const closeButton = document.querySelector('#editModal .btn-close');
            closeButton.addEventListener('click', function() {
                editModal.hide();
            });
        });
    </script>
@endpush
