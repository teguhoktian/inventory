@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-body">
                <div class="col-md-6">
                    <h4>
                        <i class="fa fa-user"></i> 
                        {{ __('Profil') }}
                    </h4>
                </div>
                <!-- /.com-md-6 -->

                <div class="col-md-6 text-right">
                    <a href="{{ route('profile.me') }}" class="btn-flat btn-social btn btn-primary">
                        <i class="fa fa-user"></i> {{ __('Lihat Profil') }}
                    </a>
                </div>
                <!-- /.com-md-6 -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.com-md-12 -->
    </div>
    <!-- /.row -->
    
    <div class="content">
        <div class="box border-top-solid">
			<div class="box-body my-form-body">
                {{ Form::open(['route' => 'profile.update', 'files' => true, 'id' => 'moduleForm', 'class' => 'form-horizontal' ]) }}
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputName">{{ __('Nama') }}</label>
                    <div class="col-sm-9">
                        {{ Form::text('nama', Auth::user()->name, [ 'class' => 'form-control']) }}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputName">{{ __('Username') }}</label>
                    <div class="col-sm-9">
                        {{ Form::text('username', Auth::user()->username, [ 'class' => 'form-control']) }}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputName">{{ __('Email') }}</label>
                    <div class="col-sm-9">
                        {{ Form::text('email', Auth::user()->email, [ 'class' => 'form-control']) }}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputName">{{ __('Password') }}</label>
                    <div class="col-sm-9">
                        {{ Form::password('password', [ 'class' => 'form-control']) }}
                        <span class="help-block">Kosongkan jika tidak diganti</span>
                    </div>
                </div>
               
                <div class="form-group">
                    <div class="col-sm-11">
                        <button type="submit" id="btbSubmit" class="btn-flat btn btn-success pull-right">
                            {{ __('Simpan') }}
                        </button>	
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
