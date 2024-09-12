<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>@yield('title', 'Admin - Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta content="Themesdesign" name="author" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/logo/logo.png') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset('/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/vendor/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('back/css/styles.css') }}" rel="stylesheet" />
    <link href="{{ asset('provinsi/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">
    <link rel="stylesheet" href="{{ asset('/vendor/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flaticon/2.1.0/css/flaticon.css">
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        @section('header')
            @include('layouts.back.inc.header')
        @show
    </nav>

    <!-- Sidebar -->
    <div id="layoutSidenav">
        @section('sidebar')
            @include('layouts.back.inc.sidebar')
        @show

        <!-- Page Content -->
        <div id="layoutSidenav_content">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="{{ asset('back/js/scripts.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="{{ asset('back/js/datatables-simple-demo.js') }}"></script>
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('provinsi/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('provinsi/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('provinsi/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('provinsi/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('admin/js/script.js') }}"></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
{{-- 
    <script type="text/javascript">
        $(document).ready(function() {
            $('#id_jabatan').change(function() {
                var id_jabatan = $(this).val();
                if (id_jabatan) {
                    $.ajax({
                        type: "GET",
                        url: '{{ route('pegawai.getgajitunjangan') }}',
                        dataType: "json",
                        data: {
                            id_jabatan: id_jabatan
                        },
                        success: function(data) {
                            if (data) {
                                $('[name="gaji_pokok"]').val(data.gaji_pokok);
                                $('[name="tunjangan"]').val(data.tunjangan);
                                console.log(data)
                                localStorage.setItem("data", JSON.stringify(data));

                            }
                        },
                        error: function() {
                            alert("Error retrieving data");
                        }
                    });
                }
            });
        });
    </script> --}}

    <script type="text/javascript">
        $(document).ready(function() {
            // Event handler for change event on #id_pegawai element
            $('#id_pegawai').change(function() {
                var id_pegawai = $(this).val();
                if (id_pegawai) {
                    $.ajax({
                        type: "GET",
                        url: '{{ route('payroll.get-pegawai') }}',
                        dataType: "json",
                        data: {
                            id_pegawai: id_pegawai
                        },
                        success: function(data) {
                            if (data) {
                                $('[name="no_rek"]').val(data.no_rek);
                                $('[name="nama_rek"]').val(data.nama_rek);
                                $('[name="nama_bagian"]').val(data.nama_bagian);
                                $('[name="nama_jabatan"]').val(data.nama_jabatan);
                                $('[name="gaji_pokok"]').val(data.gaji_pokok);
                                $('[name="tunjangan"]').val(data.tunjangan);
                                $('[name="amount"]').val(data.amount);
                                calculateTotalPayroll();
                            }
                        },
                        error: function() {
                            alert("Error retrieving data");
                        }
                    });
                }
            });

            // Event handler for input events on BPJS and Pajak inputs
            $('input[name="bpjs"], input[name="pajak"]').on('input', calculateTotalPayroll);

            // Function to calculate total payroll
            function calculateTotalPayroll() {
                var gaji_pokok = parseFloat($('#gaji_pokok').val()) || 0;
                var tunjangan = parseFloat($('#tunjangan').val()) || 0;
                var bpjs = parseFloat($('input[name="bpjs"]').val()) || 0;
                var pajak = parseFloat($('input[name="pajak"]').val()) || 0;

                var total_payroll = gaji_pokok + tunjangan - bpjs - pajak;
                $('input[name="total_payroll"]').val(total_payroll.toFixed(2));
            }
        });
    </script>
</body>

</html>
