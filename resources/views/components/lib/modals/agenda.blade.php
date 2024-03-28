<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Create Data Agenda</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createForm" action="{{ route('admin.agenda.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="createNama" class="form-label">Nama Agenda</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="createNama"
                            name="nama">
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" id="submitButton">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editModalLabel">Edit Data Agenda</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Agenda</label>
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
        document.addEventListener('DOMContentLoaded', function() {
            const createModal = new bootstrap.Modal(document.getElementById('createModal'));


            @if (session()->has('errors'))
                createModal.show();
            @endif

            const createForm = document.getElementById('createForm');
            createForm.addEventListener('submit', function(event) {
                if (!this.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                } else {

                    this.classList.add('was-validated');
                }
            });

            const closeButton = document.querySelector('#createModal .btn-close');
            closeButton.addEventListener('click', function(event) {

                if (!createForm.classList.contains('was-validated')) {
                    createModal.hide();
                } else {
                    event.preventDefault();
                }
            });

            createModal.addEventListener('hidden.bs.modal', function() {
                createForm.classList.remove('was-validated');
            });
        });
    </script>


    <script>
        function fillModalData(itemId, nama) {
            const editForm = document.getElementById('editForm');
            const namaInput = document.getElementById('nama');
            const itemIdInput = document.getElementById('editItemId');

            itemIdInput.value = itemId;
            editForm.action = "{{ route('admin.agenda.update', '') }}/" + itemId;
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
