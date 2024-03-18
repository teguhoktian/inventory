@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-body">
                <div class="col-md-6">
                    <h4><i class="fa fa-user"></i> {{ __('Detail Barang') }}</h4>
                </div>
                <!-- /.com-md-6 -->

                <div class="col-md-6 text-right">
                    <a href="{{ route('barang.index') }}" class="btn-flat btn btn-success">
                        <i class="fa fa-list"></i> {{ __('Daftar') }}
                    </a>
                </div>
                <!-- /.com-md-6 -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.com-md-12 -->
    </div>
    <!-- /.row -->

    <div class="content">
        <div class="box border-top-solid">
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
            <div class="box-body">
                <div class="row">
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
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($timeLineBarang as $key => $brg)
                            <tr>
                                <td>
                                    @if($brg->id_barang_masuk)
                                    Barang Masuk
                                    @else
                                    Barang Keluar
                                    @endif
                                </td>
                                <td>
                                    @if($brg->id_barang_masuk)
                                    {{$brg->barangMasuk->tanggal_masuk}}
                                    @else
                                    {{$brg->barangKeluar->tanggal_keluar}}
                                    @endif
                                </td>
                                <td>{{ $brg->quantity }}</td>
                                <td>{{ $brg->harga }}</td>
                                <td>{{ number_format($brg->harga * $brg->quantity, 2, ',', '.') }}</td>
                                <td>
                                    @if($brg->id_barang_masuk)
                                    @php $sisaStok += $brg->quantity @endphp
                                    @else
                                    @php $sisaStok -= $brg->quantity @endphp
                                    @endif
                                    {{ number_format($sisaStok, 0, ',', '.') }}
                                </td>
                                <td>
                                    @if($brg->id_barang_masuk)
                                    @php $sisaSaldo += $brg->quantity * $brg->harga @endphp
                                    @else
                                    @php $sisaSaldo -= $brg->quantity * $brg->harga @endphp
                                    @endif
                                    {{ number_format($sisaSaldo, 2, ',', '.') }}
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
                                <td style="font-weight: bold;">Saldo Akhir</td>
                                <td style="font-weight: bold;">{{ number_format($sisaStok, 0, ',', '.') }}</td>
                                <td style="font-weight: bold;">{{ number_format($sisaSaldo, 2, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>

                </div>
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