@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <x-content-header :title="__('Buat Stok Opname')" :subtitle="__('')" />

    <div class="content">

        <div class="box border-top-solid">
            {{ Form::model($stokOpnameBarang,
            [
            'route' => ['stok-opname-barang.update', $stokOpnameBarang->id],
            'files' => true,
            'id' => 'moduleForm',
            'class' => 'form-horizontal',
            'method' => 'PATCH'
            ])
            }}
            <div class="box-header with-border">

                <!-- Box Title -->
                <h3 class="box-title">
                    <i class="fa fa-list"></i>
                    {{__('Stok Opname Baru')}}
                </h3>


                <div class="box-tools pull-right">
                    <div class="btn-group">
                        <button type="submit" id="btbSubmit" class="btn-flat btn btn-success ">
                            <i class="fa fa-save"></i> {{ __('Selesai') }}
                        </button>
                        <button type="button" onclick="batalCOAction()" href="{{ route('stok-opname-barang.index') }}"
                            class="btn-flat btn btn-danger">
                            <i class="fa fa-exclamation-triangle"></i> {{ __('Batal') }}
                        </button>
                        <a href="{{ route('stok-opname-barang.index') }}" class="btn-flat btn btn-default">
                            <i class="fa fa-fast-backward"></i> {{ __('Kembali') }}
                        </a>
                    </div>
                </div>
            </div>


            <!-- Form Atas -->
            <div class="box-body">
                @include('stokOpnameBarang.formSatu')
            </div>
            {{ Form::close() }}


            <div class="box-header with-border border-top-solid">
                <h4 class="box-title">
                    <small>
                        Pastikan status seluruh stok tidak ada <button class="btn-xs btn btn-danger">
                            <i class="fa fa-exclamation"></i> Stok Fisik blm Input
                        </button>
                    </small>
                </h4>
            </div>

            <!-- Form Bawah -->
            @if($listBarang)
            <div class="box-body with-border">
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