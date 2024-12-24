@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content">
        <div class="box box-solid box-success">
            <div class="box-header">
                <h2 class="box-title">{{ __('Edit Pengguna') }}</h2>
            </div>

            {{ Form::model($user,
            [
            'route' => ['user.update', $user->id],
            'files' => true,
            'id' => 'moduleForm',
            'class' => 'form-horizontal',
            'method' => 'PATCH'
            ])
            }}

            <div class="box-body">
                @include('user.form')
            </div>

            <div class="box-footer with-border">
                <div class="form-group" style="margin-bottom: 0;">
                    <div class="col-sm-offset-2 col-sm-10">

                        <button type="submit" id="btbSubmit" class="btn-flat btn btn-primary ">
                            <i class="fa-save fa"></i> {{ __('Update') }}
                        </button>

                        <a href="{{ route('user.create') }}" class="btn-flat btn-warning btn">
                            <i class="fa fa-plus"></i> {{ __('Tambah user baru') }}
                        </a>

                        <a href="{{ route('user.index') }}" class="btn-flat btn-danger btn">
                            <i class="fa fa-times"></i> {{ __('Cancel') }}
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