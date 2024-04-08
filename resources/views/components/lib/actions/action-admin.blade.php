<div>
    <form id="resetPassForm" action="{{ route('admin.reset.password', ['id' => $item->id]) }}" method="POST"
        style="display: inline;">
        @csrf
        @method('POST')
        <button type="button" class="btn text-muted d-inline" onclick="resetConfirmation(this)">
            <i class="ri-lock-password-line font-size-16"></i>
        </button>
    </form>

    @if (Auth::user()->id != $item->id)
        <form id="deleteForm" action="{{ route('admin.member.delete', ['id' => $item->id]) }}" method="POST"
            style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="button" class="btn text-muted d-inline" onclick="deleteConfirmation(this)">
                <i class="ri-delete-bin-line font-size-16"></i>
            </button>
        </form>
    @endif
</div>
