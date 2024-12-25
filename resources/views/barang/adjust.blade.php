@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content">
        <div class="box box-solid box-success box-flat box-shadow">
            <div class="box-header with-border">
                <h2 class="box-title">
                    {{ __('Adjusment Stok') }}
                </h2>
            </div>
            {{ Form::model($barang,
            [
            'route' => ['barang.adjust-stok-store', $barang->id],
            'files' => true,
            'id' => 'moduleForm',
            'class' => 'form-horizontal',
            'method' => 'POST'
            ])
            }}

            {{
            Form::hidden('harga', $barang->harga)
            }}
            <div class="box-body">

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputName">{{ __('Kode') }}</label>
                    <div class="col-sm-10">
                        {{ Form::text('kode', null, [ 'class' => 'form-control' ,'disabled']) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputName">{{ __('Nama') }}</label>
                    <div class="col-sm-10">
                        {{ Form::text('nama', null, [ 'class' => 'form-control' ,'disabled']) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputName">{{ __('Stok Akhir') }}</label>
                    <div class="col-sm-10">
                        {{ Form::text('stok', null, [ 'class' => 'form-control' ,'disabled']) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputName">{{ __('Harga') }}</label>
                    <div class="col-sm-10">
                        {{ Form::text('harga', null, [ 'class' => 'form-control' ,'disabled']) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputName">{{ __('Stok Penyesuaian') }}</label>
                    <div class="col-sm-10">
                        {{ Form::number('stok_penyesuaian', null, [ 'class' => 'form-control', 'min' => '0']) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputName">{{ __('Tipe Penyesuaian') }}</label>
                    <div class="col-sm-10">
                        {{ Form::select('tipe_penyesuaian', ['Masuk' => 'Masuk', 'Keluar' => 'Keluar'], null,
                        ['placeholder' => 'Pilih ', 'class' => 'form-control'
                        ]) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputName">{{ __('Keterangan') }}</label>
                    <div class="col-sm-10">
                        {{ Form::textarea('keterangan', null, ['class' => 'form-control ' ,
                        'rows' => '3']) }}
                    </div>
                </div>
            </div>
            <div class="box-footer with-border">

                <div class="form-group" style="margin-bottom: 0px;">
                    <div class="col-sm-offset-2 col-sm-10">
                        <a href="{{ route('barang.show', $barang->id) }}" class="btn-flat btn btn-danger pull-right">
                            &laquo; {{ __('Kembali') }}
                        </a>

                        <button type="submit" id="btbSubmit" class="btn-flat btn btn-primary">
                            <i class="fa fa-save"></i> {{ __('Update') }}
                        </button>
                    </div>
                </div>


            </div>
            {{ Form::close() }}
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

        submitForm('moduleForm', 'btbSubmit');

    });
</script>
@stop