<div class="row">
    <div class="col-md-6">

        <div class="form-group">
            <label class="col-md-3">{{ __('Nama') }}</label>
            <div class="col-md-9">
                {{ Form::text('nama', null, ['class' => 'form-control ' . ($errors->has('nama') ? ' is-invalid' : '') ,
                '' => ' ']) }}
                @error('nama')
                <span class="has-error text-sm" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-3">{{ __('Tanggal') }}</label>
            <div class="col-md-9">
                {{ Form::text('tanggal', null, ['class' => 'form-control ' . ($errors->has('tanggal') ? ' is-invalid' :
                ''),'id' => 'tanggal']) }}
                @error('tanggal')
                <span class="has-error text-sm" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
        </div>


        <div class="form-group">
            <label class="col-md-3">{{ __('Petugas') }}</label>
            <div class="col-md-9">
                {{ Form::text('petugas', null, ['class' => 'form-control ' .
                ($errors->has('nama') ? ' is-invalid' : '') ,
                'disabled' => 'disabled']) }}
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label class="col-md-3">{{ __('Keterangan') }}</label>
            <div class="col-md-9">
                {{ Form::textarea('keterangan', null, ['class' => 'form-control ' . ($errors->has('keterangan') ? '
                is-invalid' :
                '') ,
                'rows' => '6']) }}
                @error('keterangan')
                <span class="has-error text-sm" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
        </div>
    </div>

</div>