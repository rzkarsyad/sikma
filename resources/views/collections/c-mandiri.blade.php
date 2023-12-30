<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $item->mahasiswa->nim }}</td>
    <td>{{ $item->mahasiswa->nama }}</td>
    <td>{{ $item->mahasiswa->prodi->nama }}</td>
    <td>{{ $item->mahasiswa->jalur->nama }}</td>
    <td>{{ $item->tingkat->nama }}</td>
    <td>{{ $item->jenis->nama }}</td>
    <td>{{ $item->nama }}</td>
    <td>{{ $item->penyelenggara }}</td>
    <td>{{ $item->jumlah }}</td>
    <td>{{ $item->tanggal_mulai }}</td>
    <td>{{ $item->tanggal_selesai }}</td>
    <td>{{ $item->url_penyelenggara }}</td>
    <td>
        @if (pathinfo($item->sertifikat, PATHINFO_EXTENSION) == 'pdf')
            <!-- Display a button to download PDF -->
            <a href="{{ asset('storage/' . $item->sertifikat) }}" class="btn btn-sm btn-primary" download>Download
                PDF</a>
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
    <td>
        @if (pathinfo($item->undangan, PATHINFO_EXTENSION) == 'pdf')
            <!-- Display a button to download PDF -->
            <a href="{{ asset('storage/' . $item->undangan) }}" class="btn btn-sm btn-primary" download>Download
                PDF</a>
        @else
            <img src="{{ asset('storage/' . $item->undangan) }}" class="rounded image-clickable" data-bs-toggle="modal"
                data-bs-target="#myModal" data-image="{{ asset('storage/' . $item->undangan) }}"
                style="width: 64px; height:40px; cursor: pointer; object-fit: cover;">
        @endif
    </td>
</tr>
