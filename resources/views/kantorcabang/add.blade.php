@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content">
        <div class="box box-solid box-success box-flat box-shadow">

            <div class="box-header with-border">
                <h2 class="box-title">
                    {{ __('Tambah Data') }}
                </h2>

            </div>

            {{ Form::open([ 'route' => 'kantor-cabang.store', 'files' => true, 'id' => 'moduleForm', 'class' =>
            'form-horizontal' ]) }}

            <div class="box-body">
                @include('kantorcabang.form')
            </div>

            <div class="box-footer with-border">
                <div class="form-group" style="margin-bottom: 0;">
                    <div class="col-sm-offset-2 col-sm-10">

                        <button type="submit" id="btbSubmit" class="btn-flat btn btn-primary">
                            <i class="fa fa-save"></i> {{ __('Simpan') }}
                        </button>

                        <a href="{{ route('kantor-cabang.index') }}" class="btn-flat btn btn-danger">
                            <i class="fa fa-times"></i> {{ __('Batal') }}
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
    var routeIndex = "{{ route('kantor-cabang.index') }}";

    $(function () {
        submitForm("moduleForm", "btbSubmit");
    });
</script>
@stop