<table class="table table-bordered ">
    <thead>
        <tr>
            <th>{{ __('No.') }}</th>
            <th>{{ __('Kode.') }}</th>
            <th>{{ __('Nama Barang') }}</th>
            <th>{{ __('Jenis Barang') }}</th>
            <th>{{ __('Satuan') }}</th>
            <th>{{ __('Stok System') }}</th>
        </tr>
    </thead>
    <tbody>
        @php $counter = 0; @endphp
        @foreach($listBarang as $key => $barang)
        @php $counter++; @endphp
        <tr>
            <td>{{ $counter }}</td>
            <td>{{ $barang->kode }}</td>
            <td>{{ $barang->nama }}</td>
            <td>{{ $barang->jenis?->nama }}</td>
            <td>{{ $barang->satuan?->nama }}</td>
            <td style="text-align: right;">{{ $barang->stok }}</td>
        </tr>
        @endforeach
    </tbody>
</table>