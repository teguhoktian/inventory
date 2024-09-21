@extends('layouts.printer')

@section('content')
<div class="wrapper">
    <div class="header">
        <h1>Daftar Barang Masuk</h1>
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
                        <th>Tanggal Masuk</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Jenis Barang</th>
                        <th>Satuan</th>
                        <th>Qty</th>
                        <th>Harga</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $counter = 0;
                    $totalHarga = 0;
                    @endphp
                    @foreach($barangMasuk as $key => $data)
                    @php $counter++ @endphp

                    <tr>
                        <td>{{ $counter }}</td>
                        <td>{{ $data->barangMasuk->kode }}</td>
                        <td>{{ $data->barangMasuk->tanggal_masuk }}</td>
                        <td>{{ $data->barang->kode }}</td>
                        <td>{{ $data->barang->nama }}</td>
                        <td>{{ $data->barang->jenis->nama }}</td>
                        <td>{{ $data->barang->satuan->nama }}</td>
                        <td>{{ $data->quantity }}</td>
                        <td>{{ number_format($data->harga ,2) }}</td>
                        <td>{{ number_format($data->harga * $data->quantity, 2) }}</td>
                    </tr>
                    @php
                    $totalHarga += $data->harga * $data->quantity;
                    @endphp
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th>Total</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>{{ number_format($totalHarga, 2) }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection