{{ Form::open(['route' => 'profile.update', 'files' => true, 'id' => 'personalForm', 'class' =>
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

<div class="form-group">
    <div class="col-sm-10 col-sm-offset-2">
        {{ Form::submit(__('Update'), ['class' => 'btn-flat btn btn-primary', 'id' => 'personalBtn']) }}
    </div>
</div>
{{ Form::close() }}