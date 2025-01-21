@extends('layouts.printer')

@section('content')
<div class="wrapper">
    <div class="header">
        <h1>{{ __('Laporan Stok Barang') }}</h1>
        <h3>
            <strong>Periode: </strong> {{ date('d-M-Y', strtotime($tanggal_mulai)) }} s.d {{ date('d-M-Y',
            strtotime($tanggal_akhir)) }}
        </h3>
    </div>

    <hr />

    <div class="body">
        <div class="header-section">

        </div>

        <div class="content-section">
            <table class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Stok Awal</th>
                        <th>Masuk</th>
                        <th>Keluar</th>
                        <th>Stok Akhir</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stokBarang as $jenis => $items)
                    <tr>
                        <td colspan="7" style="background-color: beige;"><strong>{{ $jenis }}</strong></td>
                    </tr>
                    @foreach($items as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->kode }}</td>
                        <td>{{ $item->nama }}</td>
                        <td align="right">{{ number_format($item->stok_awal, 0, ',', '.') }}</td>
                        <td align="right">{{ number_format($item->stok_masuk, 0, ',', '.') }}</td>
                        <td align="right">{{ number_format($item->stok_keluar, 0, ',', '.') }}</td>
                        <td align="right">{{ number_format($item->stok_awal + $item->stok_masuk -
                            $item->stok_keluar, 0, ',', '.')
                            }}</td>
                    </tr>
                    @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="signing-section">
            @include('laporan.signer')
        </div>
        <!-- /.signing-section -->
    </div>
</div>
@endsection