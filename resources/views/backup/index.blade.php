@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <x-content-header :title="__('Backup Panel')" :subtitle="__('')" />

    <div class="content">
        <div class="box box-success box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <i class="fa fa-line-chart"></i> {{ __('Backup Status') }}
                </h3>
            </div>
            <div class="box-body">
                <div style="margin-bottom: 0.5rem;" class="btn-group">
                    <button class="btn btn-primary" onclick="loadBackupFiles()">
                        <i class="fa fa-refresh"></i> {{ __('Refresh') }}
                    </button>
                    <button class="btn btn-success" id="createBackupBtn">
                        <i class="fa fa-hdd-o"></i> {{ __('Backup') }}
                    </button>
                </div>
                <table id="backupStatusTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>{{ __('Disk') }}</th>
                            <th>{{ __('Healty') }}</th>
                            <th>{{ __('Amount of Backup') }}</th>
                            <th>{{ __('Last Backup') }}</th>
                            <th>{{ __('Used Storage') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data akan diisi dengan AJAX -->
                    </tbody>
                </table>
                <!-- table -->
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <i class="fa fa-files-o"></i> Backup Files
                </h3>
            </div>
            <div class="box-body">
                <table id="backupStatusFiles" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>{{ __('Path') }}</th>
                            <th>{{ __('Created at') }}</th>
                            <th>{{ __('Size') }}</th>
                            <th style="width: 10%;">{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data akan diisi dengan AJAX -->
                    </tbody>
                </table>
                <!-- table -->
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

@section('style')

@endsection

@section('javascript')
<script>

    $(document).ready(function () {
        // Load initial data
        loadBackupFiles();
        // Fungsi untuk memulai proses pembuatan backup
        $('#createBackupBtn').on('click', function () {
            $.ajax({
                url: '{{ route("settings.backup-create") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    option: 'default' // Ganti dengan opsi yang relevan jika diperlukan
                },
                success: function (response) {
                    alert(response.message); // Tampilkan pesan sukses
                    // Anda bisa menambahkan kode untuk merefresh tabel atau melakukan aksi lain jika diperlukan
                },
                error: function (xhr, status, error) {
                    console.log('Error:', error);
                    alert('Terjadi kesalahan saat memproses pencadangan.');
                }
            });
        });
    });

    function loadBackupFiles() {
        // Get Status
        $.ajax({
            url: '{{ route("settings.backup-status") }}',
            method: 'GET',
            success: function (response) {
                var tableBody = $('#backupStatusTable tbody');
                tableBody.empty(); // Hapus isi tabel sebelum menambahkan data baru

                // Loop melalui data respons untuk mengisi tabel
                $.each(response, function (index, item) {
                    var healthyIcon = item.healthy
                        ? '<i class="fa fa-check-circle" style="color: green;"></i>'
                        : '<i class="fa fa-times-circle" style="color: red;"></i>';

                    var row = `<tr>
                        <td>${item.disk}</td>
                        <td>${healthyIcon}</td>
                        <td>${item.amount}</td>
                        <td>${item.newest}</td>
                        <td>${item.usedStorage}</td>
                    </tr>`;

                    tableBody.append(row);
                });
            },
            error: function (xhr, status, error) {
                console.log('Error:', error);
            }
        });

        // Get Files
        $.ajax({
            url: '{{ route("settings.backup-files") }}',
            method: 'GET',
            success: function (response) {
                var tableBody = $('#backupStatusFiles tbody');
                tableBody.empty(); // Hapus isi tabel sebelum menambahkan data baru

                // Loop melalui data respons untuk mengisi tabel
                $.each(response, function (index, item) {
                    var row = `<tr>
                        <td>${item.path}</td>
                        <td>${item.date}</td>
                        <td>${item.size}</td>
                        <td>
                            <button class="btn btn-sm btn-success btn-sm download-btn" 
                                    data-path="${item.path}" data-disk="local">
                                <i class="fa fa-download" />
                            </button>
                            <button class="btn btn-sm btn-danger btn-sm delete-btn" 
                                data-index="${index}">
                                <i class="fa fa-trash" />
                            </button>
                        </td>
                    </tr>`;

                    tableBody.append(row);
                });

                // Event handler untuk tombol download
                $('.download-btn').on('click', function () {
                    var path = $(this).data('path');
                    var disk = $(this).data('disk'); // Ganti "local" sesuai dengan disk yang digunakan

                    $.ajax({
                        url: '{{ route("settings.backup-download") }}', // Route yang meng-handle download
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}', // Tambahkan CSRF token
                            path: path,
                            disk: disk
                        },
                        xhrFields: {
                            responseType: 'blob' // Agar respons dianggap sebagai file biner
                        },
                        success: function (response, status, xhr) {
                            // Ekstrak nama file dari header "Content-Disposition"
                            var filename = "";
                            var disposition = xhr.getResponseHeader('Content-Disposition');
                            if (disposition && disposition.indexOf('attachment') !== -1) {
                                var matches = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/.exec(disposition);
                                if (matches != null && matches[1]) filename = matches[1].replace(/['"]/g, '');
                            }

                            // Buat URL dari blob dan download file
                            var url = window.URL.createObjectURL(new Blob([response]));
                            var link = document.createElement('a');
                            link.href = url;
                            link.setAttribute('download', filename); // Set nama file yang didownload
                            document.body.appendChild(link);
                            link.click();
                            link.remove();
                            window.URL.revokeObjectURL(url); // Bersihkan URL blob
                        },
                        error: function (xhr, status, error) {
                            console.log('Error:', error);
                        }
                    });
                });

                // Event handler untuk tombol delete
                $('.delete-btn').on('click', function () {
                    var index = $(this).data('index');
                    var row = $(this).closest('tr');
                    var path = row.find('.download-btn').data('path'); // Mendapatkan path dari tombol download di baris yang sama
                    var disk = 'local'; // Pastikan disk yang digunakan sesuai

                    if (confirm('Apakah Anda yakin ingin menghapus file ini?')) {
                        $.ajax({
                            url: '{{ route("settings.backup-delete") }}',
                            method: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}',
                                path: path,
                                disk: disk,
                                index_file: index
                            },
                            success: function (response) {
                                alert(response.message);
                                loadBackupFiles();
                            },
                            error: function (xhr, status, error) {
                                console.log('Error:', error);
                            }
                        });
                    }
                });

            },
            error: function (xhr, status, error) {
                console.log('Error:', error);
            }
        });
    }
</script>
@stop