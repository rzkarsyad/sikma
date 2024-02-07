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
                            <form action="{{ route('m.agenda-store') }}" method="POST">
                                @csrf
                                @method('POST')

                                <div class="container">
                                    <div class="row gx-3 gy-2">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="list_bimbingan">Jenis Bimbingan</label>
                                                <select name="type"
                                                    class="form-select @error('type') is-invalid @enderror">
                                                    <option value="">Pilih Bimbingan</option>
                                                    @foreach ($jenis_bimbingan as $value => $label)
                                                        <option value="{{ $value }}"
                                                            {{ old('type') == $value ? 'selected' : '' }}>
                                                            {{ $label }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('type')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="row gx-3">
                                                <div class="col-md-6 mb-3 mb-md-0">
                                                    <label for="agenda_date">Tanggal</label>
                                                    <input name="agenda_date" type="date"
                                                        class="form-control @error('agenda_date') is-invalid @enderror"
                                                        value="{{ old('agenda_date') }}">
                                                    @error('agenda_date')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror

                                                </div>
                                                <div class="col-md-6">
                                                    <label for="agenda_time">Waktu</label>
                                                    <input name="agenda_time" type="time"
                                                        class="form-control @error('agenda_time') is-invalid @enderror"
                                                        value="{{ old('agenda_time') }}">
                                                    @error('agenda_time')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="dosen_id">Dosen Pembimbing</label>
                                                <select name="dosen_id" id="#js-example-basic-single"
                                                    data-live-search="true"
                                                    class="form-select @error('dosen_id') is-invalid @enderror">
                                                    <option value="">Pilih Dosen</option>
                                                    @foreach ($dosen as $nidn => $nama)
                                                        <option value="{{ $nidn }}"
                                                            {{ old('dosen_id') == $nidn ? 'selected' : null }}>
                                                            {{ $nama }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('dosen_id')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="topic">Judul</label>
                                                <input name="topic" type="input"
                                                    class="form-control @error('topic') is-invalid @enderror"
                                                    value="{{ old('topic') }}">
                                                @error('topic')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="content">Isi</label>
                                                <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content" cols="30"
                                                    rows="6" placeholder="Tulis bahasan bimbingan">{{ old('content') }}</textarea>
                                                @error('content')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
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
