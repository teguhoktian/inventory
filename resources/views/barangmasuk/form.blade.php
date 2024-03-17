<div class="row">
    <!-- Kode Transaksi -->
    <div class="col-lg-6">
        <label class="col-sm-4 control-label" for="">{{ __('Kode Transaksi') }}</label>
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

    <!-- Tanggal Transaksi -->
    <div class="col-lg-6">
        <label class="col-sm-4 control-label" for="">{{ __('Tanggal Masuk') }}</label>
        <div class="col-sm-8">
            {{ Form::text('tanggal_masuk', null,
            [
            'class' => 'form-control ' . ($errors->has('tanggal_masuk') ? ' is-invalid' : ''),
            'id' => 'tanggal_masuk'
            ]
            ) }}
            @error('tanggal_masuk')
            <span class="has-error text-sm" role="alert">
                {{ $message }}
            </span>
            @enderror
        </div>
    </div>
</div>
<br>
<div class="row">
    <!-- Supplier -->
    <div class="col-lg-6">
        <div class="form-group">
            <label class="col-sm-4 control-label" for="">{{ __('Supplier') }}</label>
            <div class="col-sm-8">
                {{ Form::select('id_supplier', $supplier, null, ['placeholder' => 'Pilih ', 'id' => 'supplier',
                'class' =>
                'form-control'
                ]) }}
            </div>
        </div>
    </div>

    <!-- Kode Nota -->
    <div class="col-lg-6">
        <label class="col-sm-4 control-label" for="">{{ __('No. Faktur') }}</label>
        <div class="col-sm-8">
            {{ Form::text('no_faktur', null, ['class' => 'form-control ' . ($errors->has('no_faktur') ? ' is-invalid' :
            '') ]) }}
            @error('no_faktur')
            <span class="has-error text-sm" role="alert">
                {{ $message }}
            </span>
            @enderror
        </div>
    </div>

</div>