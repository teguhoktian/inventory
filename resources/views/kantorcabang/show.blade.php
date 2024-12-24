@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content">
        <div class="box box-solid box-success box-flat box-shadow">

            <div class="box-header with-border">
                <h2 class="box-title">
                    {{ __('Detail Kantor') }}
                </h2>

            </div>

            <form class="form-horizontal">
                <div class="box-body">

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="">{{ __('Kode') }}</label>
                        <div class="col-sm-10 {{ ($errors->has('kode') ? ' is-invalid' : '') }}">
                            {{ Form::text('nama', $kantorCabang->kode, [ 'class' => 'form-control', 'disabled'
                            =>
                            'disabled']) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="inputName">{{ __('Nama') }}</label>
                        <div class="col-sm-10 {{ ($errors->has('nama') ? ' is-invalid' : '') }}">
                            {{ Form::text('nama', $kantorCabang->nama, [ 'class' => 'form-control', 'disabled' =>
                            'disabled']) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="inputName">{{ __('Induk') }}</label>
                        <div class="col-sm-10">
                            {{ Form::text('nama', $kantorCabang->parent_text, [
                            'class' => 'form-control', 'disabled'
                            =>
                            'disabled']) }}
                        </div>
                    </div>

                </div>

                <div class="box-footer with-border">
                    <div class="form-group" style="margin-bottom: 0;">
                        <div class="col-sm-offset-2 col-sm-10">

                            <a href="{{ route('kantor-cabang.edit', ['kantor_cabang' => $kantorCabang->id]) }}"
                                class="btn-flat btn btn-primary">
                                <i class="fa fa-edit"></i> {{ __('Edit') }}
                            </a>

                            <a href="{{ route('kantor-cabang.index') }}" class="btn-flat btn btn-danger">
                                <i class="fa fa-times"></i> {{ __('Kembali') }}
                            </a>

                        </div>
                    </div>
                </div>
            </form>
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
    $(function () { });
</script>
@stop