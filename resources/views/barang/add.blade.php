@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content">
        <div class="box box-solid box-success box-shadow box-flat">
            <div class="box-header with-border">
                <h2 class="box-title">{{ __('Tambah Data Barang') }}</h2>
            </div>

            {!! html()->form('POST', route('barang.store'))
            ->attribute('id', 'moduleForm')
            ->class('form-horizontal')
            ->acceptsFiles()
            ->open() !!}

            <div class="box-body">
                @include('barang.form')
            </div>

            <div class="box-footer with-border">
                <div class="form-group" style="margin-bottom: 0px;">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" id="btbSubmit" class="btn-flat btn btn-primary">
                            <i class="fa fa-save"></i> {{ __('Simpan') }}
                        </button>
                        <a href="{{ route('barang.index') }}" class="btn-flat btn btn-default">
                            &laquo; {{ __('Kembali') }}
                        </a>
                    </div>
                </div>
            </div>


            {{ html()->form()->close() }}
        </div>
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

        submitForm("moduleForm", "btbSubmit");

    });
</script>
@stop