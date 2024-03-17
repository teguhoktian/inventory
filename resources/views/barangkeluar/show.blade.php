@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-body">
                <div class="col-md-6">
                    <h4><i class="fa fa-user"></i> {{ __('Detail Transaksi') }}</h4>
                </div>
                <!-- /.com-md-6 -->

                <div class="col-md-6 text-right">
                    <a href="{{ route('barang-keluar.index') }}" class="btn-flat btn btn-success">
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

            <!-- Atas -->
            <div class="box-body">
                <div class="row">
                    <!-- Kode Transaksi -->
                    <div class="col-lg-6">
                        <label class="col-sm-4 control-label" for="">{{ __('Kode Transaksi') }}</label>
                        <div class="col-sm-8">
                            {{ $barangKeluar->kode }}
                        </div>
                    </div>

                    <!-- Tanggal Transaksi -->
                    <div class="col-lg-6">
                        <label class="col-sm-4 control-label" for="">{{ __('Tanggal Keluar') }}</label>
                        <div class="col-sm-8">
                            {{ $barangKeluar->tanggal_keluar }}
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <!-- Supplier -->
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="">{{ __('Kantor') }}</label>
                            <div class="col-sm-8">
                                {{ $barangKeluar->kantor->nama }}
                            </div>
                        </div>
                    </div>

                    <!-- Kode Nota -->
                    <div class="col-lg-6">
                        <label class="col-sm-4 control-label" for="">{{ __('PIC') }}</label>
                        <div class="col-sm-8">
                            {{ $barangKeluar->pic }}
                        </div>
                    </div>

                </div>
            </div>

            <div class="box-body" style="border-top: 1px solid #F4F4F4;">
                <table class="table table-bordered ">
                    <thead>
                        <tr>
                            <th>{{ __('No.') }}</th>
                            <th>{{ __('Nama Barang') }}</th>
                            <th>{{ __('Qty') }}</th>
                            <th>{{ __('Harga') }}</th>
                            <th>{{ __('Total') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $total_harga = 0
                        @endphp
                        @foreach($cart as $key => $product)
                        @php
                        $total_harga += $product['harga'] * $product['quantity'];
                        @endphp
                        <tr>
                            <td>
                                #
                            </td>
                            <td>
                                {{$product->barang->nama}}
                            </td>
                            <td>{{$product['quantity']}} {{$product->barang->satuan->nama}}</td>
                            <td>{{
                                number_format($product['harga'], 2, ".")
                                }}</td>
                            <td>
                                {{
                                number_format($product['harga'] * $product['quantity'], 2, ".")
                                }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    @if($total_harga > 0)
                    <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                {{
                                number_format($total_harga, 2, ".")

                                }}
                            </td>
                        </tr>
                    </tfoot>
                    @endif
                </table>
            </div>

            <div class="box-footer">
                <button type="submit" id="btbSubmit" class="btn-flat btn btn-success pull-right">
                    {{ __('Cetak') }}
                </button>
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