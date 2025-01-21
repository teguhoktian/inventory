@extends('layouts.printer')

@section('content')
<div class="wrapper">
    <div class="header">
        <h1>{{ __('Laporan Barang Masuk') }}</h1>
        <h3>
            <strong>Periode: </strong> {{ date('d-M-Y', strtotime($tanggal_mulai)) }} s.d {{ date('d-M-Y',
            strtotime($tanggal_akhir)) }}
        </h3>
    </div>
    <!-- /.header -->

    <hr />

    <div class="body">
        <div class="header-section">

        </div>
        <!-- /.header-section -->

        <div class="content-section">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Kode Transaksi</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Satuan</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th>No. Faktur</th>
                        <th>Tanggal Masuk</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $counter = 0;
                    $totalHarga = 0;
                    @endphp
                    @foreach($barangMasuk as $jenis => $data)
                    <tr style="background-color: #ebebeb;">
                        <td colspan="11"><strong>{{ $jenis }}</strong></td>
                    </tr>
                    @php
                    $jenisTotalHarga = 0;
                    @endphp
                    @foreach($data as $barang => $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->kode }}</td>
                        <td>{{ $item->barang->kode }}</td>
                        <td>{{ $item->barang->nama }}</td>
                        <td>{{ $item->barang->satuan->nama }}</td>
                        <td align="right">{{ number_format($item->harga ,0) }}</td>
                        <td align="right">{{ $item->quantity }}</td>
                        <td align="right">{{ number_format($item->harga * $item->quantity, 0) }}</td>
                        <td>{{ $item->no_faktur }}</td>
                        <td>{{ $item->tanggal_masuk }}</td>
                    </tr>
                    @php
                    $totalHarga += $item->harga * $item->quantity;
                    $jenisTotalHarga += $item->harga * $item->quantity;
                    @endphp
                    @endforeach
                    <tr style="background-color: #f0f0f0;">
                        <td colspan="7" align="right"><strong>{{ __('Total') }} {{ $jenis }}</strong></td>
                        <td align="right"><strong>{{ number_format($jenisTotalHarga, 0) }}</strong></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="bg-gray">
                        <td colspan="7" align="right"><strong>{{ __('TOTAL') }}</strong></td>
                        <td align="right"><strong>{{ number_format($totalHarga, 0) }}</strong></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.content-section -->

        <div class="signing-section">
            @include('laporan.signer')
        </div>
        <!-- /.signing-section -->
    </div>
</div>
@endsection