<div class="form-group">
    <label class="col-sm-2 control-label" for="inputName">{{ __('Nama Lengkap') }}</label>
    <div class="col-sm-10 {{ ($errors->has('name') ? ' is-invalid' : '') }}">
        {!! html()->text('name')
        ->class('form-control')
        ->placeholder('Enter your name') !!}
        @error('name')
        <span class="has-error text-sm" role="alert">
            {{ $message }}
        </span>
        @enderror
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label" for="inputName">{{ __('Email') }}</label>
    <div class="col-sm-10">
        {!! html()->text('email')
        ->class('form-control' . ($errors->has('email') ? ' is-invalid' : '')) !!}
        @error('email')
        <span class="has-error text-sm" role="alert">
            {{ $message }}
        </span>
        @enderror
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label" for="inputName">{{ __('Username') }}</label>
    <div class="col-sm-10">
        {!! html()->text('username')
        ->class('form-control' . ($errors->has('username') ? ' is-invalid' : '')) !!}
        @error('username')
        <span class="has-error text-sm" role="alert">
            {{ $message }}
        </span>
        @enderror
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label" for="inputName">{{ __('Password') }}</label>
    <div class="col-sm-10">
        {!! html()->password('password')
        ->class('form-control' . ($errors->has('password') ? ' is-invalid' : '')) !!}
        @error('password')
        <span class="has-error text-sm" role="alert">
            {{ $message }}
        </span>
        @enderror
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label" for="inputName">{{ __('Status') }}</label>
    <div class="col-sm-10">
        {!! html()->select('status', [
        'active' => __('Aktif'),
        'inactive' => __('Nonaktif')
        ], old('status'))
        ->placeholder('Pilih')
        ->id('')
        ->class('form-control') !!}
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label" for="inputName">{{ __('Hak Akses') }}</label>
    <div class="col-sm-10">
        {!! html()->select('roles', $roles)
        ->placeholder('Pilih')
        ->id('select2')
        ->class('form-control') !!}
    </div>
</div>

<!-- <div class="form-group">
    <label class="col-sm-2 control-label" for="inputName">{{ __('Kantor Cabang') }}</label>
    <div class="col-sm-10">
        {!! html()->select('cabangs[]', $cabangs, old('cabangs'))
    ->multiple()
    ->id('select21')
    ->class('form-control') !!}
    </div>
</div> -->