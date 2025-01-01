@extends('layouts.printer')

@section('content')
<div class="wrapper">
    <div class="header">
        <h1>Daftar Barang Keluar</h1>
    </div>

    <div class="body">
        <div class="header-section">
            <p>
                <strong>Tanggal</strong>: {{ $tanggal_mulai }} s.d {{ $tanggal_akhir }}
            </p>
            <p>
                <strong>Tanggal Cetak</strong>: {{ now()->format('Y-m-d') }}
            </p>
        </div>

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
                    @php $totalHarga = 0 ; @endphp
                    @foreach ($barangKeluar as $kantor => $jenisGroup)
                    <tr style="background-color: rgb(203, 226, 255);">
                        <td colspan="10"><strong>{{ strtoupper($kantor) }}</strong></td>
                    </tr>
                    @foreach ($jenisGroup as $jenis => $items)
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
                        <td align="right">{{ number_format($item->harga, 0, ',', '.') }}</td>
                        <td align="right">{{ number_format($item->quantity * $item->harga, 0, ',', '.') }}</td>
                    </tr>
                    @php
                    $totalHarga += $item->harga * $item->quantity;
                    @endphp
                    @endforeach
                    @endforeach
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th>TOTAL</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th align="right">{{ number_format($totalHarga, 2) }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection