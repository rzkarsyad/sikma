@extends('layouts.main')
@section('title')
    Aktivitas Mahasiswa
@endsection

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Kegiatan Organisasi Mahasiswa</h4>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Data Kegiatan Organisasi</h4>
                                    <p class="card-title-desc">Tabel ini berisi seluruh kegiatan organisasi atau UKM yang
                                        diikuti oleh mahasiswa.
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
                                                <th>Jenis Organisasi</th>
                                                <th>Nama Organisasi</th>
                                                <th>Jabatan</th>
                                                <th>Masa Jabatan</th>
                                                <th>URL Sosial Media Ormawa</th>
                                                <th>SK Kepengurusan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($ormawa as $item)
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
                                                        <img src="{{ asset('storage/' . $item->sk) }}"
                                                            class="rounded image-clickable" data-bs-toggle="modal"
                                                            data-bs-target="#myModal"
                                                            data-image="{{ asset('storage/' . $item->sk) }}"
                                                            style="width: 64px; cursor: pointer;">
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
