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
                    <a href="{{ route('barang-masuk.index') }}" class="btn-flat btn btn-success">
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
                            {{ $barangMasuk->kode }}
                        </div>
                    </div>

                    <!-- Tanggal Transaksi -->
                    <div class="col-lg-6">
                        <label class="col-sm-4 control-label" for="">{{ __('Tanggal Masuk') }}</label>
                        <div class="col-sm-8">
                            {{ $barangMasuk->tanggal_masuk }}
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <!-- Supplier -->
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="">{{ __('Supplier') }}</label>
                            <div class="col-sm-8">
                                {{ $barangMasuk->supplier->nama }}
                            </div>
                        </div>
                    </div>

                    <!-- Kode Nota -->
                    <div class="col-lg-6">
                        <label class="col-sm-4 control-label" for="">{{ __('No. Faktur') }}</label>
                        <div class="col-sm-8">
                            {{ $barangMasuk->no_faktur }}
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
                                <p><small class="help-block">{{$product->barang->jenis->nama}}</small></p>
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

                {!! Form::open([
                'id' => 'delete-form-'.$barangMasuk->id,
                'target' => '_blank',
                'route' => ['barang-masuk.print', $barangMasuk->id],'style'=>'display:inline'])
                !!}
                <button type="submit" id="btbSubmit" class="btn btn-default">
                    <i class="fa fa-print"></i> {{ __('Cetak') }}
                </button>
                {!! Form::close() !!}
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