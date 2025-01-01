@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <div class="content">
        <div class="box box-solid box-success box-flat box-shadow">

            <div class="box-header with-border">
                <h4 class="box-title">
                    {{ __('Laporan Barang Masuk') }}
                </h4>
                <div class="box-tools">
                    <div class="btn-group">

                    </div>
                </div>
            </div>

            <div class="box-body">

                <div class="row">
                    <form id="laporanBarangMasuk">

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
                <button class="btn btn-success btn-flat" onclick="submitForm('laporanBarangMasuk')">
                    <i class="fa fa-search"></i> {{ __('Tampilkan') }}
                </button>
                <!-- /.button -->
                <a href="{{ route('laporan.barang-masuk.index') }}" class="btn-flat btn btn-danger pull-right">
                    <i class="fa fa-refresh"></i>
                </a>
                <!-- /.a -->
                <button onclick="submitForm('printPDF')" class="btn btn-primary btn-flat">
                    <i class="fa fa-print"></i> {{__('Print')}}
                </button>
                <!-- /.button -->
                <!-- Form Print PDF -->
                {!! Form::open(['route' => 'laporan.barang-masuk.print', 'method' => 'POST', 'id' => 'printPDF'])
                !!}
                <input type="hidden" id="tanggal_mulai" name="tanggal_mulai" class="form-control"
                    value="{{ $tanggal_mulai ?: date('Y-m-d') }}">
                <input type="hidden" type="date" id="tanggal_akhir" name="tanggal_akhir" class="form-control"
                    value="{{ $tanggal_akhir ?: date('Y-m-d') }}">
                {!! Form::close() !!}
                <!-- /.Form Print PDF -->
            </div>
        </div>
        <!-- /.box -->


        @if($barangMasuk)

        <div class="box box-solid box-success box-flat box-shadow">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <i class="fa fa-search"></i> {{ __('Daftar Barang Masuk') }}
                </h3>
                <div class="box-tools">
                    <div class="btn-group">
                    </div>
                </div>
            </div>

            <!-- Body -->
            <div class="box-body table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr class="bg-light-blue">
                            <th>No.</th>
                            <th>Kode Transaksi</th>
                            <th>Kode Barang</th>
                            <th>Jenis Barang</th>
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
                        @foreach($barangMasuk as $key => $data)
                        @php $counter++ @endphp
                        <tr style="white-space: nowrap;">
                            <td>{{ $counter }}</td>
                            <td>{{ $data->barangMasuk->kode }}</td>
                            <td>{{ $data->barang->kode }}</td>
                            <td>{{ $data->barang->jenis->nama }}</td>
                            <td>{{ $data->barang->nama }}</td>
                            <td>{{ $data->barang->satuan->nama }}</td>
                            <td>{{ number_format($data->harga ,2) }}</td>
                            <td>{{ $data->quantity }}</td>
                            <td>{{ number_format($data->harga * $data->quantity, 2) }}</td>
                            <td>{{ $data->barangMasuk->no_faktur }}</td>
                            <td>{{ $data->barangMasuk->tanggal_masuk }}</td>
                        </tr>
                        @php
                        $totalHarga += $data->harga * $data->quantity;
                        @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="bg-gray">
                            <th></th>
                            <th>Total</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>{{ number_format($totalHarga, 2) }}</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
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