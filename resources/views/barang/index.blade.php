@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <x-content-header :title="__('Data Barang')" :subtitle="__('Halaman Daftar Barang')" />

    <div class="content">
        <div class="box border-top-solid">
            <div class="box-header with-border">
                <a href="{{ route('barang.create') }}" class="btn-flat btn btn-success pull-right">
                    <i class="fa fa-plus"></i> {{ __('Tambah') }}
                </a>
            </div>
            <div class="box-body table-responsive">
                <table id="dataTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="1">{{ __('No.') }}</th>
                            <th>{{ __('Kode') }}</th>
                            <th>{{ __('Nama') }}</th>
                            <th>{{ __('Jenis Barang') }}</th>
                            <th>{{ __('Satuan') }}</th>
                            <th>{{ __('Stok') }}</th>
                            <th>{{ __('Posisi Kas') }}</th>
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
    var ajaxRoute = '{{ route("barang.index") }}';
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
            data: 'nama'
        },

        {
            data: 'jenis_barang'
        },
        {
            data: 'satuan'
        },
        {
            data: 'stok'
        },
        {
            data: 'posisi_kas',
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