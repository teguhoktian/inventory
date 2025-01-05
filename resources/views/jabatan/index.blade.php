@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content">
        <div class="box box-solid box-success box-flat box-shadow">
            <div class="box-header with-border">
                <h2 class="box-title">
                    {{ __('Data Jabatan') }}
                </h2>

            </div>

            <div class="box-body">

                <div class="box-tools">
                    <div class="btn-group" style="margin-bottom: 1rem;">
                        <a href="{{ route('jabatan.create') }}" class="btn-flat btn btn-default">
                            <i class="fa fa-plus"></i> {{ __('Tambah') }}
                        </a>
                    </div>
                </div>

                <table id="dataTable" class="table table-bordered table-striped table-responsive">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('Deskripsi') }}</th>
                            <th>{{ __('Nama Jabatan') }}</th>
                            <th>{{ __('Atasan') }}</th>
                            <th>{{ __('Level') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <!-- /.thead -->
                    <tbody>
                        @foreach ($jabatans as $jabatan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                {{ str_repeat('---', $jabatan->level - 1) }} {{ $jabatan->deskripsi }}
                            </td>
                            <td>{{ $jabatan->nama_jabatan }}</td>
                            <td>{{ $jabatan->parent_name }}</td>
                            <td>{{ $jabatan->level }}</td>
                            <td>
                                @include('jabatan.action')
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <!-- /.tbody -->
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

    function submitDelete(ID) {
        swal({
            title: "{{ __('Kofirmasi') }}",
            text: "{{ __('Anda Yakin?') }}",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes",
            cancelButtonText: "Cancel",
            closeOnCancel: false,
            closeOnConfirm: false
        }, function (isConfirm) {
            if (isConfirm) {

                var form = $('#' + ID);
                var _url = form.attr('action');
                var _method = form.attr('method');
                var data = form.serialize();

                $.ajax({
                    url: _url,
                    type: _method,
                    data: data,
                    dataType: "json",
                    success: function (data) {
                        swal("{{ __('Hapus Data') }}", "{{ __('Data Berhasil dihapus') }}", "info");
                        location.reload();
                    }
                });
            } else {
                swal("Cancelled", "Action has cancelled", "error");
            }
        });
    }
</script>
@stop