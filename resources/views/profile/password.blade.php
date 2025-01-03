{{ Form::open(['route' => 'profile.update', 'files' => true, 'id' => 'passwordForm', 'class' =>
'form-horizontal' ]) }}
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

<div class="form-group">
    <div class="col-sm-10 col-sm-offset-2">
        {{ Form::submit(__('Update'), ['class' => 'btn-flat btn btn-primary', 'id' =>
        'passwordBtn']) }}
    </div>
</div>
{{ Form::close() }}