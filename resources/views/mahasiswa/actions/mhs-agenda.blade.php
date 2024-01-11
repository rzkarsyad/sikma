<td id="tooltip-container1">
    <a href="{{ route('m.agenda-show', ['id' => $item->id]) }}" class="text-secondary me-3"
        data-bs-container="#tooltip-container1" data-bs-toggle="tooltip" data-bs-placement="top" title="Show">
        <i class="mdi mdi-eye font-size-18"></i>
    </a>
    <a href="{{ route('m.agenda-edit', ['id' => $item->id]) }}" class="text-secondary"
        data-bs-container="#tooltip-container1" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
        <i class="mdi mdi-pencil font-size-18"></i>
    </a>
    <form action="{{ route('m.agenda-delete', ['id' => $item->id]) }}" method="POST" style="display: inline">
        @csrf
        @method('DELETE')
        <button type="button" class="btn text-secondary" onclick="deleteConfirmation(this)">
            <i class="mdi mdi-trash-can font-size-18"></i>
        </button>
    </form>
</td>
