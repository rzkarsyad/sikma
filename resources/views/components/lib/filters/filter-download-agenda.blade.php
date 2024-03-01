<div class="col-md-auto">
    <p class="mb-2">Angkatan</p>
    <div class="col-md-auto px-auto">
        <div class="dropdown">
            <button class="btn btn-filter dropdown-toggle" type="button" id="dropdownAngkatan" data-bs-toggle="dropdown"
                aria-expanded="false" style="width: fit-content;">
                Pilih Angkatan <i class="ri-arrow-down-s-line"></i>
            </button>

            <div class="container">
                <ul class="dropdown-menu py-0" aria-labelledby="dropdownAngkatan"
                    style="max-height: 230px; overflow-y: auto; width: 200px;">
                    <div class="container pt-3 px-3">
                        <span class="text-muted">Pilih Tahun Angkatan</span>
                        <li class="mb-2 mt-2">
                            <input class="form-check-input" type="checkbox" id="download-filter-angkatan-all"
                                value="">
                            <label class="form-check-label ms-1" for="download-filter-angkatan-all">Semua</label>
                        </li>
                        @foreach ($angkatan as $angkatanItem)
                            <li class="mb-2">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input download-filter-angkatan" type="checkbox"
                                        id="download-filter-angkatan-{{ $angkatanItem }}" value="{{ $angkatanItem }}"
                                        data-download-filter-type="angkatan">
                                    <label class="form-check-label"
                                        for="download-filter-angkatan-{{ $angkatanItem }}">{{ $angkatanItem }}</label>
                                </div>
                            </li>
                        @endforeach
                    </div>
                    <li class="dropdown-divider"></li>
                    <li class="sticky-bottom bg-white mt-2">
                        <button class="btn text-primary fw-bold w-100 d-block text-start" id="resetDownloadAngkatan">
                            Reset Filter
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="col-md-auto">
    <p class="mb-2">Program Studi</p>
    <div class="col-md-auto px-auto">
        <div class="dropdown">
            <button class="btn btn-filter dropdown-toggle" type="button" id="dropdownProdi" data-bs-toggle="dropdown"
                aria-expanded="false" style="width: fit-content;">
                Pilih Program Studi <i class="ri-arrow-down-s-line"></i>
            </button>
            <div class="container">
                <ul class="dropdown-menu py-0" aria-labelledby="dropdownProdi"
                    style="max-height: 250px; overflow-y: auto; width: 300px;">
                    <div class="container pt-3 px-3">
                        <span class="text-muted">Pilih Program Studi</span>
                        <li class="mb-2 mt-2">
                            <input class="form-check-input" type="checkbox" id="download-filter-prodi-all"
                                value="">
                            <label class="form-check-label ms-1" for="download-filter-prodi-all">Semua</label>
                        </li>
                        @foreach ($prodi as $id => $nama)
                            <li class="mb-2">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input download-filter-prodi" type="checkbox"
                                        id="download-filter-prodi-{{ $id }}" value="{{ $id }}"
                                        data-download-filter-type="prodi">
                                    <label class="form-check-label"
                                        for="download-filter-prodi-{{ $id }}">{{ $nama }}</label>
                                </div>
                            </li>
                        @endforeach
                        <li class="dropdown-divider"></li>
                        <li class="sticky-bottom bg-white">
                            <button class="btn text-primary fw-bold w-100 d-block text-start"
                                id="resetDownloadProdi">Reset
                                Filter</button>
                        </li>
                    </div>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="col-md-auto">
    <p class="mb-2">Jenis Bimbingan</p>
    <div class="col-md-auto px-auto">
        <div class="dropdown">
            <button class="btn btn-filter dropdown-toggle" type="button" id="dropdownBimbingan"
                data-bs-toggle="dropdown" aria-expanded="false" style="width: fit-content;">
                Pilih Bimbingan <i class="ri-arrow-down-s-line"></i>
            </button>
            <div class="container">
                <ul class="dropdown-menu py-0" aria-labelledby="dropdownBimbingan"
                    style="max-height: 200px; overflow-y: auto; width: 275px;">
                    <div class="container pt-3 px-3">
                        <span class="text-muted">Pilih Jenis Bimbingan</span>
                        <li class="mb-2 mt-2">
                            <input class="form-check-input" type="checkbox" id="download-filter-bimbingan-all"
                                value="">
                            <label class="form-check-label ms-1" for="download-filter-bimbingan-all">Semua</label>
                        </li>
                        @foreach ($bimbingan as $value => $label)
                            <li class="mb-2">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input download-filter-bimbingan" type="checkbox"
                                        id="download-filter-bimbingan-{{ $value }}" value="{{ $value }}"
                                        data-download-filter-type="bimbingan">
                                    <label class="form-check-label"
                                        for="download-filter-bimbingan-{{ $value }}">{{ $label }}</label>
                                </div>
                            </li>
                        @endforeach
                    </div>
                    <li class="dropdown-divider"></li>
                    <li class="sticky-bottom bg-white">
                        <button class="btn text-primary fw-bold w-100 d-block text-start" id="resetDownloadBimbingan">
                            Reset Filter
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</div>

<div class="col-md-auto">
    <p class="mb-2">Status</p>
    <div class="col-md-auto px-auto">
        <div class="dropdown">
            <button class="btn btn-filter dropdown-toggle" type="button" id="dropdownStatus"
                data-bs-toggle="dropdown" aria-expanded="false" style="width: fit-content;">
                Pilih Status <i class="ri-arrow-down-s-line"></i>
            </button>
            <div class="container">
                <ul class="dropdown-menu py-0" aria-labelledby="dropdownStatus"
                    style="max-height: 175px; overflow-y: auto; width: 200px;">
                    <div class="container pt-3 px-3">
                        <span class="text-muted">Pilih Status Agenda</span>
                        <li class="mb-2 mt-2">
                            <input class="form-check-input" type="checkbox" id="download-filter-status-agenda-all"
                                value="">
                            <label class="form-check-label ms-1" for="download-filter-status-agenda-all">Semua</label>
                        </li>
                        @foreach ($status as $value => $label)
                            <li class="mb-2">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input download-filter-status-agenda" type="checkbox"
                                        id="download-filter-status-agenda-{{ $value }}"
                                        value="{{ $value }}" data-download-filter-type="status-agenda">
                                    <label class="form-check-label"
                                        for="download-filter-status-agenda-{{ $value }}">{{ $label }}</label>
                                </div>
                            </li>
                        @endforeach
                    </div>
                    <li class="dropdown-divider"></li>
                    <li class="sticky-bottom bg-white">
                        <button class="btn text-primary fw-bold w-100 d-block text-start" id="resetDownloadStatus">
                            Reset Filter
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</div>
