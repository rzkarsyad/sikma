@extends('layouts.main')
@section('title')
    Data Program Studi
@endsection

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Data Program Studi</h4>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="col mb-4">
                                        <div
                                            class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-3">
                                            <div>
                                                <h4 class="card-title">Program Studi</h4>
                                                <p class="card-title-desc">Tabel ini berisi seluruh data program studi
                                                    Universitas Al-Irsyad Cilacap.</p>
                                            </div>
                                            <div class="d-flex mt-3 mt-md-0">
                                                <a href=""
                                                    class="btn btn-primary mb-2 mb-md-0 me-2 waves-effect waves-light">+
                                                    Tambah data
                                                </a>
                                            </div>
                                        </div>

                                    </div>
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
