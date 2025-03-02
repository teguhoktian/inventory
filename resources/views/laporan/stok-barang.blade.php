@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content">
        <div class="box box-solid box-success box-flat box-shadow">

            <div class="box-header with-border">
                <h4 class="box-title">
                    <i class="fa fa-list"></i> {{ __('Laporan Stok Barang') }}
                </h4>
                <div class="box-tools">
                    <div class="btn-group">
                        <!-- Tombol -->
                    </div>
                    <!-- /. btn-group -->
                </div>
                <!-- /. box-tools -->
            </div>
            <!-- /.box-title -->

            <div class="box-body">

                <div class="row">
                    <form id="laporanStokbarangForm">

                        <!-- Tanggal Mulai -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tanggal_mulai">{{ __('Tanggal Mulai') }}</label>
                                <input type="date" id="tanggal_mulai" name="tanggal_mulai" class="form-control"
                                    value="{{ $tanggal_mulai ?: date('Y-m-d') }}">
                            </div>
                        </div>

                        <!-- Tanggal Akhir -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tanggal_akhir">{{ __('Tanggal Akhir') }}</label>
                                <input type="date" id="tanggal_akhir" name="tanggal_akhir" class="form-control"
                                    value="{{ $tanggal_akhir ?: date('Y-m-d') }}">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer with-border">
                <button class="btn btn-default btn-flat" onclick="submitForm('laporanStokbarangForm')">
                    <i class="fa fa-search"></i> {{ __('Tampilkan') }}
                </button>

                <a href="{{ route('laporan.stok-barang.index') }}" class="pull-right btn btn-danger btn-flat">
                    <i class="fa fa-refresh"></i>
                </a>

                <button onclick="submitForm('printPDF')" class="btn btn-primary btn-flat">
                    <i class="fa fa-print"></i> {{__('Print')}}
                </button>

                <!-- Form Print PDF -->
                {!! html()->form('POST', route('laporan.stok-barang.print'))
                ->attribute('id', 'printPDF')
                ->class('')
                ->acceptsFiles()
                ->open() !!}
                <input type="hidden" id="tanggal_mulai" name="tanggal_mulai" class="form-control"
                    value="{{ $tanggal_mulai ?: date('Y-m-d') }}">
                <input type="hidden" type="date" id="tanggal_akhir" name="tanggal_akhir" class="form-control"
                    value="{{ $tanggal_akhir ?: date('Y-m-d') }}">
                {!! html()->form()->close() !!}
                <!-- /.Form Print PDF -->
            </div>
        </div>
        <!-- /.box -->


        @if(!$stokBarang->isEmpty())

        <div class="box box-solid box-success box-flat box-shadow">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <i class="fa fa-search"></i> {{ __('Daftar Stok Barang') }}
                </h3>
                <div class="box-tools">
                    <div class="btn-group">


                    </div>
                </div>
            </div>

            <!-- Body -->
            <div class="box-body with-border">
                <table class="table table-bordered table-striped table-hovered">
                    <thead>
                        <tr class="bg-light-blue">
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
        </div>
        <!-- /.box  -->

        @endif
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

@section('style')

@endsection

@section('javascript')
<script>
    function submitForm(id) {
        var form = document.getElementById(id);
        form.submit();
    }
</script>
@stop