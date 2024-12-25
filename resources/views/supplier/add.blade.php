@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <div class="content">
        <div class="box box-solid box-success box-flat box-shadow">
            <div class="box-header">
                <h2 class="box-title">
                    {{ __('Tambah Data') }}
                </h2>
            </div>
            {{ Form::open([ 'route' => 'supplier.store', 'files' => true, 'id' => 'moduleForm', 'class' =>
            'form-horizontal' ]) }}
            <div class="box-body my-form-body">

                @include('supplier.form')

            </div>

            <div class="box-footer with-border">
                <div class="form-group" style="margin-bottom: 0;">
                    <div class="col-sm-offset-2 col-sm-10">

                        <button type="submit" id="btbSubmit" class="btn-flat btn btn-success">
                            <i class="fa fa-save"></i> {{ __('Simpan') }}
                        </button>

                        <a href="{{ route('supplier.index') }}" class="btn-flat btn btn-danger pull-right">
                            &laquo; {{ __('Kembali') }}
                        </a>
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
    $(function () {
        submitForm("moduleForm", "btbSubmit");
    });
</script>
@stop