$(document).ready(function() {
    $('.dropdown-menu').on('click', function(e) {
        e.stopPropagation();
    });
});

    const table = $('#aktivitas-table');

    table.on('preXhr.dt', function(e, settings, data) {

        data.angkatan = [];
        data.prodi = [];
        data.kategori = [];
        data.kegiatan = [];
        data.tahun = [];

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

        if (!$('#filter-kategori-all').is(':checked')) {
            $('.filter-kategori:checked').each(function() {
                data.kategori.push($(this).val());
            });
        }

        if (!$('#filter-kegiatan-all').is(':checked')) {
            $('.filter-kegiatan:checked').each(function() {
                data.kegiatan.push($(this).val());
            });
        }

        if (!$('#filter-tahun-all').is(':checked')) {
            $('.filter-tahun:checked').each(function() {
                data.tahun.push($(this).val());
            });
        }

    });

    $('.filter-angkatan, .filter-prodi, .filter-kategori, .filter-kegiatan, .filter-tahun').on('change', function() {
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

    $('#filter-kategori-all').on('change', function() {
        const isChecked = $(this).is(':checked');
        $('.filter-kategori').prop('checked', isChecked);
        table.DataTable().ajax.reload();
    });

    $('#filter-kegiatan-all').on('change', function() {
        const isChecked = $(this).is(':checked');
        $('.filter-kegiatan').prop('checked', isChecked);
        table.DataTable().ajax.reload();
    });

    $('#filter-tahun-all').on('change', function() {
        const isChecked = $(this).is(':checked');
        $('.filter-tahun').prop('checked', isChecked);
        table.DataTable().ajax.reload();
    });

    $('#btnReset').on('click', function() {
        $('#filter-angkatan-all, #filter-prodi-all, #filter-kategori-all, #filter-kegiatan-all, #filter-tahun-all').prop(
            'checked', false);
        $('.filter-angkatan, .filter-prodi, .filter-kategori, .filter-kegiatan, .filter-tahun').prop('checked', false);
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
            case 'kategori':
                $('.filter-kategori').prop('checked', false);
                break;
            case 'kegiatan':
                $('.filter-kegiatan').prop('checked', false);
                break;
            case 'tahun':
                $('.filter-tahun').prop('checked', false);
                break;
            default:
                break;
        }

        updateFilterCheckboxes();

        table.DataTable().ajax.reload();
    }

    $(document).ready(function() {

        $('.filter-angkatan, .filter-prodi, .filter-kategori, .filter-kegiatan, .filter-tahun').on('change', function() {

            $('#filterTags').empty();

            $('.filter-angkatan:checked, .filter-prodi:checked, .filter-kategori:checked, .filter-kegiatan:checked, .filter-tahun:checked')
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
            $('.filter-angkatan:checked, .filter-prodi:checked, .filter-kategori:checked, .filter-kegiatan:checked, .filter-tahun:checked')
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

        function resetFilterKategori() {
            $('#filter-kategori-all').prop('checked', false);
            $('.filter-kategori').prop('checked', false);
            updateCheckboxIndeterminate($('#filter-kategori-all'), $('.filter-kategori'));
            updateFilterTags();
            table.DataTable().ajax.reload();
        }

        function resetFilterKegiatan() {
            $('#filter-kegiatan-all').prop('checked', false);
            $('.filter-kegiatan').prop('checked', false);
            updateCheckboxIndeterminate($('#filter-kegiatan-all'), $('.filter-kegiatan'));
            updateFilterTags();
            table.DataTable().ajax.reload();
        }

        function resetFilterTahun() {
            $('#filter-tahun-all').prop('checked', false);
            $('.filter-tahun').prop('checked', false);
            updateCheckboxIndeterminate($('#filter-tahun-all'), $('.filter-tahun'));
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

            $('#resetKategori').on('click', function() {
                resetFilterKategori();
                $('#filterTags .filter-chip[data-filter-type="kategori"]')
                    .remove();
            });

            $('#resetKegiatan').on('click', function() {
                resetFilterKegiatan();
                $('#filterTags .filter-chip[data-filter-type="kegiatan"]')
                    .remove();
            });

            $('#resetTahun').on('click', function() {
                resetFilterTahun();
                $('#filterTags .filter-chip[data-filter-type="tahun"]')
                    .remove();
            });
        });

    });

    function updateFilterCheckboxes() {
        updateCheckboxIndeterminate($('#filter-angkatan-all'), $('.filter-angkatan'));
        updateCheckboxIndeterminate($('#filter-prodi-all'), $('.filter-prodi'));
        updateCheckboxIndeterminate($('#filter-kategori-all'), $('.filter-kategori'));
        updateCheckboxIndeterminate($('#filter-kegiatan-all'), $('.filter-kegiatan'));
        updateCheckboxIndeterminate($('#filter-tahun-all'), $('.filter-tahun'));

        checkAllIfAllChecked($('.filter-angkatan'), $('#filter-angkatan-all'));
        checkAllIfAllChecked($('.filter-prodi'), $('#filter-prodi-all'));
        checkAllIfAllChecked($('.filter-kategori'), $('#filter-kategori-all'));
        checkAllIfAllChecked($('.filter-kegiatan'), $('#filter-kegiatan-all'));
        checkAllIfAllChecked($('.filter-tahun'), $('#filter-tahun-all'));
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
