<td id="tooltip-container1">
    <a href="{{ route('m.aktivitas-edit', ['id' => $item->id]) }}" class="text-secondary"
        data-bs-container="#tooltip-container1" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i
            class="mdi mdi-pencil font-size-18"></i></a>
    <form action="{{ route('m.aktivitas-delete', ['id' => $item->id]) }}" method="POST" style="display: inline">
        @csrf
        @method('DELETE')
        <button type="button" class="btn text-secondary" onclick="deleteConfirmation(this)">
            <i class="mdi mdi-trash-can font-size-18"></i>
        </button>
    </form>
</td>
