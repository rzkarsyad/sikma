@extends('layouts.main')
@section('title')
    Dashboard
@endsection

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Dashboard</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="card">
                <div class="card-body">
                    <h4>Halo, {{ Auth::user()->mahasiswa->nama }}!</h4>
                    <p class="text-muted mt-2">Selamat datang di Sistem Kegiatan Mahasiswa.</p>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-1 overflow-hidden">
                                            <p class="text-truncate font-size-14 mb-2">Aktivitas</p>
                                            <h4 class="mb-0">{{ $cAktivitas }}</h4>
                                        </div>
                                        <div class="text-primary ms-auto">
                                            <i class="ri-file-list-2-line font-size-24"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-1 overflow-hidden">
                                            <p class="text-truncate font-size-14 mb-2">Kegiatan Mandiri</p>
                                            <h4 class="mb-0">{{ $cKegiatan }}</h4>
                                        </div>
                                        <div class="text-primary ms-auto">
                                            <i class="ri-book-line font-size-24"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-1 overflow-hidden">
                                            <p class="text-truncate font-size-14 mb-2">Prestasi</p>
                                            <h4 class="mb-0">{{ $cPrestasi }}</h4>
                                        </div>
                                        <div class="text-primary ms-auto">
                                            <i class="ri-trophy-line font-size-24"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-1 overflow-hidden">
                                            <p class="text-truncate font-size-14 mb-2">Ormawa</p>
                                            <h4 class="mb-0">{{ $cOrmawa }}</h4>
                                        </div>
                                        <div class="text-primary ms-auto">
                                            <i class="ri-team-line font-size-24"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                </div>
            </div>
            <!-- end row -->
        </div>

    </div>
@endsection
