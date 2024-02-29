@extends('layouts.main')
@section('title')
    Detail Aktivitas
@endsection

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Detail Aktivitas</h4>
                    </div>
                    <div class="card">
                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-3">
                                <div class="d-flex align-items-center justify-content-center">
                                    <a href="javascript:history.back()" class="text-dark">
                                        <i class="ri-arrow-left-line font-size-24"></i>
                                    </a>
                                    <h4 class="ms-2 my-auto w-100 overflow-hidden" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="{{ $mahasiswa->nama }}">
                                        {!! strlen($mahasiswa->nama) > 100 ? substr($mahasiswa->nama, 0, 100) . '...' : $mahasiswa->nama !!}
                                    </h4>
                                </div>
                            </div>

                            <div class="mt-4">
                                <div class="row">
                                    <div class="col-md mt-3">
                                        <table class="table">
                                            <tr>
                                                <td class="text-primary fw-bold">Mahasiswa</td>
                                                <td>{{ $mahasiswa->nim }} - {{ $mahasiswa->nama }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-primary fw-bold">Angkatan</td>
                                                <td>{{ $mahasiswa->tahun_masuk }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md mt-3">
                                        <table class="table">
                                            <tr>
                                                <td class="text-primary fw-bold">Program Studi</td>
                                                <td>{{ $mahasiswa->prodi->nama }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-primary fw-bold">Jalur Masuk</td>
                                                <td>{{ $mahasiswa->jalur->nama }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4">
                                <h5>Informasi Aktivitas</h5>
                                <div class="col mt-4">

                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td class="w-25 align-middle text-primary"><strong>Nama Kegiatan</strong>
                                                </td>
                                                <td class="align-middle">:</td>
                                                <td class="align-middle">
                                                    {{ $mhsAktivitas->kegiatan->nama }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="align-middle text-primary"><strong>Tingkat</strong></td>
                                                <td class="align-middle">:</td>
                                                <td class="align-middle">
                                                    {{ $mhsAktivitas->kategori->nama }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="align-middle text-primary"><strong>Tahun</strong></td>
                                                <td class="align-middle">:</td>
                                                <td class="align-middle">
                                                    {{ $mhsAktivitas->tahun }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="align-middle text-primary"><strong>Sertifikat</strong></td>
                                                <td class="align-middle">:</td>
                                                <td class="align-middle">
                                                    @if (pathinfo($mhsAktivitas->sertifikat, PATHINFO_EXTENSION) == 'pdf')
                                                        @include('components.lib.buttons.btn-view-file', [
                                                            'path' => $mhsAktivitas->sertifikat,
                                                        ])
                                                    @else
                                                        @include('components.lib.thumbnails.img', [
                                                            'path' => $mhsAktivitas->sertifikat,
                                                        ])
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="align-middle text-primary"><strong>Foto</strong></td>
                                                <td class="align-middle">:</td>
                                                <td class="align-middle">
                                                    @include('components.lib.thumbnails.img', [
                                                        'path' => $mhsAktivitas->foto,
                                                    ])
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="align-middle text-primary"><strong>URL Penyelenggara</strong>
                                                </td>
                                                <td class="align-middle">:</td>
                                                <td class="align-middle">
                                                    <a href="{{ $url }}" target="_blank"
                                                        class="text-decoration-underline">{{ $url }}</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->
    </div>
    </div>

    @include('components.lib.modal-img')
@endsection
