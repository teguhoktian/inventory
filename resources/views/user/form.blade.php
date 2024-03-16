<div class="form-group">
    <label class="col-sm-3 control-label" for="inputName">{{ __('Nama Lengkap') }}</label>
    <div class="col-sm-8 {{ ($errors->has('name') ? ' is-invalid' : '') }}">
        {{ Form::text('name', null, [ 'class' => 'form-control']) }}
        @error('name')
        <span class="has-error text-sm" role="alert">
            {{ $message }}
        </span>
        @enderror
    </div>
</div>
<div class="form-group">
    <label class="col-sm-3 control-label" for="inputName">{{ __('Email') }}</label>
    <div class="col-sm-8">
        {{ Form::text('email', null, ['class' => 'form-control ' . ($errors->has('email') ? ' is-invalid' : '')]) }}
        @error('email')
        <span class="has-error text-sm" role="alert">
            {{ $message }}
        </span>
        @enderror
    </div>
</div>
<div class="form-group">
    <label class="col-sm-3 control-label" for="inputName">{{ __('Username') }}</label>
    <div class="col-sm-8">
        {{ Form::text('username', null, ['class' => 'form-control ' . ($errors->has('username') ? ' is-invalid' : '')]) }}
        @error('username')
        <span class="has-error text-sm" role="alert">
            {{ $message }}
        </span>
        @enderror
    </div>
</div>
<div class="form-group">
    <label class="col-sm-3 control-label" for="inputName">{{ __('Password') }}</label>
    <div class="col-sm-8">
        {{ Form::password('password', ['class' => 'form-control ' . ($errors->has('password') ? ' is-invalid' : '')]) }}
        @error('password')
        <span class="has-error text-sm" role="alert">
            {{ $message }}
        </span>
        @enderror
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 control-label" for="inputName">{{ __('Hak Akses') }}</label>
    <div class="col-sm-8">
        {{ Form::select('roles', $roles, null, ['placeholder' => 'Pilih ', 'id' => 'select2', 'class' => 'form-control' ]) }}
    </div>
</div>