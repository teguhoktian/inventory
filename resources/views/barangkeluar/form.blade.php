<div class="">
    <!-- Kode Transaksi -->
    <div class="form-group">
        <label class="col-sm-3 control-label" for="">{{ __('Kode Transaksi') }}</label>
        <div class="col-sm-9">
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
    <div class="form-group">
        <label class="col-sm-3 control-label" for="">{{ __('Tanggal Keluar') }}</label>
        <div class="col-sm-9">
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

    <!-- Supplier -->
    <div class="form-group">
        <label class="col-sm-3 control-label" for="">{{ __('Kantor') }}</label>
        <div class="col-sm-9">
            {{ Form::select('id_kantor', $kantor, null, ['placeholder' => 'Pilih ', 'id' => 'kantor',
            'class' =>
            'form-control select2'
            ]) }}
        </div>
    </div>

    <!-- Kode Nota -->
    <div class="form-group">
        <label class="col-sm-3 control-label" for="">{{ __('PIC') }}</label>
        <div class="col-sm-9">
            {{ Form::select('pic', [], null, [
            'placeholder' => 'Pilih User',
            'id' => 'user',
            'class' => 'form-control select2',
            ]) }}
            @error('pic')
            <span class="has-error text-sm" role="alert">
                {{ $message }}
            </span>
            @enderror
        </div>
    </div>
</div>