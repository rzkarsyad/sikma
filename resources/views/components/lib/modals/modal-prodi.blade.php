<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Tambah Program Studi</h5>
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
                <h5 class="modal-title" id="editModalLabel">Tambah Program Studi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" action="{{ route('admin.prodi.update', $id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="editItemId" id="editItemId">
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

                        $('#createJenjang').removeClass('is-invalid').next('.invalid-feedback')
                            .remove();
                        $('#createFakultas').removeClass('is-invalid').next('.invalid-feedback')
                            .remove();
                        $('#createNama').removeClass('is-invalid').next('.invalid-feedback')
                            .remove();

                        if (errors) {
                            var jenjangError = errors['id_jenjang'];
                            if (jenjangError) {
                                $('#createJenjang').addClass('is-invalid').after(
                                    '<div class="invalid-feedback">' +
                                    jenjangError[0] + '</div>');
                            }

                            var fakultasError = errors['id_fakultas'];
                            if (fakultasError) {
                                $('#createFakultas').addClass('is-invalid').after(
                                    '<div class="invalid-feedback">' +
                                    fakultasError[0] + '</div>');
                            }

                            var namaError = errors['nama'];
                            if (namaError) {
                                $('#createNama').addClass('is-invalid').after(
                                    '<div class="invalid-feedback">' +
                                    namaError + '</div>');
                            }
                        } else {
                            console.error('Error occurred:', error);
                        }

                        $('#createModal').modal('show');
                    }
                });
            });

            const editModal = document.getElementById('editModal');

            editModal.addEventListener('show.bs.modal', event => {
                const button = event.relatedTarget;
                const id = button.getAttribute('data-bs-id');
                const jenjang = button.getAttribute('data-bs-jenjang');
                const fakultas = button.getAttribute('data-bs-fakultas');
                const nama = button.getAttribute('data-bs-nama');

                const editItemId = document.getElementById('editItemId');
                const editJenjang = document.getElementById('editJenjang');
                const editFakultas = document.getElementById('editFakultas');
                const editNama = document.getElementById('editNama');

                editItemId.value = id;
                editJenjang.value = jenjang;
                editFakultas.value = fakultas;
                editNama.value = nama;
            });

            $('#editForm').submit(function(e) {
                e.preventDefault();

                const actionUrl = "{{ route('admin.prodi.update', '') }}/" + $('#editItemId').val();

                $.ajax({
                    type: "POST",
                    url: actionUrl,
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

                        $('#editJenjang').removeClass('is-invalid').next('.invalid-feedback')
                            .remove();
                        $('#editFakultas').removeClass('is-invalid').next('.invalid-feedback')
                            .remove();
                        $('#editNama').removeClass('is-invalid').next('.invalid-feedback')
                            .remove();

                        if (errors) {
                            var jenjangError = errors['id_jenjang'];
                            if (jenjangError) {
                                $('#editJenjang').addClass('is-invalid').after(
                                    '<div class="invalid-feedback">' +
                                    jenjangError[0] + '</div>');
                            }

                            var fakultasError = errors['id_fakultas'];
                            if (fakultasError) {
                                $('#editFakultas').addClass('is-invalid').after(
                                    '<div class="invalid-feedback">' +
                                    fakultasError[0] + '</div>');
                            }

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

            $('select').on('change', function() {
                $(this).removeClass('is-invalid').next('.invalid-feedback').remove();
            });
        });
    </script>
@endpush
