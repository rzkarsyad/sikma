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
                        <h4 class="mb-sm-0">Aktivitas Mahasiswa</h4>
                        <a href="{{ route('m.aktivitas-create') }}" class="btn btn-primary">+ Tambah Aktivitas</a>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif


                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Data Aktivitas</h4>
                                    <p class="card-title-desc">Tabel ini berisi seluruh kegiatan aktivitas dari kampus yang
                                        diikuti oleh mahasiswa.
                                    </p>
                                    <table id="example" class="table dt-responsive nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Kegiatan</th>
                                                <th>Kategori</th>
                                                <th>Tahun</th>
                                                <th>Sertifikat</th>
                                                <th>Foto</th>
                                                <th>URL Penyelenggara</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($mhsAktivitas as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->kegiatan->nama }}</td>
                                                    <td>{{ $item->kategori->nama }}</td>
                                                    <td>{{ $item->tahun }}</td>
                                                    <td>
                                                        @if (pathinfo($item->sertifikat, PATHINFO_EXTENSION) == 'pdf')
                                                            <!-- Display a button to download PDF -->
                                                            <a href="{{ asset('storage/' . $item->sertifikat) }}"
                                                                class="btn btn-primary" download>Download PDF</a>
                                                        @else
                                                            <img src="{{ asset('storage/' . $item->sertifikat) }}"
                                                                class="rounded image-clickable" data-bs-toggle="modal"
                                                                data-bs-target="#myModal"
                                                                data-image="{{ asset('storage/' . $item->sertifikat) }}"
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
                                                    <td>{{ $item->url_penyelenggara }}</td>
                                                    <td id="tooltip-container1">
                                                        <a href="{{ route('m.aktivitas-edit', ['id' => $item->id]) }}"
                                                            class="text-secondary" data-bs-container="#tooltip-container1"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Edit"><i class="mdi mdi-pencil font-size-18"></i></a>
                                                        <form
                                                            action="{{ route('m.aktivitas-delete', ['id' => $item->id]) }}"
                                                            method="POST" style="display: inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn text-secondary"
                                                                onclick="deleteConfirmation(this)">
                                                                <i class="mdi mdi-trash-can font-size-18"></i>
                                                            </button>
                                                        </form>
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
