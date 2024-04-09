<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Tambah Admin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createForm" action="{{ route('admin.member.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="createUsername" class="form-label">Username</label>
                        <input type="text" class="form-control @error('nim_nidn') is-invalid @enderror"
                            id="createUsername" name="nim_nidn">
                        @error('nim_nidn')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="createEmail" class="form-label">Email</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="createEmail"
                            name="email">
                        @error('email')
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

                        $('#createUsername').val('');
                        $('#createUsername').removeClass('is-invalid');

                        $('#createEmail').val('');
                        $('#createEmail').removeClass('is-invalid');

                        $('.alert-success').html(response.success).show();

                        window.location.reload();
                    },
                    error: function(xhr, status, error) {
                        var errors = xhr.responseJSON.errors;

                        $('#createUsername').removeClass('is-invalid').next('.invalid-feedback')
                            .remove();
                        $('#createEmail').removeClass('is-invalid').next('.invalid-feedback')
                            .remove();

                        if (errors) {
                            var usernameError = errors['nim_nidn'];
                            if (usernameError) {
                                $('#createUsername').addClass('is-invalid').after(
                                    '<div class="invalid-feedback">' +
                                    usernameError[0] + '</div>');
                            }

                            var emailError = errors['email'];
                            if (emailError) {
                                $('#createEmail').addClass('is-invalid').after(
                                    '<div class="invalid-feedback">' +
                                    emailError[0] + '</div>');
                            }

                        } else {
                            console.error('Error occurred:', error);
                        }

                        $('#createModal').modal('show');
                    }
                });
            });

            $('#createModal').on('hidden.bs.modal', function() {
                $(this).find('.is-invalid').removeClass('is-invalid');
                $(this).find('.invalid-feedback').remove();
            });

            $('input').on('input', function() {
                $(this).removeClass('is-invalid').next('.invalid-feedback').remove();
            });
        });
    </script>
@endpush
