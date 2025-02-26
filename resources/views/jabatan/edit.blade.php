@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content">
        <div class="box box-solid box-success box-flat box-shadow">

            <div class="box-header with-border">
                <h2 class="box-title">
                    {{ __('Ubah Data') }}
                </h2>
            </div>

            {!! html()->modelForm($jabatan, 'PATCH', route('jabatan.update', $jabatan->id))
            ->attribute('id', 'moduleForm')
            ->class('form-horizontal')
            ->acceptsFiles()
            ->open() !!}

            <div class="box-body my-form-body">
                @include('jabatan.form')
            </div>

            <div class="box-footer with-border">
                <div class="form-group" style="margin-bottom: 0;">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" id="btbSubmit" class="btn-flat btn btn-primary">
                            <i class="fa fa-save"></i> {{ __('Update') }}
                        </button>

                        <a href="{{ route('jabatan.index') }}" class="btn-flat btn btn-warning">
                            <i class="fa fa-times"></i> {{ __('Cancel') }}
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