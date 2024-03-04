$(document).ready(function() {
    $('.dropdown-menu').on('click', function(e) {
        e.stopPropagation();
    });
});

    const table = $('#ormawa-table');

    table.on('preXhr.dt', function(e, settings, data) {

        data.angkatan = [];
        data.prodi = [];
        data.ormawa = [];

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

        if (!$('#filter-ormawa-all').is(':checked')) {
            $('.filter-ormawa:checked').each(function() {
                data.ormawa.push($(this).val());
            });
        }

    });

    $('.filter-angkatan, .filter-prodi, .filter-ormawa').on('change', function() {
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

    $('#filter-ormawa-all').on('change', function() {
        const isChecked = $(this).is(':checked');
        $('.filter-ormawa').prop('checked', isChecked);
        table.DataTable().ajax.reload();
    });

    $('#btnReset').on('click', function() {
        $('#filter-angkatan-all, #filter-prodi-all, #filter-ormawa-all').prop(
            'checked', false);
        $('.filter-angkatan, .filter-prodi, .filter-ormawa').prop('checked', false);
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
            case 'ormawa':
                $('.filter-ormawa').prop('checked', false);
                break;
            default:
                break;
        }

        updateFilterCheckboxes();

        table.DataTable().ajax.reload();
    }

    $(document).ready(function() {

        $('.filter-angkatan, .filter-prodi, .filter-ormawa').on('change', function() {

            $('#filterTags').empty();

            $('.filter-angkatan:checked, .filter-prodi:checked, .filter-ormawa:checked')
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
            $('.filter-angkatan:checked, .filter-prodi:checked, .filter-ormawa:checked')
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
            $('#filter-ormawa-all').prop('checked', false);
            $('.filter-ormawa').prop('checked', false);
            updateCheckboxIndeterminate($('#filter-ormawa-all'), $('.filter-ormawa'));
            updateFilterTags();
            table.DataTable().ajax.reload();
        }

        $(document).ready(function() {

            $('#resetAngkatan').on('click', function() {
                resetFilterAngkatan();
                $('#filterTags .filter-chip[data-filter-type="angkatan"]')
                    .remove();
            });

            $('#resetProdi').on('click', function() {
                resetFilterProdi();
                $('#filterTags .filter-chip[data-filter-type="prodi"]')
                    .remove();
            });

            $('#resetOrmawa').on('click', function() {
                resetFilterBimbingan();
                $('#filterTags .filter-chip[data-filter-type="ormawa"]')
                    .remove();
            });

        });

    });

    function updateFilterCheckboxes() {
        updateCheckboxIndeterminate($('#filter-angkatan-all'), $('.filter-angkatan'));
        updateCheckboxIndeterminate($('#filter-prodi-all'), $('.filter-prodi'));
        updateCheckboxIndeterminate($('#filter-ormawa-all'), $('.filter-ormawa'));

        checkAllIfAllChecked($('.filter-angkatan'), $('#filter-angkatan-all'));
        checkAllIfAllChecked($('.filter-prodi'), $('#filter-prodi-all'));
        checkAllIfAllChecked($('.filter-ormawa'), $('#filter-ormawa-all'));
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
