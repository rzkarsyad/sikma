@extends('layouts.main')
@section('title')
    Detail | {{ $mhsAgenda->topic }}
@endsection

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Detail Agenda</h4>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <div class="d-flex align-items-center justify-content-center">
                                    <a href="{{ url()->previous() }}" class="text-dark">
                                        <i class="ri-arrow-left-line font-size-24"></i>
                                    </a>
                                    <h4 class="ms-2 my-auto w-100 overflow-hidden" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="{{ $mhsAgenda->topic }}">
                                        {!! strlen($mhsAgenda->topic) > 100 ? substr($mhsAgenda->topic, 0, 100) . '...' : $mhsAgenda->topic !!}
                                    </h4>
                                </div>
                                <div>
                                    <span class="badge rounded-pill {{ $badgeClass }}">{{ $statusText }}</span>
                                </div>
                            </div>


                            <table class="table table-bordered">
                                <tr>
                                    <td style="width: 22%">Jenis Bimbingan</td>
                                    <td>{{ $type }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal</td>
                                    <td>{{ $mhsAgenda->agenda_date }}</td>
                                </tr>
                                <tr>
                                    <td>Waktu</td>
                                    <td>{{ $mhsAgenda->agenda_time }}</td>
                                </tr>
                                <tr>
                                    <td>Dosen Pembimbing</td>
                                    <td>{{ $mhsAgenda->dosen->nama }}</td>
                                </tr>
                                <tr>
                                    <td>Judul</td>
                                    <td>{{ $mhsAgenda->topic }}</td>
                                </tr>
                                <tr>
                                    <td>Isi</td>
                                    <td>{{ $mhsAgenda->content }}</td>
                                </tr>
                            </table>

                            <h5>Berikan Tanggapan</h5>

                            <div class="mb-3">
                                <label for="result">Hasil</label>
                                <textarea class="form-control @error('result') is-invalid @enderror" name="result" id="result" cols="30"
                                    rows="6" placeholder="Tulis pembahasan">{{ old('result') }}</textarea>
                                @error('result')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="action">Tindak Lanjut</label>
                                <textarea class="form-control @error('action') is-invalid @enderror" name="action" id="action" cols="30"
                                    rows="6" placeholder="Tulis pembahasan">{{ old('action') }}</textarea>
                                @error('action')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <a href="{{ route('dosen.agenda.store') }}"
                                            class="btn btn-outline-primary px-3">Batal</a>
                                        <button class="btn btn-primary ms-2 waves-effect px-3"
                                            type="submit">Simpan</button>
                                    </div>
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
@endsection
