@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <x-content-header :title="__('Detail Barang')" :subtitle="$barang->nama" />

    <div class="content">
        <div class="box border-top-solid">

            <div class="box-header with-border">
                <a href="{{ route('barang.index') }}" class="btn-flat btn btn-default">
                    <i class="fa  fa-chevron-left"></i> {{ __('Kembali') }}
                </a>
            </div>

            <div class="box-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="inputName">{{ __('Kode') }}</label>
                            <div class="col-sm-8">
                                {{ $barang->kode }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="inputName">{{ __('Nama') }}</label>
                            <div class="col-sm-8">
                                {{ $barang->nama }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="inputName">{{ __('Jenis') }}</label>
                            <div class="col-sm-8">
                                {{ $barang->jenis->nama }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="inputName">{{ __('Stok') }}</label>
                            <div class="col-sm-8">
                                {{ $barang->stok }} {{ $barang->satuan->nama }}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="box border-top-solid">
            <div class="box-header with-border">
                <h4><i class="fa fa-list"></i> {{ __('Kartu Stok') }}
                    <small>{{ __('Mutasi Stok') }} {{ $barang->nama }}</small>
                </h4>
            </div>
            <div class="box-body">
                <!-- Barang Masuk -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Jenis</th>
                            <th>Tanggal</th>
                            <th>Qty</th>
                            <th>Harga</th>
                            <th>Total</th>
                            <th>Sisa Qty</th>
                            <th>Sisa Saldo</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($timeLineBarang as $key => $mutasi)
                        <tr>
                            <td>
                                @if($mutasi->tipe == 'Masuk')
                                <span class="btn btn-xs btn-primary">
                                    {{ $mutasi->tipe }}
                                </span>
                                @else
                                <span class="btn btn-xs btn-danger">
                                    {{ $mutasi->tipe }}
                                </span>
                                @endif
                            </td>
                            <td>
                                {{ $mutasi->tanggal }}
                            </td>
                            <td style="text-align: right;">{{ $mutasi->jumlah }}</td>
                            <td style="text-align: right;">{{ number_format($mutasi->harga,0) }}</td>
                            <td style="text-align: right;">{{ number_format($mutasi->harga * $mutasi->jumlah, 0) }}</td>
                            <td style="text-align: right;">
                                {{ $mutasi->sisa_stok }}
                            </td>
                            <td style="text-align: right;">
                                @if($mutasi->tipe == 'Masuk')
                                @php $sisaSaldo += -$mutasi->jumlah * $mutasi->harga @endphp
                                @else
                                @php $sisaSaldo += $mutasi->jumlah * $mutasi->harga @endphp
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
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="font-weight: bold; text-align: right;">Saldo Akhir</td>
                            <td style="font-weight: bold;text-align: right;">{{ number_format($barang->stok, 0) }}</td>
                            <td style="font-weight: bold;text-align: right;">{{ number_format($sisaSaldo, 0)
                                }}</td>
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

</script>
@stop