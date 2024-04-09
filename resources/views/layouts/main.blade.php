<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>@yield('title') | SIKMA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Sistem Informasi Kegiatan Mahasiswa" name="description" />
    <meta content="Developer UNAIC" name="author" />

    <link rel="shortcut icon" href="{{ asset('assets/images/logo-unaic.png') }}">

    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />

    <link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/libs/admin-resources/rwd-table/rwd-table.min.css') }}" rel="stylesheet"
        type="text/css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

</head>

<body data-sidebar="dark">

    <div id="layout-wrapper">
        @include('layouts.navbar')

        @include('layouts.sidebar')

        <div class="main-content">

            @yield('content')

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> © Universitas Al Irsyad Cilacap.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Crafted with <i class="mdi mdi-heart text-danger"></i> by Developer
                            </div>
                        </div>
                    </div>
                </div>
            </footer>

        </div>

    </div>

    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>

    <script src="{{ asset('assets/js/app.js') }}"></script>

    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <script src="{{ asset('assets/js/pages/sweet-alerts.init.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#tb-agenda').DataTable({
                "initComplete": function(settings, json) {
                    $("#tb-agenda").wrap(
                        "<div style='overflow:auto; width:100%;position:relative;'></div>");
                },
            });
        });
        $(document).ready(function() {
            $('#tb-kegiatan').DataTable({
                "initComplete": function(settings, json) {
                    $("#tb-kegiatan").wrap(
                        "<div style='overflow:auto; width:100%;position:relative;'></div>");
                },
            });
        });

        $(document).ready(function() {
            $('#tb-prestasi').DataTable({
                "initComplete": function(settings, json) {
                    $("#tb-prestasi").wrap(
                        "<div style='overflow:auto; width:100%;position:relative;'></div>");
                },
            });
        });

        $(document).ready(function() {
            $('#tb-ormawa').DataTable({
                "initComplete": function(settings, json) {
                    $("#tb-ormawa").wrap(
                        "<div style='overflow:auto; width:100%;position:relative;'></div>");
                },
            });
        });
    </script>

    <script>
        function deleteConfirmation(button) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Tindakan ini tidak bisa dikembalikan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    button.form.submit();
                }
            });
        }
    </script>
    <script>
        function resetConfirmation(button) {
            Swal.fire({
                title: 'Apakah Anda yakin ingin menyetel ulang kata sandi?',
                text: 'Tindakan ini tidak bisa dikembalikan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, reset!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    button.form.submit();
                }
            });
        }
    </script>

    @stack('scripts')

</body>

</html>
