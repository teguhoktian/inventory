<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <base href="/">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="adminLTE/bootstrap/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="adminLTE/bootstrap/css/font-awesome.min.css">

    <!-- Ionicons -->
    <link rel="stylesheet" href="adminLTE/bootstrap/css/ionicons.min.css">

    <!-- iCheck -->
    <link rel="stylesheet" href="adminLTE/plugins/iCheck/square/blue.css">

    <!-- Datatables -->
    <link rel="stylesheet" href="adminLTE/plugins/datatables/dataTables.bootstrap.css">

    <!-- Sweetalert -->
    <link rel="stylesheet" href="adminLTE/plugins/sweetalert/dist/sweetalert.css">

    <!-- Select2 -->
    <link rel="stylesheet" href="adminLTE/plugins/select2/select2.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="adminLTE/dist/css/AdminLTE.min.css">

    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="adminLTE/dist/css/skins/_all-skins.min.css">

    <!-- Datepicker -->
    <link rel="stylesheet" href="adminLTE/plugins/datepicker/datepicker3.css">

    <!-- DateRangepicker -->
    <link rel="stylesheet" href="adminLTE/plugins/datepicker/daterangepicker.css">

    <!-- TimePicker -->
    <link rel="stylesheet" href="adminLTE/plugins/timepicker/bootstrap-timepicker.min.css">

    <!-- Application -->
    <link rel="stylesheet" href="adminLTE/dist/css/App.css">

    @yield('style')
</head>

@php
$collapsedRoutes = ['barang-masuk.create', 'barang-keluar.create'];
@endphp

