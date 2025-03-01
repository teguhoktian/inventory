@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <div class="content">
        <div class="box box-solid box-success box-flat box-shadow">
            <div class="box-header">
                <h2 class="box-title">
                    {{ __('Ubah Satuan Barang') }}
                </h2>
            </div>

            {!! html()->modelForm($satuanBarang, 'PATCH', route('satuan-barang.update', $satuanBarang->id))
            ->attribute('id', 'moduleForm')
            ->class('form-horizontal')
            ->acceptsFiles()
            ->open() !!}

            <div class="box-body my-form-body">

                @include('satuanbarang.form')

            </div>

            <div class="box-footer with-border">
                <div class="form-group" style="margin-bottom: 0;">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" id="btbSubmit" class="btn-flat btn btn-primary">
                            <i class="fa fa-save"></i> {{ __('Simpan') }}
                        </button>
                        <a href="{{ route('satuan-barang.index') }}" class="btn-flat btn btn-danger pull-right">
                            &laquo; {{ __('Back') }}
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
    $(function () {
        submitForm("moduleForm", "btbSubmit");
    });
</script>
@stop