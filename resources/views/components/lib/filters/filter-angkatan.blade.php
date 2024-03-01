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
                        <input class="form-check-input" type="checkbox" id="filter-angkatan-all" value="">
                        <label class="form-check-label ms-1" for="filter-angkatan-all">Semua</label>
                    </li>
                    @foreach ($angkatan as $angkatanItem)
                        <li class="mb-2">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input filter-angkatan" type="checkbox"
                                    id="filter-angkatan-{{ $angkatanItem }}" value="{{ $angkatanItem }}"
                                    data-filter-type="angkatan">
                                <label class="form-check-label"
                                    for="filter-angkatan-{{ $angkatanItem }}">{{ $angkatanItem }}</label>
                            </div>
                        </li>
                    @endforeach
                </div>
                <li class="dropdown-divider"></li>
                <li class="sticky-bottom bg-white mt-2">
                    <button class="btn text-primary fw-bold w-100 d-block text-start" id="resetAngkatan">
                        Reset Filter
                    </button>
                </li>
            </ul>
        </div>
    </div>
</div>
