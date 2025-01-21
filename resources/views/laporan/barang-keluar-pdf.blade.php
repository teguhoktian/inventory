@extends('layouts.printer')

@section('content')
<div class="wrapper">
    <div class="header">
        <h1>{{ __('Laporan Barang Keluar') }}</h1>
        <h3>
            <strong>Periode: </strong> {{ date('d-M-Y', strtotime($tanggal_mulai)) }} s.d {{ date('d-M-Y',
            strtotime($tanggal_akhir)) }}
        </h3>
    </div>
    <hr />
    <div class="body">
        <div class="content-section">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Kode</th>
                        <th>Tanggal Keluar</th>
                        <th>User</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Satuan</th>
                        <th>Qty</th>
                        <th>Harga</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $totalHarga = 0;
                    $totalItem = 0;
                    @endphp
                    @foreach ($barangKeluar as $kantor => $jenisGroup)
                    @php
                    $kantorTotalQty = 0;
                    $kantorTotalHarga = 0;
                    @endphp
                    <tr style="background-color: rgb(203, 226, 255);">
                        <td colspan="10"><strong>{{ strtoupper($kantor) }}</strong></td>
                    </tr>
                    @foreach ($jenisGroup as $jenis => $items)
                    @php
                    $jenisTotalQty = 0;
                    $jenisTotalHarga = 0;
                    @endphp
                    <tr style="background-color: #ebebeb;">
                        <td colspan="10" style="padding-left: 20px;"><strong>{{ $jenis }}</strong></td>
                    </tr>
                    @foreach ($items as $index => $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->barangKeluar->kode }}</td>
                        <td>{{ $item->barangKeluar->tanggal_keluar }}</td>
                        <td>{{ $item->barangKeluar->user->name }}</td>
                        <td>{{ $item->barang->kode }}</td>
                        <td>{{ $item->barang->nama }}</td>
                        <td>{{ $item->barang->satuan->nama }}</td>
                        <td align="right">{{ $item->quantity }}</td>
                        <td align="right">{{ number_format($item->harga, 0) }}</td>
                        <td align="right">{{ number_format($item->quantity * $item->harga, 0) }}</td>
                    </tr>
                    @php
                    $jenisTotalQty += $item->quantity;
                    $jenisTotalHarga += $item->quantity * $item->harga;
                    $kantorTotalQty += $item->quantity;
                    $kantorTotalHarga += $item->quantity * $item->harga;
                    $totalHarga += $item->quantity * $item->harga;
                    $totalItem += $item->quantity;
                    @endphp
                    @endforeach
                    <tr style="background-color: #f0f0f0;">
                        <td colspan="7" align="right"><strong>Total untuk {{ $jenis }}</strong></td>
                        <td align="right"><strong>{{ $jenisTotalQty }}</strong></td>
                        <td></td>
                        <td align="right"><strong>{{ number_format($jenisTotalHarga, 0) }}</strong></td>
                    </tr>
                    @endforeach
                    <tr style="background-color: rgb(235, 245, 255);">
                        <td colspan="7" align="right"><strong>Total untuk {{ strtoupper($kantor) }}</strong></td>
                        <td align="right"><strong>{{ $kantorTotalQty }}</strong></td>
                        <td></td>
                        <td align="right"><strong>{{ number_format($kantorTotalHarga, 0) }}</strong></td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="bg-gray">
                        <td colspan="7" align="right"><strong>TOTAL</strong></td>
                        <td align="right"><strong>{{ $totalItem }}</strong></td>
                        <td></td>
                        <td align="right"><strong>{{ number_format($totalHarga,0) }}</strong></td>
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