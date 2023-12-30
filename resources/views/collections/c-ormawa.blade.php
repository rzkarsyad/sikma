<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $item->mahasiswa->nim }}</td>
    <td>{{ $item->mahasiswa->nama }}</td>
    <td>{{ $item->mahasiswa->prodi->nama }}</td>
    <td>{{ $item->mahasiswa->jalur->nama }}</td>
    <td>{{ $item->ormawa->nama }}</td>
    <td>{{ $item->nama_ormawa }}</td>
    <td>{{ $item->jabatan }}</td>
    <td>{{ $item->masa_jabatan }}</td>
    <td>{{ $item->url_media_ormawa }}</td>
    <td>
        @if (pathinfo($item->sk, PATHINFO_EXTENSION) == 'pdf')
            <a href="{{ asset('storage/' . $item->sk) }}" class="btn btn-sm btn-primary" target="_blank">Lihat Berkas</a>
        @else
            <img src="{{ asset('storage/' . $item->sk) }}" class="rounded image-clickable" data-bs-toggle="modal"
                data-bs-target="#myModal" data-image="{{ asset('storage/' . $item->sk) }}"
                style="width: 64px; height:40px; cursor: pointer; object-fit: cover;">
        @endif
    </td>
</tr>
