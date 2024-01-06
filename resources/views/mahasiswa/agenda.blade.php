@extends('layouts.main')
@section('title')
    Agenda Mahasiswa
@endsection

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Agenda Mahasiswa</h4>
                        <a href="{{ route('m.agenda-create') }}" class="btn btn-primary">+ Tambah Agenda</a>
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
                                    <h4 class="card-title">Data Agenda</h4>
                                    <p class="card-title-desc">Tabel ini berisi seluruh agenda yang telah dilakukan oleh
                                        mahasiswa
                                    </p>
                                    <table id="example" class="table dt-responsive nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Topik</th>
                                                <th>Dosen Pembimbing</th>
                                                <th>Tanggal</th>
                                                <th>Waktu</th>
                                                <th>Isi</th>
                                                <th>Hasil</th>
                                                <th>Tindak Lanjut</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>

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
@endsection
