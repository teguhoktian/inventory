<div class="form-group">
    <label class="col-sm-3 control-label" for="">{{ __('Kode') }}</label>
    <div class="col-sm-8">
        {{ Form::text('kode', $kode, ['class' => 'form-control ' . ($errors->has('kode') ? ' is-invalid' : '') ,
        'disabled' => 'disabled']) }}
        @error('kode')
        <span class="has-error text-sm" role="alert">
            {{ $message }}
        </span>
        @enderror
    </div>
</div>
<div class="form-group">
    <label class="col-sm-3 control-label" for="inputName">{{ __('Nama') }}</label>
    <div class="col-sm-8 {{ ($errors->has('nama') ? ' is-invalid' : '') }}">
        {{ Form::text('nama', null, [ 'class' => 'form-control']) }}
        @error('nama')
        <span class="has-error text-sm" role="alert">
            {{ $message }}
        </span>
        @enderror
    </div>
</div>
<div class="form-group">
    <label class="col-sm-3 control-label" for="">{{ __('Alamat') }}</label>
    <div class="col-sm-8 {{ ($errors->has('nama') ? ' is-invalid' : '') }}">
        {{ Form::text('alamat', null, [ 'class' => 'form-control']) }}
        @error('alamat')
        <span class="has-error text-sm" role="alert">
            {{ $message }}
        </span>
        @enderror
    </div>
</div>
<div class="form-group">
    <label class="col-sm-3 control-label" for="">{{ __('HP/Telepon') }}</label>
    <div class="col-sm-8 {{ ($errors->has('nama') ? ' is-invalid' : '') }}">
        {{ Form::text('telepon', null, [ 'class' => 'form-control']) }}
        @error('telepon')
        <span class="has-error text-sm" role="alert">
            {{ $message }}
        </span>
        @enderror
    </div>
</div>