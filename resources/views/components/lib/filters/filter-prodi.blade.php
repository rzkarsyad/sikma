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
                        <input class="form-check-input" type="checkbox" id="filter-prodi-all" value="">
                        <label class="form-check-label ms-1" for="filter-prodi-all">Semua</label>
                    </li>
                    @foreach ($prodi as $id => $nama)
                        <li class="mb-2">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input filter-prodi" type="checkbox"
                                    id="filter-prodi-{{ $id }}" value="{{ $id }}"
                                    data-filter-type="prodi">
                                <label class="form-check-label"
                                    for="filter-prodi-{{ $id }}">{{ $nama }}</label>
                            </div>
                        </li>
                    @endforeach
                    <li class="dropdown-divider"></li>
                    <li class="sticky-bottom bg-white">
                        <button class="btn text-primary fw-bold w-100 d-block text-start" id="resetProdi">Reset
                            Filter</button>
                    </li>
                </div>
            </ul>
        </div>
    </div>
</div>
