<div class="form-group">
    <label class="col-sm-2 control-label" for="">{{ __('Kode') }}</label>
    <div class="col-sm-10">

        {!! html()->text('kode')->class('form-control')->disabled(true) !!}

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
        {!! html()->text('nama')->class('form-control') !!}

        @error('nama')
        <span class="has-error text-sm" role="alert">
            {{ $message }}
        </span>
        @enderror
    </div>
</div>

<!-- Jenis Barang -->
<div class="form-group">
    <label class="col-sm-2 control-label" for="">{{ __('Jenis Barang') }}</label>
    <div class="col-sm-10">
        {!! html()->select('id_jenis', $jenisBarang)
        ->placeholder('Pilih')
        ->id('jenisBarang')
        ->class('form-control') !!}
    </div>
</div>

<!-- Satuan Barang -->
<div class="form-group">
    <label class="col-sm-2 control-label" for="">{{ __('Satuan') }}</label>
    <div class="col-sm-10">
        {!! html()->select('id_satuan', $satuanBarang)
        ->placeholder('Pilih')
        ->id('satuanBarang')
        ->class('form-control') !!}
    </div>
</div>