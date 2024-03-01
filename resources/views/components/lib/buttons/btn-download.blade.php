<div class="col-md-auto px-auto">
    <div class="dropdown" id="dropdownContainer">
        <button class="btn btn-filter dropdown-toggle" type="button" id="dropdownDownload" data-bs-toggle="dropdown"
            aria-expanded="false" style="width: fit-content;">
            <i class="ri-download-cloud-2-line"></i> Unduh Rekap
        </button>
        <ul class="dropdown-menu">
            <li>
                <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-file="pdf"
                    data-bs-target="#downloadModal" data-bs-title="Unduh PDF" onclick="closeDropdown()">
                    Unduh PDF
                </button>
                <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-file="xlsx"
                    data-bs-target="#downloadModal" data-bs-title="Unduh Spreadsheet" onclick="closeDropdown()">
                    Unduh Spreadsheet
                </button>
            </li>
        </ul>
    </div>
</div>

<script>
    function closeDropdown() {
        var dropdownMenu = document.getElementById('dropdownContainer').querySelector('.dropdown-menu');
        dropdownMenu.classList.remove('show');
    }
</script>
