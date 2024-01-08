@extends('layouts.main')
@section('title')
    Buat Agenda
@endsection

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Tambah Agenda</h4>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('m.aktivitas-store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('POST')

                                <div class="container">
                                    <div class="row gx-3 gy-2">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="list_kegiatan">Jenis Bimbingan</label>
                                                <select name="id_aktivitas" class="form-select">
                                                    <option value="">Pilih bimbingan</option>
                                                </select>
                                            </div>
                                            <div class="row gx-3">
                                                <div class="col-md-6 mb-3 mb-md-0">
                                                    <label for="url_penyelenggara">Tanggal</label>
                                                    <input name="url_penyelenggara" type="date" class="form-control">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="url_penyelenggara">Waktu</label>
                                                    <input name="url_penyelenggara" type="time" class="form-control">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="list_kegiatan">Dosen Pembimbing</label>
                                                <select name="id_aktivitas" class="form-select">
                                                    <option value="">Pilih bimbingan</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="list_kegiatan">Judul</label>
                                                <select name="id_aktivitas" class="form-select">
                                                    <option value="">Pilih bimbingan</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="list_kegiatan">Isi</label>
                                                <textarea class="form-control" name="" id="" cols="30" rows="3"
                                                    placeholder="Tulis bahasan bimbingan"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <a href="{{ route('m.agenda') }}"
                                                    class="btn btn-outline-primary px-3">Batal</a>
                                                <button class="btn btn-primary ms-2 waves-effect px-3"
                                                    type="submit">Simpan</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->
        </div>
    </div>
@endsection
