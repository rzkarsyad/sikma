@extends('layouts.main')
@section('title')
    Detail Ormawa
@endsection

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Detail Ormawa</h4>
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
                                <h5>Informasi Organisasi / UKM</h5>
                                <div class="col mt-4">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td class="w-25 align-middle text-primary"><strong>Jenis</strong>
                                                </td>
                                                <td class="align-middle">:</td>
                                                <td class="align-middle">
                                                    {{ $mhsOrmawa->ormawa->nama }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="align-middle text-primary"><strong>Nama Organisasi / UKM</strong>
                                                </td>
                                                <td class="align-middle">:</td>
                                                <td class="align-middle">
                                                    {{ $mhsOrmawa->nama_ormawa }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="align-middle text-primary"><strong>Jabatan</strong></td>
                                                <td class="align-middle">:</td>
                                                <td class="align-middle">
                                                    {{ $mhsOrmawa->jabatan }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="align-middle text-primary"><strong>Masa Jabatan</strong></td>
                                                <td class="align-middle">:</td>
                                                <td class="align-middle">
                                                    {{ $mhsOrmawa->masa_jabatan }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="align-middle text-primary"><strong>Surat Keterangan</strong></td>
                                                <td class="align-middle">:</td>
                                                <td class="align-middle">
                                                    @if (pathinfo($mhsOrmawa->sk, PATHINFO_EXTENSION) == 'pdf')
                                                        <a href="{{ asset('storage/' . $mhsOrmawa->sk) }}"
                                                            class="btn btn-sm btn-primary" target="_blank">Lihat Berkas</a>
                                                    @else
                                                        <img src="{{ asset('storage/' . $mhsOrmawa->sk) }}"
                                                            class="rounded image-clickable" data-bs-toggle="modal"
                                                            data-bs-target="#myModal"
                                                            data-image="{{ asset('storage/' . $mhsOrmawa->sk) }}"
                                                            style="width: 120px; height: 64px; cursor: pointer; object-fit: cover;">
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="align-middle text-primary"><strong>URL Media Ormawa</strong>
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
