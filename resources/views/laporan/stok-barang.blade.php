@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <x-content-header :title="__('Laporan Stok Barang')" :subtitle="__('')" />

    <div class="content">
        <div class="box border-top-solid">

            <div class="box-header with-border">
                <h4 class="box-title">&nbsp;</h4>
                <div class="box-tools">
                    <div class="btn-group">
                        <button class="btn btn-success" onclick="submitForm('laporanStokbarangForm')">
                            <i class="fa fa-search"></i> {{ __('Tampilkan') }}
                        </button>
                    </div>
                </div>
            </div>

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


        @if($stokBarang)

        <div class="box border-top-solid">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <i class="fa fa-search"></i> {{ __('Daftar Stok Barang') }}
                </h3>
                <div class="box-tools">
                    <div class="btn-group">
                        <a href="{{ route('laporan.stok-barang.index') }}" class="btn btn-danger">
                            <i class="fa fa-close"></i> {{ __('Close') }}
                        </a>
                        <button onclick="submitForm('printPDF')" class="btn btn-primary">
                            <i class="fa fa-print"></i> {{__('Print')}}
                        </button>

                    </div>
                    <!-- Form Print PDF -->
                    {!! Form::open(['route' => 'laporan.stok-barang.print', 'method' => 'POST', 'id' => 'printPDF']) !!}
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
                            <td>{{ $data->jenis?->nama }}</td>
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