@extends('layouts.main')
@section('title')
    Kegiatan Mandiri
@endsection

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Tambah Kegiatan</h4>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('m.mandiri-store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="row gx-3 gy-2 align-items-center">
                                    <div class="col-md-6 mt-3">
                                        <label for="list_tingkat">Tingkat Kegiatan</label>
                                        <select name="id_kegiatan"
                                            class="form-select @error('id_kegiatan') is-invalid @enderror">
                                            <option value="">Pilih Tingkat</option>
                                            @foreach ($tingkat as $id => $nama)
                                                <option value="{{ $id }}"
                                                    {{ old('id_kegiatan') == $id ? 'selected' : null }}>
                                                    {{ $nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_kegiatan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label for="list_jenis">Jenis Kepesertaan</label>
                                        <select name="id_jenis" class="form-select @error('id_jenis') is-invalid @enderror">
                                            <option value="">Pilih Kategori</option>
                                            @foreach ($jenis as $id => $nama)
                                                <option
                                                    value="{{ $id }}"{{ old('id_jenis') == $id ? 'selected' : null }}>
                                                    {{ $nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_jenis')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label for="nama">Nama Kegiatan</label>
                                        <input name="nama" type="text" value="{{ old('nama') }}"
                                            class="form-control @error('nama') is-invalid @enderror" id="nama">
                                        @error('nama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label for="penyelenggara">Penyelenggara</label>
                                        <input name="penyelenggara" type="text" value="{{ old('penyelenggara') }}"
                                            class="form-control @error('penyelenggara') is-invalid @enderror"
                                            id="penyelenggara">
                                        @error('penyelenggara')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label for="jumlah">Jumlah Peserta</label>
                                        <input name="jumlah" type="text" value="{{ old('jumlah') }}"
                                            class="form-control @error('jumlah') is-invalid @enderror" id="jumlah">
                                        @error('jumlah')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label for="tanggal_mulai">Tanggal Mulai Pelaksanaan</label>
                                        <input name="tanggal_mulai" type="date" value="{{ old('tanggal_mulai') }}"
                                            class="form-control @error('tanggal_mulai') is-invalid @enderror"
                                            id="tanggal_mulai">
                                        @error('tanggal_mulai')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label for="tanggal_selesai">Tanggal Selesai Pelaksanaan</label>
                                        <input name="tanggal_selesai" type="date" value="{{ old('tanggal_selesai') }}"
                                            class="form-control @error('tanggal_selesai') is-invalid @enderror"
                                            id="tanggal_selesai">
                                        @error('tanggal_selesai')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mt-3">
                                        <label for="url_penyelenggara">URL Penyelenggara</label>
                                        <input name="url_penyelenggara" type="text"
                                            value="{{ old('url_penyelenggara') }}"
                                            class="form-control @error('url_penyelenggara') is-invalid @enderror"
                                            id="url_penyelenggara">
                                        @error('url_penyelenggara')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label for="sertifikat" class="form-label">Sertifikat</label>
                                        <input name="sertifikat"
                                            class="form-control @error('sertifikat') is-invalid @enderror" type="file"
                                            id="sertifikat">
                                        @error('sertifikat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label for="foto" class="form-label">Foto</label>
                                        <input name="foto" class="form-control @error('foto') is-invalid @enderror"
                                            type="file" id="foto" accept="image/*">
                                        @error('foto')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label for="undangan" class="form-label">Surat Tugas/Undangan</label>
                                        <input name="undangan" class="form-control @error('undangan') is-invalid @enderror"
                                            type="file" id="undangan">
                                        @error('undangan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-auto mt-4">
                                        <a href="{{ route('m.mandiri') }}" class="btn btn-outline-primary px-3">Batal</a>
                                        <button class="btn btn-primary ms-2 waves-effect px-3"
                                            type="submit">Simpan</button>
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
