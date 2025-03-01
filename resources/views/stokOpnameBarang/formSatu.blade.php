<div class="row">
    <div class="col-md-6">

        <div class="form-group">
            <label class="col-md-3">{{ __('Nama') }}</label>
            <div class="col-md-9">
                {!! html()->text('nama')->class('form-control' . ($errors->has('nama') ? ' is-invalid' : '')) !!}
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
                {!! html()->date('tanggal')->class('form-control' . ($errors->has('tanggal') ? ' is-invalid' :
                '')) !!}
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
                {!! html()->text('petugas')->class('form-control' . ($errors->has('nama') ? ' is-invalid' :
                ''))->disabled(true) !!}
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label class="col-md-3">{{ __('Keterangan') }}</label>
            <div class="col-md-9">
                {!! html()->textarea('keterangan')->class('form-control' . ($errors->has('keterangan') ? ' is-invalid' :
                '')) !!}
                @error('keterangan')
                <span class="has-error text-sm" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
        </div>
    </div>

</div>