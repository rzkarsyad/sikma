<div>
    <a href="{{ route($editRouteName, ['id' => $item->id]) }}" class="btn text-mute d-inline" data-bs-toggle="tooltip"
        data-bs-placement="top" data-bs-title="Edit">
        <i class="ri-pencil-line font-size-16 me-2"></i>
    </a>
    <a href="{{ route($deleteRouteName, ['id' => $item->id]) }}" class="btn text-mute d-inline" data-bs-toggle="tooltip"
        data-bs-placement="top" data-bs-title="Hapus">
        <i class="ri-delete-bin-line font-size-16 me-2"></i>
    </a>
</div>

<script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
</script>
