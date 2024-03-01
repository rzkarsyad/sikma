$(document).ready(function() {
    $('.dropdown-menu').on('click', function(e) {
        e.stopPropagation();
    });
});

    const table = $('#agenda-table');

    table.on('preXhr.dt', function(e, settings, data) {

        data.angkatan = [];
        data.prodi = [];
        data.bimbingan = [];
        data.status = [];

        if (!$('#filter-angkatan-all').is(':checked')) {
            $('.filter-angkatan:checked').each(function() {
                data.angkatan.push($(this).val());
            });
        }

        if (!$('#filter-prodi-all').is(':checked')) {
            $('.filter-prodi:checked').each(function() {
                data.prodi.push($(this).val());
            });
        }

        if (!$('#filter-bimbingan-all').is(':checked')) {
            $('.filter-bimbingan:checked').each(function() {
                data.bimbingan.push($(this).val());
            });
        }

        if (!$('#filter-status-agenda-all').is(':checked')) {
            $('.filter-status-agenda:checked').each(function() {
                data.status.push($(this).val());
            });
        }

    });

    $('.filter-angkatan, .filter-prodi, .filter-bimbingan, .filter-status-agenda').on('change', function() {
        updateFilterCheckboxes();
        table.DataTable().ajax.reload();
    });

    $('#filter-angkatan-all').on('change', function() {
        const isChecked = $(this).is(':checked');
        $('.filter-angkatan').prop('checked', isChecked);
        table.DataTable().ajax.reload();
    });

    $('#filter-prodi-all').on('change', function() {
        const isChecked = $(this).is(':checked');
        $('.filter-prodi').prop('checked', isChecked);
        table.DataTable().ajax.reload();
    });

    $('#filter-bimbingan-all').on('change', function() {
        const isChecked = $(this).is(':checked');
        $('.filter-bimbingan').prop('checked', isChecked);
        table.DataTable().ajax.reload();
    });

    $('#filter-status-agenda-all').on('change', function() {
        const isChecked = $(this).is(':checked');
        $('.filter-status-agenda').prop('checked', isChecked);
        table.DataTable().ajax.reload();
    });

    $('#btnReset').on('click', function() {
        $('#filter-angkatan-all, #filter-prodi-all, #filter-bimbingan-all, #filter-status-agenda-all').prop(
            'checked', false);
        $('.filter-angkatan, .filter-prodi, .filter-bimbingan, .filter-status-agenda').prop('checked', false);
        updateFilterCheckboxes();
        table.DataTable().ajax.reload();
        $('#filterTags').empty();
    });

    $(document).on('click', '#filterTags .filter-chip', function() {
        var filterValue = $(this).data('filter-value');

        $(this).remove();

        $("#" + filterValue).prop('checked', false);

        updateFilterCheckboxes();

        table.DataTable().ajax.reload();
    });

    function updateCheckboxOnTagRemoval(filterType) {
        switch (filterType) {
            case 'angkatan':
                $('.filter-angkatan').prop('checked', false);
                break;
            case 'prodi':
                $('.filter-prodi').prop('checked', false);
                break;
            case 'bimbingan':
                $('.filter-bimbingan').prop('checked', false);
                break;
            case 'status':
                $('.filter-status-agenda').prop('checked', false);
                break;
            default:
                break;
        }

        updateFilterCheckboxes();

        table.DataTable().ajax.reload();
    }

    $(document).ready(function() {

        $('.filter-angkatan, .filter-prodi, .filter-bimbingan, .filter-status-agenda').on('change', function() {

            $('#filterTags').empty();

            $('.filter-angkatan:checked, .filter-prodi:checked, .filter-bimbingan:checked, .filter-status-agenda:checked')
                .each(function() {
                    var filterName = $(this).siblings('label').text();
                    var filterType = $(this).data('filter-type');
                    var filterValue = "filter-" + filterType + "-" + $(this).val();
                    $('#filterTags').append(
                        '<span class="filter-chip" data-filter-type="' +
                        filterType + '" data-filter-value="' + filterValue + '">' +
                        filterName + ' <i class="ri-close-line"></i></span>');
                });
        });
    });


    $(document).ready(function() {

        function updateFilterTags() {
            $('#filterTags').empty();
            $('.filter-angkatan:checked, .filter-prodi:checked, .filter-bimbingan:checked, .filter-status-agenda:checked')
                .each(function() {
                    var filterName = $(this).siblings('label').text();
                    var filterType = $(this).data('filter-type');
                    var filterValue = "filter-" + filterType + "-" + $(this).val();
                    $('#filterTags').append(
                        '<span class="filter-chip" data-filter-type="' +
                        filterType + '" data-filter-value="' + filterValue + '">' +
                        filterName + ' <i class="ri-close-line"></i></span>');
                });
        }

        function resetFilterAngkatan() {
            $('#filter-angkatan-all').prop('checked', false);
            $('.filter-angkatan').prop('checked', false);
            updateCheckboxIndeterminate($('#filter-angkatan-all'), $('.filter-angkatan'));
            updateFilterTags();
            table.DataTable().ajax.reload();
        }

        function resetFilterProdi() {
            $('#filter-prodi-all').prop('checked', false);
            $('.filter-prodi').prop('checked', false);
            updateCheckboxIndeterminate($('#filter-prodi-all'), $('.filter-prodi'));
            updateFilterTags();
            table.DataTable().ajax.reload();
        }

        function resetFilterBimbingan() {
            $('#filter-bimbingan-all').prop('checked', false);
            $('.filter-bimbingan').prop('checked', false);
            updateCheckboxIndeterminate($('#filter-bimbingan-all'), $('.filter-bimbingan'));
            updateFilterTags();
            table.DataTable().ajax.reload();
        }

        function resetFilterStatusAgenda() {
            $('#filter-status-agenda-all').prop('checked', false);
            $('.filter-status-agenda').prop('checked', false);
            updateCheckboxIndeterminate($('#filter-status-agenda-all'), $('.filter-status-agenda'));
            updateFilterTags();
            table.DataTable().ajax.reload();
        }

        $(document).ready(function() {

            $('#resetAngkatan').on('click', function() {
                resetFilterAngkatan();
                $('#filterTags .filter-chip[data-filter-type="angkatan"]').remove();
                    table.DataTable().ajax.reload();
            });

            $('#resetProdi').on('click', function() {
                resetFilterProdi();
                $('#filterTags .filter-chip[data-filter-type="prodi"]').remove();
                    table.DataTable().ajax.reload();
            });

            $('#resetBimbingan').on('click', function() {
                resetFilterBimbingan();
                $('#filterTags .filter-chip[data-filter-type="bimbingan"]').remove();
                    table.DataTable().ajax.reload();
            });

            $('#resetStatus').on('click', function() {
                resetFilterStatusAgenda();
                $('#filterTags .filter-chip[data-filter-type="status"]').remove();
                    table.DataTable().ajax.reload();
            });
        });

    });

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
        if (individualCheckboxes.filter(':checked').length > 0 && individualCheckboxes.filter(':not(:checked)').length >
            0) {
            allCheckbox.prop('indeterminate', true);
        } else {
            allCheckbox.prop('indeterminate', false);
        }
    }
