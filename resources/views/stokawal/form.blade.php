<div class="row">
    <div class="col-lg-6">
        <!-- Tanggal Transaksi -->
        <div class="form-group">
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
    <div class="col-lg-6">

        <!-- Kode Nota -->
        <div class="form-group">
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
</div>