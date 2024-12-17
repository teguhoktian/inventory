@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content">
        <div class="box box-solid box-success">

            <div class="box-header with-border">
                <h3 class="box-title">{{ __('Detail Barang') }}</h3>
            </div>

            <div class="box-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="inputName">{{ __('Kode') }}</label>
                            <div class="col-sm-8">
                                : {{ $barang->kode }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="inputName">{{ __('Nama') }}</label>
                            <div class="col-sm-8">
                                : {{ $barang->nama }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="inputName">{{ __('Jenis') }}</label>
                            <div class="col-sm-8">
                                : {{ $barang->jenis->nama }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="inputName">{{ __('Stok') }}</label>
                            <div class="col-sm-8">
                                : {{ $barang->stok }} {{ $barang->satuan->nama }}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="box box-solid box-success">
            <div class="box-header with-border">
                <h4 class="box-title"><i class="fa fa-list"></i> {{ __('Kartu Stok') }} -
                    {{ __('Mutasi Stok') }} {{ $barang->nama }}
                </h4>
            </div>
            <div class="box-body">

                <div style="margin-bottom: 1rem; display: flex; gap:0.5rem;">
                    <a href="{{ route('barang.index') }}" class="btn-flat btn btn-default">
                        <i class="fa fa-backward"></i> {{ __('Kembali') }}
                    </a>
                    <a href="{{ route('barang.adjust-stok', $barang->id) }}" class="btn-flat btn btn-primary">
                        <i class="fa fa-compress"></i> {{ __('Adjusment Stok') }}
                    </a>
                    <!-- Form Filter -->
                    <form action="{{ route('barang.show', ['barang' => $barang->id]) }}" method="GET"
                        class="form-inline form">
                        <div class="form-group">
                            <input type="date" class="form-control" value="{{ $startDate }}" name="start_date">
                        </div>
                        <div class="form-group">
                            <input type="date" class="form-control" value="{{ $endDate }}" name="end_date">
                        </div>
                        <button type="submit" class="btn btn-warning btn-flat">
                            <i class="fa fa-search"></i> {{ __('Tampilkan') }}
                        </button>
                        <button type="button" class="btn btn-danger btn-flat" onclick="reloadKartuStok()">
                            <i class="fa fa-rotate-right"></i>
                        </button>
                        <button type="button" class="btn btn-default btn-flat" onclick="printKartuStok()">
                            <i class="fa fa-print"></i> {{ __('Cetak') }}
                        </button>
                    </form>
                </div>

                <!-- Barang Masuk -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Jenis</th>
                            <th>Tgl. Posting</th>
                            <th>Tgl. Invoice</th>
                            <th>Qty</th>
                            <th>Harga</th>
                            <th>Total</th>
                            <th>Sisa Qty</th>
                            <th>Sisa Saldo</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <thead>
                        <tr style="background-color: #F4F4F4;">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="font-weight: bold; text-align: right;"></td>
                            <td></td>
                            <td style="font-weight: bold;text-align: right;">{{ number_format($sisaStok, 0) }}</td>
                            <td style="font-weight: bold;text-align: right;">{{ number_format($saldoAwal, 0) }}</td>
                            <td>{{ __('SALDO AWAL') }}</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($timeLineBarang as $key => $mutasi)
                        <tr>
                            <td>
                                @if($mutasi->tipe == 'Masuk')
                                <span class="label label-primary">
                                    {{ $mutasi->tipe }}
                                </span>
                                @else
                                <span class="label label-danger">
                                    {{ $mutasi->tipe }}
                                </span>
                                @endif
                            </td>
                            <td>
                                {{ $mutasi->created_at->format('d/m/Y') }}
                            </td>
                            <td>
                                {{ $mutasi->tanggal->format('d/m/Y') }}
                            </td>
                            <td style="text-align: right;">{{ $mutasi->jumlah }}</td>
                            <td style="text-align: right;">{{ number_format($mutasi->harga,0) }}</td>
                            <td style="text-align: right;">{{ number_format($mutasi->harga * $mutasi->jumlah, 0) }}</td>
                            <td style="text-align: right;">
                                {{ $mutasi->sisa_stok }}
                            </td>
                            <td style="text-align: right;">
                                @if($mutasi->tipe == 'Masuk')
                                @php $sisaSaldo += $mutasi->jumlah * $mutasi->harga @endphp
                                @else
                                @php $sisaSaldo -= $mutasi->jumlah * $mutasi->harga @endphp
                                @endif

                                {{ number_format($sisaSaldo, 0) }}
                            </td>
                            <td>
                                {{ $mutasi->keterangan }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr style="background-color: #F4F4F4;">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="font-weight: bold; text-align: right;"></td>
                            <td></td>
                            <td style="font-weight: bold;text-align: right;">{{ number_format($barang->stok, 0) }}</td>
                            <td style="font-weight: bold;text-align: right;">{{ number_format($sisaSaldo, 0)
                                }}</td>
                            <td>{{ __('SALDO AKHIR') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->
@endsection

@section('style')

@endsection


@section('javascript')
<script type="text/javascript">
    function reloadKartuStok() {
        window.location.href = "{{ route('barang.show', ['barang' => $barang->id]) }}";
    }

    function printKartuStok() {
        alert("Maaf, Fitur ini belum tersedia saat ini.")
        window.location.href = "{!! request()->fullUrl() !!}";
    }
</script>
@stop