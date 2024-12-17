<div class="form-group">
    <label class="col-sm-2 control-label" for="inputName">{{ __('Nama') }}</label>
    <div class="col-sm-10 {{ ($errors->has('nama') ? ' is-invalid' : '') }}">
        {{ Form::text('nama', null, [ 'class' => 'form-control']) }}
        @error('nama')
        <span class="has-error text-sm" role="alert">
            {{ $message }}
        </span>
        @enderror
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label" for="">{{ __('Kode') }}</label>
    <div class="col-sm-10 {{ ($errors->has('kode') ? ' is-invalid' : '') }}">
        {{ Form::text('kode', null, [ 'class' => 'form-control']) }}
        @error('kode')
        <span class="has-error text-sm" role="alert">
            {{ $message }}
        </span>
        @enderror
    </div>
</div>