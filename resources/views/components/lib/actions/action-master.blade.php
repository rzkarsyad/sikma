<div>
    <button type="button" class="btn text-muted d-inline edit-btn" data-bs-toggle="modal" data-bs-target="#editModal"
        data-bs-id="{{ $item->id }}" data-bs-jenjang="{{ $item->id_jenjang }}"
        data-bs-fakultas="{{ $item->id_fakultas }}" data-bs-nama="{{ $item->nama }}"
        onclick="fillModalData('{{ $item->id }}', '{{ $item->id_jenjang }}', '{{ $item->id_fakultas }}', '{{ $item->nama }}')">
        <i class="ri-pencil-line font-size-16 me-2"></i>
    </button>

    <form id="deleteForm" action="{{ route($deleteRouteName, ['id' => $item->id]) }}" method="POST"
        style="display: inline;">
        @csrf
        @method('DELETE')
        <button type="button" class="btn text-muted d-inline" onclick="deleteConfirmation(this)">
            <i class="ri-delete-bin-line font-size-16 me-2"></i>
        </button>
    </form>
</div>
