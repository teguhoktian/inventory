@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class=" content">

        <div class="box box-solid box-success">

            <div class="box-header with-border">
                <h3 class="box-title"> {{ __('Barang Masuk') }} </h3>
            </div>
            <!-- ./box-header -->

            <div class="box-body">
                <div style="margin-bottom: 1rem;">
                    <a href="{{ route('barang-masuk.create') }}" class="btn btn-primary btn-flat">
                        <i class="fa fa-plus"></i> {{ __('Tambah') }}
                    </a>
                </div>
                <table id="dataTable" class="table table-bordered table-striped table-responsive">
                    <thead>
                        <tr>
                            <th width="1">{{ __('No.') }}</th>
                            <th>{{ __('Kode') }}</th>
                            <th>{{ __('Tanggal') }}</th>
                            <th>{{ __('No. Faktur') }}</th>
                            <th>{{ __('Supplier') }}</th>
                            <th>{{ __('Items') }}</th>
                            <th>{{ __('Total Harga') }}</th>
                            <th>{{ __('Aksi') }}</th>
                        </tr>
                    </thead>
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
<link href="adminLTE/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('javascript')
<script src="adminLTE/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="adminLTE/plugins/datatables/responsive.bootstrap.min.js"></script>
<script>
    var table = '';
    var ajaxRoute = '{{ route("barang-masuk.index") }}';
    table = $('#dataTable').DataTable({
        processing: true,
        serverSide: true,
        autoWidth: false,
        responsive: true,
        ajax: ajaxRoute,
        columns: [{
            data: 'DT_RowIndex',
            sortable: false,
            searchable: false
        },
        {
            data: 'kode'
        },

        {
            data: 'tanggal_masuk'
        },

        {
            data: 'no_faktur'
        },

        {
            data: 'supplier'
        },
        {
            data: 'detail_count',
            sortable: false,
            searchable: false
        },
        {
            data: 'total_harga',
            sortable: false,
            searchable: false
        },
        {
            data: 'action',
            sortable: false,
            searchable: false
        }
        ]
    });

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
                        table.ajax.reload();
                    }
                });
            } else {
                swal("Cancelled", "Action has cancelled", "error");
            }
        });
    }
</script>
@stop