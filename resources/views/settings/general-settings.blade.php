@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content">

        <div class="box box-solid box-success">
            <div class="box-header">
                <h2 class="box-title">
                    {{ __('Pengaturan Situs') }}
                </h2>
            </div>

            <div class="box-body">
                {{ Form::open([ 'route' => 'settings.general-settings.store', 'files' => true, 'id' => 'moduleForm',
                'class' =>
                'form-horizontal' ]) }}

                <!-- Sitename -->
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputName">{{ __('Site Name') }}</label>
                    <div class="col-sm-10 {{ ($errors->has('site_name') ? ' is-invalid' : '') }}">
                        {{ Form::text('site_name', $settings->site_name, [ 'class' => 'form-control']) }}

                    </div>
                </div>

                <!-- SiteURL -->
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputName">{{ __('Site URL') }}</label>
                    <div class="col-sm-10 {{ ($errors->has('site_url') ? ' is-invalid' : '') }}">
                        {{ Form::text('site_url', $settings->site_url, [ 'class' => 'form-control']) }}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputName">{{ __('Locale') }}</label>
                    <div class="col-sm-10 {{ ($errors->has('locale') ? ' is-invalid' : '') }}">
                        {{ Form::text('locale', $settings->locale, [ 'class' => 'form-control']) }}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputName">{{ __('Timezone') }}</label>
                    <div class="col-sm-10 {{ ($errors->has('site_name') ? ' is-invalid' : '') }}">
                        {{ Form::text('timezone', $settings->timezone, [ 'class' => 'form-control']) }}

                    </div>
                </div>
            </div>
            <div class="box-footer with-border">
                <a href="{{ route('user.index') }}" class="btn-flat btn-default btn btn-default">
                    &laquo; {{ __('Cancel') }}
                </a>
                <button type="submit" id="btbSubmit" class="btn-flat btn btn-success pull-right">
                    <i class="fa fa-save"></i> {{ __('Update') }}
                </button>
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
    submitForm('moduleForm', 'btbSubmit');
</script>
@stop