@extends('layouts.printer')

@section('content')
<div class="wrapper">
    <div class="header">
        <h1>Kartu Stok Opname - {{ $stokOpnameBarang->nama }}</h1>
    </div>

    <div class="body">
        <div class="header-section">
            <p>
                <strong>Tanggal</strong>: {{ $stokOpnameBarang->tanggal }}
            </p>
            <p>
                <strong>Keterangan</strong>: {{ $stokOpnameBarang->keterangan }}
            </p>
        </div>

        <div class="content-section">
            <table class="table">
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
                        <td style="width: 1px; text-align: right;">{{ $barang->stok_aplikasi }}</td>
                        <td style="width: 1px; text-align: right;">
                            {{ $barang->stok_fisik }}
                        </td>
                        <td style="width: 1px; text-align: right;">
                            {{ $barang->selisih }}
                        </td>
                        <td style="width: 60px; text-align: center;">
                            @if($barang->selisih < 0) <span>S/K</span>
                                @endif


                                @if($barang->selisih == 0)
                                <span>OK</span>
                                @endif

                                @if($barang->selisih > 0)
                                <span>S/L</span>
                                @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection