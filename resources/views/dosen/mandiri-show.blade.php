@extends('layouts.main')
@section('title')
    Detail Mandiri
@endsection

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Detail Kegiatan Mandiri</h4>
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
                                <h5>Informasi Kegiatan</h5>
                                <div class="col mt-4">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td class="w-25 align-middle text-primary"><strong>Tingkat Kegiatan</strong>
                                                </td>
                                                <td class="align-middle">:</td>
                                                <td class="align-middle">
                                                    {{ $mhsKegiatan->tingkat->nama }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="align-middle text-primary"><strong>Jenis Kegiatan</strong></td>
                                                <td class="align-middle">:</td>
                                                <td class="align-middle">
                                                    {{ $mhsKegiatan->jenis->nama }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="align-middle text-primary"><strong>Nama Kegiatan</strong></td>
                                                <td class="align-middle">:</td>
                                                <td class="align-middle">
                                                    {{ $mhsKegiatan->nama }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="align-middle text-primary"><strong>Penyelenggara</strong></td>
                                                <td class="align-middle">:</td>
                                                <td class="align-middle">
                                                    {{ $mhsKegiatan->penyelenggara }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="align-middle text-primary"><strong>Jumlah Peserta</strong></td>
                                                <td class="align-middle">:</td>
                                                <td class="align-middle">
                                                    {{ $mhsKegiatan->jumlah }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="align-middle text-primary"><strong>Tanggal Kegiatan</strong></td>
                                                <td class="align-middle">:</td>
                                                <td class="align-middle">{{ $tgl_mulai }} - {{ $tgl_selesai }}</td>
                                            </tr>
                                            <tr>
                                                <td class="align-middle text-primary"><strong>Sertifikat</strong></td>
                                                <td class="align-middle">:</td>
                                                <td class="align-middle">
                                                    @if (pathinfo($mhsKegiatan->sertifikat, PATHINFO_EXTENSION) == 'pdf')
                                                        <a href="{{ asset('storage/' . $mhsKegiatan->sertifikat) }}"
                                                            class="btn btn-sm btn-primary" target="_blank">Lihat Berkas</a>
                                                    @else
                                                        @include('components.lib.img-thumbnail', [
                                                            'thumb_path' => $mhsKegiatan->sertifikat,
                                                        ])
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="align-middle text-primary"><strong>Foto</strong></td>
                                                <td class="align-middle">:</td>
                                                <td class="align-middle">
                                                    @include('components.lib.img-thumbnail', [
                                                        'thumb_path' => $mhsKegiatan->foto,
                                                    ])
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="align-middle text-primary"><strong>Undangan</strong></td>
                                                <td class="align-middle">:</td>
                                                <td class="align-middle">
                                                    @if (pathinfo($mhsKegiatan->undangan, PATHINFO_EXTENSION) == 'pdf')
                                                        <a href="{{ asset('storage/' . $mhsKegiatan->undangan) }}"
                                                            class="btn btn-sm btn-primary" target="_blank">Lihat Berkas</a>
                                                    @else
                                                        @include('components.lib.img-thumbnail', [
                                                            'thumb_path' => $mhsKegiatan->undangan,
                                                        ])
                                                    @endif
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
