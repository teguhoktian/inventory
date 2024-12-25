@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content">

        {{ Form::open([ 'route' => 'stok-opname-barang.store', 'files' => true, 'id' => 'moduleForm', 'class'
        =>'form-horizontal' ]) }}

        <div class="box box-solid box-success">

            <div class="box-header with-border">

                <!-- Box Title -->
                <h3 class="box-title">
                    <i class="fa fa-list"></i>
                    {{__('Stok Opname')}}
                </h3>

            </div>

            <!-- Form Atas -->
            <div class="box-body">
                @include('stokOpnameBarang.formSatu')
                <div class="">
                    <a href="{{ route('stok-opname-barang.index') }}" class="btn-flat pull-right btn btn-danger">
                        &laquo; {{ __('Kembali') }}
                    </a>
                    <button type="submit" id="btbSubmit" class="btn-flat btn btn-primary ">
                        <i class="fa fa-save"></i> {{ __('Simpan') }}
                    </button>
                </div>
            </div>
        </div>


        <div class="box box-solid box-success">
            <div class="box-header with-border border-top-solid">
                <h4 class="box-title">
                    <span>{{ __('Daftar Barang') }}</span>
                </h4>
            </div>

            <!-- Form Bawah -->
            @if($listBarang)
            <div class="box-body with-border">
                @include('stokOpnameBarang.formDua')
            </div>
            @endif

            <div class="box-footer with-border">
                <small>Daftar Barang untuk Stock Opname akan ditampilan seluruhnya</small>
            </div>

        </div>
        {{ Form::close() }}
    </div>
</div>
<!-- /.content-wrapper -->
@endsection

@section('style')

@endsection


@section('javascript')
<script type="text/javascript">
    var routeIndex = "{{ route('barang.index') }}";
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