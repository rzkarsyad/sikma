$(document).ready(function() {
    $('.dropdown-menu').on('click', function(e) {
        e.stopPropagation();
    });

    const table = $('#agenda-table');

    table.on('preXhr.dt', function(e, settings, data) {
        data.angkatan = collectCheckedValues('.download-filter-angkatan');
        data.prodi = collectCheckedValues('.download-filter-prodi');
        data.bimbingan = collectCheckedValues('.download-filter-bimbingan');
        data.status = collectCheckedValues('.download-filter-status-agenda');
    });

    $('.download-filter-angkatan, .download-filter-prodi, .download-filter-bimbingan, .download-filter-status-agenda').on('change', function() {
        updateFilterAndReloadTable();
    });

    $('#download-filter-angkatan-all, #download-filter-prodi-all, #download-filter-bimbingan-all, #download-filter-status-agenda-all').on('change', function() {
        updateAllCheckboxes($(this));
        updateFilterAndReloadTable();
    });

    $('.download-filter-angkatan, .download-filter-prodi, .download-filter-bimbingan, .download-filter-status-agenda').on('change', function() {
        updateDownloadFilterTags();
    });

    $(document).on('click', '#downloadFilterTags .download-filter-chip', function() {
        var filterValue = $(this).data('download-filter-value');
        $(this).remove();
        $("#" + filterValue).prop('checked', false);
        updateFilterAndReloadTable();
        updateDownloadFilterTags();
        updateAllCheckboxes($('#' + filterValue));
        table.DataTable().ajax.reload();
    });


    $('#btnResetFilters').on('click', function() {
        resetAllFilters();
        updateFilterAndReloadTable();
        $('#downloadFilterTags').empty();
        $('.btn-reset-filters').hide();
    });

    $('#downloadModal').on('hidden.bs.modal', function () {
        resetAllFilters();
        updateFilterAndReloadTable();
    });

    function collectCheckedValues(selector) {
        const values = [];
        $(selector + ':checked').each(function() {
            values.push($(this).val());
        });
        return values;
    }

    function updateAllCheckboxes(checkbox) {
        const isChecked = checkbox.is(':checked');
        checkbox.closest('.dropdown').find('.dropdown-menu input[type="checkbox"]').prop('checked', isChecked);
    }

    function updateFilterAndReloadTable() {
        updateFilterCheckboxes();
        table.DataTable().ajax.reload();
    }

    function updateDownloadFilterTags() {
        $('#downloadFilterTags').empty();
        $('.download-filter-angkatan:checked, .download-filter-prodi:checked, .download-filter-bimbingan:checked, .download-filter-status-agenda:checked')
            .each(function() {
                var filterName = $(this).siblings('label').text();
                var filterType = $(this).data('download-filter-type');
                var filterValue = "download-filter-" + filterType + "-" + $(this).val();
                $('#downloadFilterTags').append(
                    '<span class="download-filter-chip" data-download-filter-type="' +
                    filterType + '" data-download-filter-value="' + filterValue + '">' +
                    filterName + ' <i class="ri-close-line"></i></span>');
            });

        var downloadFilterTagsCount = $('#downloadFilterTags').find('.download-filter-chip').length;
        if (downloadFilterTagsCount > 0) {
            $('#btnResetFilters').show();
        } else {
            $('#btnResetFilters').hide();
        }
    }

    function updateFilterCheckboxes() {
        $('.dropdown-menu').each(function() {
            var allCheckbox = $(this).find('input[type="checkbox"]:first');
            var individualCheckboxes = $(this).find('input[type="checkbox"]').not(':first');

            updateCheckboxIndeterminate(allCheckbox, individualCheckboxes);
            checkAllIfAllChecked(individualCheckboxes, allCheckbox);
        });
    }

    function checkAllIfAllChecked(individualCheckboxes, allCheckbox) {
        if (individualCheckboxes.length === individualCheckboxes.filter(':checked').length) {
            allCheckbox.prop('checked', true);
        } else {
            allCheckbox.prop('checked', false);
        }
    }

    function updateCheckboxIndeterminate(allCheckbox, individualCheckboxes) {
        if (individualCheckboxes.filter(':checked').length > 0 && individualCheckboxes.filter(':not(:checked)').length > 0) {
            allCheckbox.prop('indeterminate', true);
        } else {
            allCheckbox.prop('indeterminate', false);
        }
    }

    function resetAllFilters() {
        $('.dropdown-menu input[type="checkbox"]').prop('checked', false);
        updateFilterCheckboxes();
    }

    function resetDownloadFilterAngkatan() {
        $('#download-filter-angkatan-all').prop('checked', false);
        $('.download-filter-angkatan').prop('checked', false);
        updateCheckboxIndeterminate($('#download-filter-angkatan-all'), $('.download-filter-angkatan'));
        updateDownloadFilterTags();
    }

    function resetDownloadFilterProdi() {
        $('#download-filter-prodi-all').prop('checked', false);
        $('.download-filter-prodi').prop('checked', false);
        updateCheckboxIndeterminate($('#download-filter-prodi-all'), $('.download-filter-prodi'));
        updateDownloadFilterTags();
    }

    function resetDownloadFilterBimbingan() {
        $('#download-filter-bimbingan-all').prop('checked', false);
        $('.download-filter-bimbingan').prop('checked', false);
        updateCheckboxIndeterminate($('#download-filter-bimbingan-all'), $('.download-filter-bimbingan'));
        updateDownloadFilterTags();
    }

    function resetDownloadFilterStatusAgenda() {
        $('#download-filter-status-agenda-all').prop('checked', false);
        $('.download-filter-status-agenda').prop('checked', false);
        updateCheckboxIndeterminate($('#download-filter-status-agenda-all'), $('.download-filter-status-agenda'));
        updateDownloadFilterTags();
    }

    $('#resetDownloadAngkatan').on('click', function() {
        resetDownloadFilterAngkatan();
        table.DataTable().ajax.reload();
    });

    $('#resetDownloadProdi').on('click', function() {
        resetDownloadFilterProdi();
        table.DataTable().ajax.reload();
    });

    $('#resetDownloadBimbingan').on('click', function() {
        resetDownloadFilterBimbingan();
        table.DataTable().ajax.reload();
    });

    $('#resetDownloadStatus').on('click', function() {
        resetDownloadFilterStatusAgenda();
        table.DataTable().ajax.reload();
    });

});
