<div class="">
    <!-- Kode Transaksi -->
    <div class="form-group">
        <label class="col-sm-3 control-label" for="">{{ __('Kode Transaksi') }}</label>
        <div class="col-sm-9">
            {!! html()->text('kode')->value($kode)->class('form-control' . ($errors->has('kode') ? ' is-invalid' :
            ''))->disabled(true) !!}
            @error('kode')
            <span class="has-error text-sm" role="alert">
                {{ $message }}
            </span>
            @enderror
        </div>
    </div>
    <!-- Tanggal Transaksi -->
    <div class="form-group">
        <label class="col-sm-3 control-label" for="">{{ __('Tanggal Keluar') }}</label>
        <div class="col-sm-9">
            {!! html()->date('tanggal_keluar')->class('form-control' . ($errors->has('tanggal_keluar') ? ' is-invalid' :
            '')) !!}
            @error('tanggal_keluar')
            <span class="has-error text-sm" role="alert">
                {{ $message }}
            </span>
            @enderror
        </div>
    </div>

    <!-- Supplier -->
    <div class="form-group">
        <label class="col-sm-3 control-label" for="">{{ __('Kantor') }}</label>
        <div class="col-sm-9">
            {!! html()->select('id_kantor', $kantor, null)
            ->placeholder('Pilih')
            ->id('kantor')
            ->class('form-control select2') !!}
        </div>
    </div>

    <!-- Kode Nota -->
    <div class="form-group">
        <label class="col-sm-3 control-label" for="">{{ __('PIC') }}</label>
        <div class="col-sm-9">
            {!! html()->select('pic', [], null)
            ->placeholder('Pilih')
            ->id('user')
            ->class('form-control select2') !!}
            @error('pic')
            <span class="has-error text-sm" role="alert">
                {{ $message }}
            </span>
            @enderror
        </div>
    </div>
</div>