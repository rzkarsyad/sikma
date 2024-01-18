<div class="dropdown">
    <a href="" class="text-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="ri-more-2-fill"></i>
    </a>
    <ul class="dropdown-menu dropdown-menu-end">
        <li>
            <a class="dropdown-item" href="{{ route('dosen.agenda.show', ['id' => $item->id]) }}">
                <i class="ri-eye-line font-size-16 me-2"></i>
                Lihat
            </a>
        </li>
    </ul>
</div>
