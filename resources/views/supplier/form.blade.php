<div class="form-group">
    <label class="col-sm-2 control-label" for="">{{ __('Kode') }}</label>
    <div class="col-sm-10">
        {!! html()->text('kode')->value($kode)->class('form-control' . ($errors->has('kode') ? ' is-invalid' :
        ''))->disabled(true) !!}
        @error('kode')
        <span class="has-error text-sm" role="alert">
            {{ $message }}
        </span>
        @enderror
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label" for="inputName">{{ __('Nama') }}</label>
    <div class="col-sm-10 {{ ($errors->has('nama') ? ' is-invalid' : '') }}">
        {!! html()->text('nama')->class('form-control' . ($errors->has('nama') ? ' is-invalid' : '')) !!}
        @error('nama')
        <span class="has-error text-sm" role="alert">
            {{ $message }}
        </span>
        @enderror
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label" for="">{{ __('Alamat') }}</label>
    <div class="col-sm-10 {{ ($errors->has('nama') ? ' is-invalid' : '') }}">
        {!! html()->text('alamat')->class('form-control' . ($errors->has('alamat') ? ' is-invalid' : '')) !!}
        @error('alamat')
        <span class="has-error text-sm" role="alert">
            {{ $message }}
        </span>
        @enderror
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label" for="">{{ __('HP/Telepon') }}</label>
    <div class="col-sm-10 {{ ($errors->has('nama') ? ' is-invalid' : '') }}">
        {!! html()->text('telepon')->class('form-control' . ($errors->has('telepon') ? ' is-invalid' : '')) !!}
        @error('telepon')
        <span class="has-error text-sm" role="alert">
            {{ $message }}
        </span>
        @enderror
    </div>
</div>