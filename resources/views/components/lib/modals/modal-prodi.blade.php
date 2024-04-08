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
                        <select name="id_jenjang" id="createJenjang"
                            class="form-select @error('id_jenjang') is-invalid @enderror">
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
                        <select name="id_fakultas" id="createFakultas"
                            class="form-select @error('id_fakultas') is-invalid @enderror">
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
                <button type="button" class="btn btn-secondary" id="cancelBtn">Batal</button>
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
                <h5 class="modal-title" id="editModalLabel">Tambah Kegiatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" action="{{ route('admin.prodi.update', $id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">
                        <label for="list_jenjang">Jenjang</label>
                        <select name="id_jenjang" id="editJenjang"
                            class="form-select @error('id_jenjang') is-invalid @enderror">
                            <option value="">Pilih Jenjang</option>
                            @foreach ($jenjang as $id => $nama)
                                <option value="{{ $id }}"
                                    {{ old('id_jenjang') == $id ? 'selected' : null }}>
                                    {{ $nama }}</option>
                            @endforeach
                        </select>
                        @error('id_jenjang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="list_fakultas">Fakultas</label>
                        <select name="id_fakultas" id="editFakultas"
                            class="form-select @error('id_fakultas') is-invalid @enderror">
                            <option value="">Pilih Fakultas</option>
                            @foreach ($fakultas as $id => $nama)
                                <option value="{{ $id }}"
                                    {{ old('id_fakultas') == $id ? 'selected' : null }}>
                                    {{ $nama }}</option>
                            @endforeach
                        </select>
                        @error('id_fakultas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="editNama" class="form-label">Nama Program Studi</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="editNama"
                            name="nama">
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="cancelBtn">Batal</button>
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

                        $('#createJenjang').val('');
                        $('#createJenjang').removeClass('is-invalid');

                        $('#createFakultas').val('');
                        $('#createFakultas').removeClass('is-invalid');

                        $('#createNama').val('');
                        $('#createNama').removeClass('is-invalid');
                        $('.alert-success').html(response.success).show();
                        window.location.reload();
                    },
                    error: function(xhr, status, error) {
                        var errors = xhr.responseJSON.errors;

                        var jenjangError = errors['id_jenjang'];
                        if (jenjangError) {
                            $('#createJenjang').addClass('is-invalid').next('.invalid-feedback')
                                .remove().end().after('<div class="invalid-feedback">' +
                                    jenjangError[0] + '</div>');
                        }

                        var fakultasError = errors['id_fakultas'];
                        if (fakultasError) {
                            $('#createFakultas').addClass('is-invalid').next(
                                '.invalid-feedback').remove().end().after(
                                '<div class="invalid-feedback">' + fakultasError[0] +
                                '</div>');
                        }

                        var namaError = errors['nama'];
                        if (namaError) {
                            $('#createNama').addClass('is-invalid').next('.invalid-feedback')
                                .remove().end().after('<div class="invalid-feedback">' +
                                    namaError[0] + '</div>');
                        }
                    }

                });
            });

            $('.edit-btn').click(function() {
                const itemId = $(this).data('bs-id');
                const jenjang = $(this).data('bs-jenjang');
                const fakultas = $(this).data('bs-fakultas');
                const nama = $(this).data('bs-nama');

                fillModalData(itemId, jenjang, fakultas, nama);
                $('#editModal').modal('show');
            });

            $('#editForm').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    type: "PUT",
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#editModal').modal('hide');

                        $('#editJenjang').val('');
                        $('#editJenjang').removeClass('is-invalid');

                        $('#editFakultas').val('');
                        $('#editFakultas').removeClass('is-invalid');

                        $('#editNama').val('');
                        $('#editNama').removeClass('is-invalid');

                        $('.alert-success').html(response.success).show();
                        window.location.reload();
                    },
                    error: function(xhr, status, error) {
                        var errors = xhr.responseJSON.errors;

                        var jenjangError = errors['id_jenjang'];
                        if (jenjangError) {
                            $('#editJenjang').addClass('is-invalid').next('.invalid-feedback')
                                .remove().end().after('<div class="invalid-feedback">' +
                                    jenjangError[0] + '</div>');
                        }

                        var fakultasError = errors['id_fakultas'];
                        if (fakultasError) {
                            $('#editFakultas').addClass('is-invalid').next(
                                '.invalid-feedback').remove().end().after(
                                '<div class="invalid-feedback">' + fakultasError[0] +
                                '</div>');
                        }

                        var namaError = errors['nama'];
                        if (namaError) {
                            $('#editNama').addClass('is-invalid').next('.invalid-feedback')
                                .remove().end().after('<div class="invalid-feedback">' +
                                    namaError[0] + '</div>');
                        }
                    }

                });
            });

            $('#cancelBtn').click(function() {
                window.location.reload();
            });
        });

        function fillModalData(itemId, jenjang, fakultas, nama) {
            const editForm = document.getElementById('editForm');
            const actionUrl = "{{ route('admin.prodi.update', '') }}/" + itemId;

            editForm.action = actionUrl;

            $('#editItemId').val(itemId);
            $('#editJenjang').val(jenjang);
            $('#editFakultas').val(fakultas);
            $('#editNama').val(nama);
        }
    </script>
@endpush
