<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $item->mahasiswa->nim }}</td>
    <td>{{ $item->mahasiswa->nama }}</td>
    <td>{{ $item->mahasiswa->prodi->nama }}</td>
    <td>{{ $item->mahasiswa->jalur->nama }}</td>
    <td>{{ $item->kegiatan->nama }}</td>
    <td>{{ $item->kategori->nama }}</td>
    <td>{{ $item->tahun }}</td>
    <td>
        @if (pathinfo($item->sertifikat, PATHINFO_EXTENSION) == 'pdf')
            <a href="{{ asset('storage/' . $item->sertifikat) }}" class="btn btn-sm btn-primary" target="_blank">Lihat Berkas</a>
        @else
            <img src="{{ asset('storage/' . $item->sertifikat) }}" class="rounded image-clickable" data-bs-toggle="modal"
                data-bs-target="#myModal" data-image="{{ asset('storage/' . $item->sertifikat) }}"
                style="width: 64px; height:40px; cursor: pointer; object-fit: cover;">
        @endif
    </td>
    <td>
        <img src="{{ asset('storage/' . $item->foto) }}" class="rounded image-clickable" data-bs-toggle="modal"
            data-bs-target="#myModal" data-image="{{ asset('storage/' . $item->foto) }}"
            style="width: 64px; height:40px; cursor: pointer; object-fit: cover;">
    </td>
    <td>{{ $item->url_penyelenggara }}</td>
</tr>
