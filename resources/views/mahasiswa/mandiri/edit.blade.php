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
                        <h4 class="mb-sm-0">Edit Kegiatan</h4>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('m.mandiri-update', $mhsKegiatan->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row gx-3 gy-2 align-items-center">
                                    <div class="col-md-6 mt-3">
                                        <label for="list_tingkat">Tingkat Kegiatan</label>
                                        <select name="id_kegiatan"
                                            class="form-select @error('id_kegiatan') is-invalid @enderror">
                                            <option value="">Pilih Kegiatan</option>
                                            @foreach ($tingkat as $id => $nama)
                                                <option value="{{ $id }}"
                                                    {{ $id == $mhsKegiatan->id_kegiatan ? 'selected' : null }}>
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
                                                <option value="{{ $id }}"
                                                    {{ $id == $mhsKegiatan->id_jenis ? 'selected' : null }}>
                                                    {{ $nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_jenis')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label for="nama">Nama Kegiatan</label>
                                        <input name="nama" type="text" value="{{ $mhsKegiatan->nama }}"
                                            class="form-control @error('nama_kegiatan') is-invalid @enderror"
                                            id="nama_kegiatan">
                                        @error('nama_kegiatan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label for="penyelenggara">Penyelenggara</label>
                                        <input name="penyelenggara" type="text"
                                            value="{{ $mhsKegiatan->penyelenggara }}"
                                            class="form-control @error('penyelenggara') is-invalid @enderror"
                                            id="penyelenggara">
                                        @error('penyelenggara')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label for="jumlah">Jumlah Peserta</label>
                                        <input name="jumlah" type="text" value="{{ $mhsKegiatan->jumlah }}"
                                            class="form-control @error('jumlah') is-invalid @enderror" id="jumlah">
                                        @error('jumlah')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label for="tanggal_mulai">Tanggal Mulai Pelaksanaan</label>
                                        <input name="tanggal_mulai" type="date"
                                            value="{{ $mhsKegiatan->tanggal_mulai }}"
                                            class="form-control @error('tanggal_mulai') is-invalid @enderror"
                                            id="tanggal_mulai">
                                        @error('tanggal_mulai')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label for="tanggal_selesai">Tanggal Selesai Pelaksanaan</label>
                                        <input name="tanggal_selesai" type="date"
                                            value="{{ $mhsKegiatan->tanggal_selesai }}"
                                            class="form-control @error('tanggal_selesai') is-invalid @enderror"
                                            id="tanggal_selesai">
                                        @error('tanggal_selesai')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mt-3">
                                        <label for="url_penyelenggara">URL Penyelenggara</label>
                                        <input name="url_penyelenggara" type="text"
                                            value="{{ $mhsKegiatan->url_penyelenggara }}"
                                            class="form-control @error('url_penyelenggara') is-invalid @enderror"
                                            id="url_penyelenggara">
                                        @error('url_penyelenggara')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <label for="sertifikat" class="form-label">Sertifikat</label>
                                        <table>
                                            <tr>
                                                <td>
                                                    @if ($mhsKegiatan->sertifikat)
                                                        <img src="{{ asset('storage/' . $mhsKegiatan->sertifikat) }}"
                                                            class="img-thumbnail" alt="" style="width: 200px">
                                                    @else
                                                        <span class="badge badge-danger">Belum ada foto</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        </table>
                                        <br>
                                        <input name="sertifikat"
                                            class="form-control @error('sertifikat') is-invalid @enderror" type="file"
                                            id="sertifikat">
                                        @error('sertifikat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <label for="foto" class="form-label">Foto</label>
                                        <table>
                                            <tr>
                                                <td>
                                                    @if ($mhsKegiatan->foto)
                                                        <img src="{{ asset('storage/' . $mhsKegiatan->foto) }}"
                                                            class="img-thumbnail" alt="" style="width: 200px">
                                                    @else
                                                        <span class="badge badge-danger">Belum ada foto</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        </table>
                                        <br>
                                        <input name="foto" class="form-control @error('foto') is-invalid @enderror"
                                            type="file" id="foto" accept="image/*">
                                        @error('foto')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <label for="undangan" class="form-label">Surat Tugas / Undangan</label>
                                        <table>
                                            <tr>
                                                <td>
                                                    @if ($mhsKegiatan->undangan)
                                                        <img src="{{ asset('storage/' . $mhsKegiatan->undangan) }}"
                                                            class="img-thumbnail" alt="" style="width: 200px">
                                                    @else
                                                        <span class="badge badge-danger">Belum ada foto</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        </table>
                                        <br>
                                        <input name="undangan"
                                            class="form-control @error('undangan') is-invalid @enderror" type="file"
                                            id="undangan">
                                        @error('undangan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12 mt-3">
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
