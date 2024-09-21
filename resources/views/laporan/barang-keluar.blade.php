@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <x-content-header :title="__('Laporan Barang Keluar')" :subtitle="__('')" />

    <div class="content">
        <div class="box border-top-solid">

            <div class="box-header with-border">
                <h4 class="box-title">&nbsp;</h4>
                <div class="box-tools">
                    <div class="btn-group">
                        <button class="btn btn-success" onclick="submitForm('laporanBarangKeluar')">
                            <i class="fa fa-search"></i> {{ __('Tampilkan') }}
                        </button>
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
        </div>
        <!-- /.box -->


        @if($barangKeluar)

        <div class="box border-top-solid">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <i class="fa fa-search"></i> {{ __('Daftar Barang Keluar') }}
                </h3>
                <div class="box-tools">
                    <div class="btn-group">
                        <a href="{{ route('laporan.barang-keluar.index') }}" class="btn btn-danger">
                            <i class="fa fa-close"></i> {{ __('Close') }}
                        </a>
                        <button onclick="submitForm('printPDF')" class="btn btn-primary">
                            <i class="fa fa-print"></i> {{__('Print')}}
                        </button>

                    </div>
                    <!-- Form Print PDF -->
                    {!! Form::open(['route' => 'laporan.barang-keluar.print', 'method' => 'POST', 'id' => 'printPDF'])
                    !!}
                    <input type="hidden" id="tanggal_mulai" name="tanggal_mulai" class="form-control"
                        value="{{ $tanggal_mulai ?: date('Y-m-d') }}">
                    <input type="hidden" type="date" id="tanggal_akhir" name="tanggal_akhir" class="form-control"
                        value="{{ $tanggal_akhir ?: date('Y-m-d') }}">
                    {!! Form::close() !!}
                    <!-- /.Form Print PDF -->
                </div>
            </div>

            <!-- Body -->
            <div class="box-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Kode</th>
                            <th>Tanggal Keluar</th>
                            <th>Kantor</th>
                            <th>PIC</th>
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
                        @foreach($barangKeluar as $key => $data)
                        @php $counter++ @endphp

                        <tr>
                            <td>{{ $counter }}</td>
                            <td>{{ $data->barangKeluar->kode }}</td>
                            <td>{{ $data->barangKeluar->tanggal_keluar }}</td>
                            <td>{{ $data->barangKeluar->kantor->nama }}</td>
                            <td>{{ $data->barangKeluar->pic }}</td>
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
                            <th></th>
                            <th></th>
                            <th>{{ number_format($totalHarga, 2) }}</th>
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