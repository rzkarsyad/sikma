@extends('layouts.main')
@section('title')
    Prestasi
@endsection

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Prestasi</h4>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Data Prestasi</h4>
                                    <p class="card-title-desc">Tabel ini berisi seluruh prestasi yang diperoleh mahasiswa.
                                    </p>
                                    <table id="example" class="table dt-responsive nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>NIM</th>
                                                <th>Nama Mahasiswa</th>
                                                <th>Prodi</th>
                                                <th>Jalur Masuk</th>
                                                <th>Tingkat</th>
                                                <th>Nama Kegiatan</th>
                                                <th>Penyelenggara</th>
                                                <th>Jumlah Peserta</th>
                                                <th>Capaian</th>
                                                <th>Tgl Mulai</th>
                                                <th>Tgl Selesai</th>
                                                <th>URL Penyelenggara</th>
                                                <th>Tropi</th>
                                                <th>Foto</th>
                                                <th>Surat Undangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($prestasi as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->mahasiswa->nim }}</td>
                                                    <td>{{ $item->mahasiswa->nama }}</td>
                                                    <td>{{ $item->mahasiswa->prodi->nama }}</td>
                                                    <td>{{ $item->mahasiswa->jalur->nama }}</td>
                                                    <td>{{ $item->tingkat->nama }}</td>
                                                    <td>{{ $item->nama }}</td>
                                                    <td>{{ $item->penyelenggara }}</td>
                                                    <td>{{ $item->jumlah }}</td>
                                                    <td>{{ $item->capaian }}</td>
                                                    <td>{{ $item->tanggal_mulai }}</td>
                                                    <td>{{ $item->tanggal_selesai }}</td>
                                                    <td>{{ $item->url_penyelenggara }}</td>
                                                    <td>
                                                        @if (pathinfo($item->tropi, PATHINFO_EXTENSION) == 'pdf')
                                                            <!-- Display a button to download PDF -->
                                                            <a href="{{ asset('storage/' . $item->tropi) }}"
                                                                class="btn btn-primary" download>Download PDF</a>
                                                        @else
                                                            <img src="{{ asset('storage/' . $item->tropi) }}"
                                                                class="rounded image-clickable" data-bs-toggle="modal"
                                                                data-bs-target="#myModal"
                                                                data-image="{{ asset('storage/' . $item->tropi) }}"
                                                                style="width: 64px; height:40px; cursor: pointer; object-fit: cover;">
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <img src="{{ asset('storage/' . $item->foto) }}"
                                                            class="rounded image-clickable" data-bs-toggle="modal"
                                                            data-bs-target="#myModal"
                                                            data-image="{{ asset('storage/' . $item->foto) }}"
                                                            style="width: 64px; height:40px; cursor: pointer; object-fit: cover;">
                                                    </td>
                                                    <td>
                                                        @if (pathinfo($item->undangan, PATHINFO_EXTENSION) == 'pdf')
                                                            <!-- Display a button to download PDF -->
                                                            <a href="{{ asset('storage/' . $item->undangan) }}"
                                                                class="btn btn-primary" download>Download PDF</a>
                                                        @else
                                                            <img src="{{ asset('storage/' . $item->undangan) }}"
                                                                class="rounded image-clickable" data-bs-toggle="modal"
                                                                data-bs-target="#myModal"
                                                                data-image="{{ asset('storage/' . $item->undangan) }}"
                                                                style="width: 64px; height:40px; cursor: pointer; object-fit: cover;">
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div>
                </div>
            </div>
            <!-- end page title -->
        </div>
    </div>

    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Lihat Gambar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img id="modalImage" src="" class="img-fluid w-100">
                </div>
            </div>
        </div>
    </div>
@endsection
