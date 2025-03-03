@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content">
        <div class="box box-solid box-success box-flat box-shadow">
            <div class="box-header with-border">
                <h3 class="box-title">{{ __('Daftar Stok Opname') }}</h3>
                <div class="box-tools">

                </div>
            </div>
            <div class="box-body">
                <div style="margin-bottom: 1rem;">
                    <div class="btn-group">
                        <a href="{{ route('stok-opname-barang.create') }}" class="btn-flat btn btn-primary">
                            <i class="fa fa-plus"></i> {{ __('Lakukan SO') }}
                        </a>
                    </div>
                </div>

                <div class="table-responsive">
                    {{ $dataTable->table(['class' => 'table table-striped table-bordered']) }}
                </div>
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
<link href="adminLTE/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('javascript')
<script src="adminLTE/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="adminLTE/plugins/datatables/responsive.bootstrap.min.js"></script>
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
                        $("#stokopnamebarang-table").DataTable().ajax.reload();
                    }
                });
            } else {
                swal("Cancelled", "Action has cancelled", "error");
            }
        });
    }
</script>
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@stop