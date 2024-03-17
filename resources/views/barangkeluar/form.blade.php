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
        <label class="col-sm-4 control-label" for="">{{ __('Tanggal Keluar') }}</label>
        <div class="col-sm-8">
            {{ Form::text('tanggal_keluar', null,
            [
            'class' => 'form-control ' . ($errors->has('tanggal_keluar') ? ' is-invalid' : ''),
            'id' => 'tanggal_keluar'
            ]
            ) }}
            @error('tanggal_keluar')
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
            <label class="col-sm-4 control-label" for="">{{ __('Kantor') }}</label>
            <div class="col-sm-8">
                {{ Form::select('id_kantor', $kantor, null, ['placeholder' => 'Pilih ', 'id' => 'kantor',
                'class' =>
                'form-control'
                ]) }}
            </div>
        </div>
    </div>

    <!-- Kode Nota -->
    <div class="col-lg-6">
        <label class="col-sm-4 control-label" for="">{{ __('PIC') }}</label>
        <div class="col-sm-8">
            {{ Form::text('pic', null, ['class' => 'form-control ' . ($errors->has('no_faktur') ? ' is-invalid' :
            '') ]) }}
            @error('pic')
            <span class="has-error text-sm" role="alert">
                {{ $message }}
            </span>
            @enderror
        </div>
    </div>

</div>