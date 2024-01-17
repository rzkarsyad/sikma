<div class="dropdown">
    <a href="" class="text-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="ri-more-2-fill"></i>
    </a>
    <ul class="dropdown-menu dropdown-menu-end">
        <li>
            <a class="dropdown-item" href="{{ route('m.mandiri-show', ['id' => $item->id]) }}">
                <i class="ri-eye-line font-size-16 me-2"></i>
                Lihat
            </a>
        </li>
        <li>
            <form id="editForm" action="{{ route('m.mandiri-edit', ['id' => $item->id]) }}" method="GET"
                style="display: inline;">
                <button type="submit" class="btn dropdown-item">
                    <i class="ri-pencil-line font-size-16 me-2"></i>Edit
                </button>
            </form>
        </li>
        <li>
            <form id="deleteForm" action="{{ route('m.mandiri-delete', ['id' => $item->id]) }}" method="POST"
                style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="button" class="btn dropdown-item" onclick="deleteConfirmation(this)">
                    <i class="ri-delete-bin-line font-size-16 me-2"></i>Hapus
                </button>
            </form>
        </li>
    </ul>
</div>
