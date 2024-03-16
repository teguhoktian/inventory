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