<body
    class="sidebar-mini skin-black fixed {{ in_array(Route::currentRouteName(), $collapsedRoutes) ? 'sidebar-collapse' : '' }}">
    <div id="loading">
        <i id="spinner" class="fa fa-cog fa-spin fa-5x fa-fw"></i>
    </div>
    <div id="app" class="wrapper">

        @include('layouts.navbar')

        @include('layouts.sidebar')

        @yield('content')

        @include('layouts.footer')
    </div>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->


    <!-- jQuery 2.2.3 -->
    <script src="adminLTE/plugins/jQuery/jquery-2.2.3.min.js"></script>

    <!-- Bootstrap 3.3.6 -->
    <script src="adminLTE/bootstrap/js/bootstrap.min.js"></script>

    <!-- AdminLTE Script -->
    <script src="adminLTE/dist/js/adminlte.min.js"></script>

    <!-- iCheck -->
    <script src="adminLTE/plugins/iCheck/icheck.min.js"></script>

    <!-- Datatables -->
    <script src="adminLTE/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="adminLTE/plugins/datatables/dataTables.bootstrap.min.js"></script>

    <!-- Slim Scroll -->
    <script src="adminLTE/dist/js/jquery.slimscroll.min.js"></script>

    <!-- Sweetalert -->
    <script src="adminLTE/plugins/sweetalert/dist/sweetalert.js"></script>

    <!-- Select2 -->
    <script src="adminLTE/plugins/select2/select2.min.js"></script>

    <!-- Datepicker -->
    <script src="adminLTE/plugins/datepicker/bootstrap-datepicker.js"></script>

    <!-- DateRangepicker -->
    <script src="adminLTE/plugins/datepicker/daterangepicker.js"></script>

    <!-- bootstrap time picker -->
    <script src="adminLTE/plugins/timepicker/bootstrap-timepicker.min.js"></script>

    <!-- Highchart -->
    <script src="adminLTE/plugins/highcharts/highcharts.js"></script>
    <script src="adminLTE/plugins/highcharts/highcharts-3d.js"></script>

    <!-- Input Mask -->
    <script src="adminLTE/plugins/inputmask/jquery.inputmask.js"></script>
    <script src="adminLTE/plugins/inputmask/jquery.inputmask.date.extensions.js"></script>
    <script src="adminLTE/plugins/inputmask/jquery.inputmask.extensions.js"></script>
    <script src="adminLTE/plugins/inputmask/jquery.inputmask.extensions.js"></script>

    <!-- AdminLTE App -->
    <script src="adminLTE/dist/js/app.min.js"></script>

    <script type="text/javascript">
        var base_url = "{{ url('/') }}";
        var site_url = "{{ url('/') }}";

        $.ajaxSetup({
            statusCode: {
                403: function () {
                    swal({
                        'title': 'Akses tidak diizinkan!',
                        'text': 'Sessi Anda tidak valid.',
                        'type': 'error'
                    }, function () {
                        location.reload();
                    });
                }
            },
        });

        $(function () {
            $('input').attr('autocomplete', 'off');
            $('.treeview-menu li.active').closest('li.treeview').addClass('menu-open active');
        });

        $(window).load(function () {
            $("#loading").fadeOut();
        });

        $(document).ajaxStart(function () {
            $("#loading").show();
        });

        $(document).ajaxComplete(function () {
            $("#loading").hide();
            $("#btbSubmit").attr("disabled", false);
        });


        //Fungsi AJAXForm Submit
        function submitForm(formId, submitButtonId) {
            $("#" + formId).submit(function (e) {
                e.preventDefault();

                var form = $(this);
                var _url = form.attr('action');
                var _method = form.attr('method');
                var data = form.serialize();

                $.ajax({
                    url: _url,
                    type: _method,
                    data: data,
                    dataType: 'json',
                    beforeSend: function () {
                        $('div').removeClass('has-error');
                        $('.help-block').remove();
                        $("#" + submitButtonId).attr("disabled", true);
                    },
                    error: function (response) {
                        if (response.status == '422') {
                            $.each(response.responseJSON.errors, function (i, error) {
                                var el = $(document).find('[name="' + i + '"]');
                                el.parent().addClass("has-error").append('<span class="help-block">' + error[0] + '</span>');
                            });
                        }
                    },
                    success: function (response) {
                        swal({
                            title: "Simpan Data",
                            type: "success",
                            text: response.message
                        }, function () {
                            window.location = response.redirectTo;
                        });
                    }
                });

                $("#" + submitButtonId).attr("disabled", false);
            });
        }

        //Fungsi AJAXForm dengan File Submit
        function submitFile(formId, submitButtonId) {
            $("#" + formId).submit(function (e) {
                e.preventDefault();

                var form = $(this);
                var _url = form.attr('action');
                var _method = form.attr('method');
                var formData = new FormData(this); // Gunakan FormData untuk menangani file

                $.ajax({
                    url: _url,
                    type: _method,
                    data: formData,
                    processData: false, // Jangan proses data, karena FormData sudah menangani
                    contentType: false, // Jangan tetapkan contentType secara otomatis
                    dataType: 'json',
                    beforeSend: function () {
                        $('div').removeClass('has-error');
                        $('.help-block').remove();
                        $("#" + submitButtonId).attr("disabled", true);
                    },
                    error: function (response) {
                        $("#" + submitButtonId).attr("disabled", false); // Aktifkan tombol lagi jika gagal
                        if (response.status === 422) {
                            $.each(response.responseJSON.errors, function (i, error) {
                                var el = $(document).find('[name="' + i + '"]');
                                el.parent().addClass("has-error").append('<span class="help-block">' + error[0] + '</span>');
                            });
                        } else {
                            swal({
                                title: "Terjadi Kesalahan",
                                type: "error",
                                text: "Ada kesalahan dalam proses penyimpanan data."
                            });
                        }
                    },
                    success: function (response) {
                        swal({
                            title: "Simpan Data",
                            type: "success",
                            text: response.message
                        }, function () {
                            window.location = response.redirectTo;
                        });
                    },
                    complete: function () {
                        $("#" + submitButtonId).attr("disabled", false); // Aktifkan tombol lagi setelah selesai
                    }
                });
            });
        }

    </script>

    @yield('javascript')
</body>

</html>