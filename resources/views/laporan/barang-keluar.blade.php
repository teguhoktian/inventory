@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content">
        <div class="box box-solid box-success box-flat box-shadow">

            <div class="box-header with-border">
                <h4 class="box-title">
                    {{ __('Laporan Barang Keluar') }}
                </h4>
                <div class="box-tools">
                    <div class="btn-group">

                    </div>
                </div>
            </div>

            <div class="box-body">

                <div class="row">
                    <form id="laporanBarangKeluar">

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

                        <!-- Jenis Barang -->
                        <!-- <div class="col-md-4">
                            <div class="form-group">
                                <label for="jenis_barang">{{ __('Jenis Barang') }}</label>
                                <select id="jenis_barang" name="jenis_barang" class="form-control">
                                    <option>A</option>
                                    <option>A</option>
                                    <option>A</option>
                                </select>
                            </div>
                        </div> -->

                    </form>
                </div>
            </div>

            <!-- /.box-body -->

            <div class="box-footer with-border">
                <a href="{{ route('laporan.barang-keluar.index') }}" class="pull-right btn btn-flat btn-danger">
                    <i class="fa fa-refresh"></i>
                </a>
                <button class="btn btn-flat btn-success" onclick="submitForm('laporanBarangKeluar')">
                    <i class="fa fa-search"></i> {{ __('Tampilkan') }}
                </button>

                <button onclick="submitForm('printPDF')" class="btn btn-flat btn-primary">
                    <i class="fa fa-print"></i> {{__('Print')}}
                </button>


                <!-- Form Print PDF -->
                {!! html()->form('POST', route('laporan.barang-keluar.print'))
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


        @if($barangKeluar->count() > 0)

        <div class="box box-solid box-success box-flat box-shadow">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <i class="fa fa-search"></i> {{ __('Daftar Barang Keluar') }}
                </h3>
                <div class="box-tools">
                    <div class="btn-group">


                    </div>
                </div>
            </div>

            <!-- Body -->
            <div class="box-body">
                <table class="table table-bordered">
                    <thead>
                        <tr class="bg-light-blue">
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
                            <td align="right">{{ number_format($item->harga, 0, ',', '.') }}</td>
                            <td align="right">{{ number_format($item->quantity * $item->harga, 0, ',', '.') }}</td>
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
                            <td align="right"><strong>{{ number_format($jenisTotalHarga, 0, ',', '.') }}</strong></td>
                        </tr>
                        @endforeach
                        <tr style="background-color: rgb(235, 245, 255);">
                            <td colspan="7" align="right"><strong>Total untuk {{ strtoupper($kantor) }}</strong></td>
                            <td align="right"><strong>{{ $kantorTotalQty }}</strong></td>
                            <td></td>
                            <td align="right"><strong>{{ number_format($kantorTotalHarga, 0, ',', '.') }}</strong></td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="bg-gray">
                            <td colspan="7" align="right"><strong>TOTAL</strong></td>
                            <td align="right"><strong>{{ $totalItem }}</strong></td>
                            <td></td>
                            <td align="right"><strong>{{ number_format($totalHarga, 2) }}</strong></td>
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