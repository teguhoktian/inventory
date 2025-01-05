<div class="form-group">
    <label class="col-sm-2 control-label" for="inputName">{{ __('Nama Jabatan') }}</label>
    <div class="col-sm-10 {{ ($errors->has('nama_jabatan') ? ' is-invalid' : '') }}">
        {{ Form::text('nama_jabatan', null, [ 'class' => 'form-control']) }}
        @error('nama_jabatan')
        <span class="has-error text-sm" role="alert">
            {{ $message }}
        </span>
        @enderror
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label" for="inputName">{{ __('Induk') }}</label>
    <div class="col-sm-10">
        <select name="parent_id" class="form-control">
            <option value="null">None</option>
            @foreach ($jabatans as $data)
            <option value="{{ $data->id }}" {{ ($jabatan && $jabatan->parent_id == $data->id) ? 'selected' : '' }}>
                {{ str_repeat('---', $data->level - 1) }} {{ $data->nama_jabatan }}
            </option>
            @endforeach
        </select>
    </div>

    @error('parent_id')
    <span class="has-error text-sm" role="alert">
        {{ $message }}
    </span>
    @enderror
</div>

<div class="form-group">
    <label class="col-sm-2 control-label" for="">{{ __('Deskripsi') }}</label>
    <div class="col-sm-10 {{ ($errors->has('kode') ? ' is-invalid' : '') }}">
        {{ Form::text('deskripsi', null, [ 'class' => 'form-control']) }}
        @error('deskripsi')
        <span class="has-error text-sm" role="alert">
            {{ $message }}
        </span>
        @enderror
    </div>
</div>