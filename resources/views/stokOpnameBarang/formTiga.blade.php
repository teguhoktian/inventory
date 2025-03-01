<table class="table table-bordered table-striped">
    <thead>
        <tr style="background-color: #415149; color:aliceblue">
            <th>{{ __('No.') }}</th>
            <th>{{ __('Kode.') }}</th>
            <th>{{ __('Nama Barang') }}</th>
            <th>{{ __('Jenis Barang') }}</th>
            <th>{{ __('Satuan') }}</th>
            <th>{{ __('Stok System') }}</th>
            <th>{{ __('Stok Fisik') }}</th>
            <th>{{ __('Status') }}</th>
        </tr>
    </thead>
    <tbody>
        @php $counter = 0; @endphp
        @foreach($listBarang as $key => $barang)
        @php $counter++; @endphp
        <tr>
            <td>{{ $counter }}</td>
            <td>{{ $barang->barang->kode }}</td>
            <td>{{ $barang->barang->nama }}</td>
            <td>{{ $barang->barang->jenis?->nama }}</td>
            <td>{{ $barang->barang->satuan?->nama }}</td>
            <td style="text-align: right;">{{ $barang->stok_aplikasi }}</td>
            <td style="width: 120px;">

                {!! html()->form('PATCH', route('stok-opname-barang.updateStokFisik', $barang->id))
                ->attribute('id', '')
                ->class('form-horizontal')
                ->open() !!}
                <div class="input-group input-group-sm">
                    <input type="number" class="form-control" min="0" name="stok_fisik"
                        value="{{ $barang->stok_fisik ?: 0 }}">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-success btn-flat">
                            <i class="fa fa-save"></i>
                        </button>
                    </span>
                </div>
                {{ html()->form()->close() }}
            </td>
            <td>
                @if($barang->stok_fisik === null)
                <button class="btn-xs btn btn-danger">
                    <i class="fa fa-exclamation"></i> Stok Fisik blm Input
                </button>
                @else
                <button class="btn-xs btn btn-success">
                    <i class="fa fa-check-circle-o"></i> OK
                </button>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>