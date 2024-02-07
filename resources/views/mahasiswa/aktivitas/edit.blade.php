@extends('layouts.main')
@section('title')
    Aktivitas Mahasiswa
@endsection

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Edit Aktivitas</h4>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('m.aktivitas-update', $mhsAktivitas->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="container">
                                    <div class="row gx-3 gy-2">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="list_kegiatan">Nama Kegiatan</label>
                                                <select name="id_aktivitas"
                                                    class="form-select @error('id_aktivitas') is-invalid @enderror">
                                                    <option value="">Pilih Kegiatan</option>
                                                    @foreach ($kegiatan as $id => $nama)
                                                        <option value="{{ $id }}"
                                                            {{ $id == $mhsAktivitas->id_aktivitas ? 'selected' : null }}>
                                                            {{ $nama }}</option>
                                                    @endforeach
                                                </select>
                                                @error('id_aktivitas')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="list_kategori">Kategori Kegiatan</label>
                                                <select name="id_kategori"
                                                    class="form-select @error('tahun') is-invalid @enderror">
                                                    <option value="">Pilih Kategori</option>
                                                    @foreach ($kategori as $id => $nama)
                                                        <option value="{{ $id }}"
                                                            {{ $id == $mhsAktivitas->id_kategori ? 'selected' : null }}>
                                                            {{ $nama }}</option>
                                                    @endforeach
                                                </select>
                                                @error('id_kategori')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="foto" class="form-label">Foto</label>
                                                <table>
                                                    <tr>
                                                        <td>
                                                            @if ($mhsAktivitas->foto)
                                                                <img src="{{ asset('storage/' . $mhsAktivitas->foto) }}"
                                                                    class="img-thumbnail" alt=""
                                                                    style="width: 300px">
                                                            @else
                                                                <span class="badge badge-danger">Belum ada foto</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                </table>
                                                <input name="foto"
                                                    class="form-control @error('foto') is-invalid @enderror" type="file"
                                                    id="foto" accept="image/*">
                                                @error('foto')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="url_penyelenggara">URL Penyelenggara</label>
                                                <input name="url_penyelenggara" type="text"
                                                    value="{{ $mhsAktivitas->url_penyelenggara }}"
                                                    class="form-control @error('url_penyelenggara') is-invalid @enderror"
                                                    id="url_penyelenggara">
                                                @error('url_penyelenggara')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="tahun">Tahun</label>
                                                <select name="tahun"
                                                    class="form-select @error('tahun') is-invalid @enderror">
                                                    <option value="">Pilih Tahun</option>
                                                    @foreach ($tahun as $thn)
                                                        <option value="{{ $thn }}"
                                                            {{ $thn == $mhsAktivitas->tahun ? 'selected' : null }}>
                                                            {{ $thn }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('tahun')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="sertifikat" class="form-label">Sertifikat</label>
                                                <table>
                                                    <tr>
                                                        <td>
                                                            @if ($mhsAktivitas->sertifikat)
                                                                @if (pathinfo($mhsAktivitas->sertifikat, PATHINFO_EXTENSION) == 'pdf')
                                                                    <a href="{{ asset('storage/' . $mhsAktivitas->sertifikat) }}"
                                                                        class="btn btn-sm btn-primary mb-2"
                                                                        target="_blank">Lihat
                                                                        Berkas</a>
                                                                @else
                                                                    <img src="{{ asset('storage/' . $mhsAktivitas->sertifikat) }}"
                                                                        class="rounded image-clickable"
                                                                        data-bs-toggle="modal" data-bs-target="#myModal"
                                                                        data-image="{{ asset('storage/' . $mhsAktivitas->sertifikat) }}"
                                                                        style="width: 64px; height: 40px; cursor: pointer; object-fit: cover;">
                                                                @endif
                                                            @else
                                                                <span class="badge badge-danger">Belum ada sertifikat</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                </table>
                                                <input name="sertifikat"
                                                    class="form-control @error('sertifikat') is-invalid @enderror"
                                                    type="file" id="sertifikat">
                                                @error('sertifikat')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <a href="{{ route('m.aktivitas') }}"
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
