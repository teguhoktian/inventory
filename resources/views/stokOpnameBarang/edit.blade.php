@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content">

        {{ Form::model($stokOpnameBarang,
        [
        'route' => ['stok-opname-barang.update', $stokOpnameBarang->id],
        'files' => true,
        'id' => 'moduleForm',
        'class' => 'form-horizontal',
        'method' => 'PATCH'
        ])
        }}

        <div class="box box-solid box-success  box-flat box-shadow">

            <div class="box-header with-border">

                <!-- Box Title -->
                <h3 class="box-title">
                    <i class="fa fa-list"></i>
                    {{__('Stok Opname Baru')}} : {{ $stokOpnameBarang->kode }}
                </h3>
            </div>


            <!-- Form Atas -->
            <div class="box-body">
                @include('stokOpnameBarang.formSatu')

                <div class="">

                    <a href="{{ route('stok-opname-barang.index') }}" class="btn-flat btn btn-default">
                        <i class="fa fa-fast-backward"></i> {{ __('Kembali') }}
                    </a>

                    <button type="submit" id="btbSubmit" class="btn-flat btn btn-primary ">
                        <i class="fa fa-save"></i> {{ __('Selesai') }}
                    </button>

                    <button type="button" onclick="batalCOAction()" href="{{ route('stok-opname-barang.index') }}"
                        class="btn-flat btn btn-danger pull-right">
                        <i class="fa fa-exclamation-triangle"></i> {{ __('Batal') }}
                    </button>
                </div>
            </div>
            {{ Form::close() }}
        </div>


        <div class="box box-solid box-success  box-flat box-shadow">

            <div class="box-header with-border border-top-solid">
                <h4 class="box-title">
                    <span class="text-sm">
                        Pastikan status seluruh stok tidak ada <button class="btn-xs btn btn-danger">
                            <i class="fa fa-exclamation"></i> Stok Fisik blm Input
                        </button>
                    </span>
                </h4>
            </div>

            <!-- Form Bawah -->
            @if($listBarang)
            <div class="box-body with-border">

                <div style="margin-bottom: 1rem;" class="">
                    <button type="button" class="btn btn-flat btn-primary" onclick="downloadSO()">
                        <i class="fa fa-download"></i> {{ __('Download Template .xlxs') }}
                    </button>

                    <button type="button" class="btn btn-warning btn-flat" data-toggle="modal"
                        data-target="#modal-upload">
                        <i class="fa fa-upload"></i> {{ __('Upload File SO') }}
                    </button>
                </div>
                <!-- ./ box-body  -->

                @include('stokOpnameBarang.formTiga')
            </div>
            @endif

            <div class="box-footer with-border">
                <small>Daftar Barang untuk Stock Opname akan ditampilan seluruhnya</small>
            </div>

        </div>

    </div>

    <!-- Cancle CO -->
    {{ Form::model($stokOpnameBarang,
    [
    'route' => ['stok-opname-barang.cancelStokOpname', $stokOpnameBarang->id],
    'files' => true,
    'id' => 'cancelCOForm',
    'class' => 'form-horizontal',
    'method' => 'PATCH'
    ])
    }}
    {{ Form::close() }}

    <!-- Cancle CO -->
    {{ Form::model($stokOpnameBarang,
    [
    'route' => ['stok-opname-barang.download', $stokOpnameBarang->id],
    'files' => true,
    'id' => 'downloadSO',
    'class' => 'form-horizontal',
    'method' => 'POST'
    ])
    }}
    {{ Form::close() }}

    <!-- Modal Upload -->
    {{ Form::open([ 'route' => ['stok-opname-barang.upload', $stokOpnameBarang->id], 'files' => true, 'id' =>
    '', 'class' =>
    'form-horizontal' ]) }}
    <div class="modal fade" id="modal-upload">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">
                        {{ __('Upload File SO') }}
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="upload" class="col-sm-2">
                            {{ __('Pilih File') }}
                        </label>
                        <div class="col-sm-10">
                            <input type="file" name="file_upload" id="" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left btn-flat" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-flat">
                        {{ __('Upload File') }}
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {!! Form::open() !!}
    <!-- /.modal /#modal-upload -->

</div>
<!-- /.content-wrapper -->
@endsection

@section('style')

@endsection


@section('javascript')
<script type="text/javascript">
    var routeIndex = "{{ route('barang.index') }}";

    function batalCOAction() {
        var form = document.getElementById('cancelCOForm');
        //confirm and submit form
        if (confirm('Apakah Anda yakin ingin membatalkan Stok Opname?')) {
            form.submit();
        }
    }

    function downloadSO() {
        var form = document.getElementById('downloadSO');
        form.submit();
    }

    $(function () {

        $('#jenisBarang, #satuanBarang').select2({
            width: "100%",
        });

        $('#tanggal').datepicker({
            autoclose: true,
            format: "yyyy-mm-dd",
            startDate: new Date()
        });

        submitForm('moduleForm', 'btbSubmit');
    });
</script>
@stop