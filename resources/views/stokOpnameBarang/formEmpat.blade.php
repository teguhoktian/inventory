<table class="table table-bordered ">
    <thead>
        <tr>
            <th>{{ __('No.') }}</th>
            <th>{{ __('Kode.') }}</th>
            <th>{{ __('Nama Barang') }}</th>
            <th>{{ __('Jenis Barang') }}</th>
            <th>{{ __('Satuan') }}</th>
            <th>{{ __('Stok System') }}</th>
            <th>{{ __('Stok Fisik') }}</th>
            <th>{{ __('Selisih') }}</th>
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
            <td style="width: 120px; text-align: right;">
                {{ $barang->stok_fisik }}
            </td>
            <td style="width: 120px; text-align: right;">
                {{ $barang->selisih }}
            </td>
            <td>
                @if($barang->selisih < 0) <span class="label label-danger">
                    <i class="fa fa-exclamation"></i>
                    </span>
                    @endif


                    @if($barang->selisih == 0)
                    <span class="label label-success">
                        <i class="fa fa-check-circle-o"></i>
                    </span>
                    @endif

                    @if($barang->selisih > 0)
                    <span class="label label-warning">
                        <i class="fa fa-exclamation"></i>
                        </sp>
                        @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>