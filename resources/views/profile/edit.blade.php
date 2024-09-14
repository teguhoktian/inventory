@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <x-content-header :title="__('Edit Profile')" :subtitle="__('')" />
    <div class="content">
        <div class="box border-top-solid">
            <div class="box-body">
                {{ Form::open(['route' => 'profile.update', 'files' => true, 'id' => 'moduleForm', 'class' =>
                'form-horizontal' ]) }}
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputName">{{ __('Nama') }}</label>
                    <div class="col-sm-10">
                        {{ Form::text('name', Auth::user()->name, [ 'class' => 'form-control']) }}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputName">{{ __('Username') }}</label>
                    <div class="col-sm-10">
                        {{ Form::text('username', Auth::user()->username, [ 'class' => 'form-control']) }}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputName">{{ __('Email') }}</label>
                    <div class="col-sm-10">
                        {{ Form::text('email', Auth::user()->email, [ 'class' => 'form-control']) }}
                    </div>
                </div>

                <div class="form-group @error('password') has-error @enderror">
                    <label class="col-sm-2 control-label" for="inputName">
                        {{ __('Password') }}

                    </label>
                    <div class="col-sm-10">
                        {{ Form::password('password', [ 'class' => 'form-control']) }}
                        @error('password')
                        <span class="help-block text-sm" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                        <span class="help-block text-sm">{{ __('Kosongkan jika tidak diganti') }}</span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputName">{{ __('Konfirm. Password') }}</label>
                    <div class="col-sm-10">
                        {{ Form::password('password_confirmation', [ 'class' => 'form-control']) }}
                    </div>
                </div>
            </div>
            <div class="box-footer with-border">

                <a href="{{ route('profile.me') }}" class="btn btn-default">
                    {{ __('Kembali') }}
                </a>
                <button type="submit" id="btbSubmit" class="pull-right btn btn-success">
                    {{ __('Simpan') }}
                </button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection