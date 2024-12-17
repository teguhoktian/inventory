@extends('layouts.printer')

@section('content')
<div class="wrapper">
    <div class="header">
        <h1>Daftar Stok Barang</h1>
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
            <table class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Jenis Barang</th>
                        <th>Stok Awal</th>
                        <th>Masuk</th>
                        <th>Keluar</th>
                        <th>Stok Akhir</th>
                    </tr>
                </thead>
                <tbody>
                    @php $counter = 0; @endphp
                    @foreach($stokBarang as $key => $data)
                    @php $counter++ @endphp

                    <tr>
                        <td>{{ $counter }}</td>
                        <td>{{ $data->kode }}</td>
                        <td>{{ $data->nama }}</td>
                        <td>{{ $data->jenis->nama }}</td>
                        <td>{{ $data->stok_awal }}</td>
                        <td>{{ $data->stok_masuk }}</td>
                        <td>{{ $data->stok_keluar }}</td>
                        <td>{{ $data->stok_awal + $data->stok_masuk - $data->stok_keluar }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection