@if ($item->status == 2)
    <a class="btn btn-sm btn-outline-primary" href="{{ route('dosen.agenda.show', ['id' => $item->id]) }}">
        Lihat
    </a>
@else
    <a class="btn btn-sm btn-primary" href="{{ route('dosen.agenda.show', ['id' => $item->id]) }}">
        Tinjau
    </a>
@endif
