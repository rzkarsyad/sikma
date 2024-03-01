<form id="resetPassForm" action="{{ route('admin.reset.password', ['id' => $item->user_id]) }}" method="POST">
    @csrf
    @method('POST')
    <button type="button" class="btn btn-sm btn-outline-primary" onclick="resetConfirmation(this)">
        <i class="ri-lock-password-line font-size-16 me-2"></i>Reset Password
    </button>
</form>
