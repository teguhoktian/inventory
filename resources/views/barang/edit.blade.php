@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content">
        <div class="box box-solid box-success box-flat box-shadow">

            <div class="box-header with-border">
                <h2 class="box-title">
                    {{ __('Edit Data Barang') }}
                </h2>
                <!-- ./ box-title -->
            </div>
            <!-- ./ box-header box-title -->

            {!! html()->modelForm($barang, 'PATCH', route('barang.update', $barang->id))
            ->attribute('id', 'moduleForm')
            ->class('form-horizontal')
            ->acceptsFiles()
            ->open() !!}

            <div class="box-body my-form-body">

                @include('barang.form')

            </div>

            <div class="box-footer with-header">

                <div class="form-group" style="margin-bottom: 0px;">
                    <div class="col-sm-offset-2 col-sm-10">

                        <button type="submit" id="btbSubmit" class="btn-flat btn btn-primary">
                            <i class="fa fa-save"></i> {{ __('Update') }}
                        </button>

                        <a href="{{ route('barang.show', ['barang' => $barang->id]) }}"
                            class="btn-flat btn btn-warning">
                            <i class="fa fa-sticky-note-o"></i> {{ __('Kartu Stok') }}
                        </a>

                        <a href="{{ route('barang.create') }}" class="btn-flat btn btn-success">
                            <i class="fa fa-plus"></i> {{ __('Tambah barang') }}
                        </a>

                        <a href="{{ route('barang.index') }}" class="btn-flat btn btn-danger pull-right">
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