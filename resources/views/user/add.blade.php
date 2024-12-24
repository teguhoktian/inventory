@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content">
        <div class="box box-solid box-success box-flat box-shadow">
            <div class="box-header">
                <h3 class="box-title">{{ __('Tambah Pengguna') }}</h3>
            </div>
            {{ Form::open([ 'route' => 'user.store', 'files' => true, 'id' => 'moduleForm', 'class' =>
            'form-horizontal' ]) }}
            <div class="box-body">
                @include('user.form')
            </div>
            <div class="box-footer with-border">
                <div class="form-group" style="margin-bottom: 0;">
                    <div class="col-sm-offset-2 col-sm-10">


                        <button type="submit" id="btbSubmit" class="btn-flat btn btn-primary">
                            <i class="fa fa-save"></i> {{ __('Simpan') }}
                        </button>

                        <a href="{{ route('user.index') }}" class="btn-flat btn-danger btn">
                            <i class="fa fa-time"></i> {{ __('Cancel') }}
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
    var routeIndex = "{{ route('user.index') }}";
    $(function () {

        submitForm("moduleForm", "btbSubmit");

        $('#select2, #select21').select2({
            with: '100%'
        });
    });
</script>
@stop