@extends('layouts.main')
@section('title')
    Agenda
@endsection

@section('content')
    <div class="page-content">
        <div class="container-fluid">

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
                                                <label for="id_agenda">Jenis Bimbingan</label>
                                                <select name="id_agenda" id="id_agenda"
                                                    class="form-select @error('id_agenda') is-invalid @enderror">
                                                    <option value="">Pilih Jenis Bimbingan</option>
                                                    @foreach ($jenis_agenda as $id => $nama)
                                                        <option value="{{ $id }}"
                                                            {{ old('id_agenda') == $id ? 'selected' : null }}>
                                                            {{ $nama }}</option>
                                                    @endforeach
                                                </select>
                                                @error('id_agenda')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="row gx-3">
                                                <div class="col-md-6 mb-3 mb-md-0">
                                                    <label for="agenda_date">Tanggal</label>
                                                    <input name="agenda_date" type="date" id="agenda_date"
                                                        class="form-control @error('agenda_date') is-invalid @enderror"
                                                        value="{{ old('agenda_date') }}">
                                                    @error('agenda_date')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror

                                                </div>
                                                <div class="col-md-6">
                                                    <label for="agenda_time">Waktu</label>
                                                    <input name="agenda_time" type="time" id="agenda_time"
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
                                                <select name="dosen_id" id="dosen_id"
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
                                                <input name="topic" type="input" id="topic"
                                                    class="form-control @error('topic') is-invalid @enderror"
                                                    value="{{ old('topic') }}">
                                                @error('topic')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row gx-3 gy-2 mb-3">
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

                                    @include('components.lib.action-modal')

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('input').on('input', function() {
                $(this).removeClass('is-invalid').next('.invalid-feedback').remove();
            });

            $('textarea').on('input', function() {
                $(this).removeClass('is-invalid').next('.invalid-feedback').remove();
            });

            $('select').on('change', function() {
                $(this).removeClass('is-invalid').next('.invalid-feedback').remove();
            });
        });
    </script>
@endpush
