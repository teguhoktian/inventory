@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content">
        <div class="box box-success box-solid box-flat box-shadow">

            <div class="box-header with-border">
                <h2 class="box-title">
                    {{ __('Transaksi Barang Masuk')}}
                </h2>
            </div>

            <!-- Atas -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-3">
                        <!-- Kode Transaksi -->
                        <div class="form-group">
                            <label class="control-label" for="">{{ __('Kode Transaksi') }}</label>
                            <div class="">
                                {{ $barangMasuk->kode }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <!-- Tanggal Transaksi -->
                        <div class="form-group">
                            <label class="control-label" for="">{{ __('Tanggal Masuk') }}</label>
                            <div class="">
                                {{ $barangMasuk->tanggal_masuk }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <!-- Supplier -->
                        <div class="form-group">
                            <label class="control-label" for="">{{ __('Supplier') }}</label>
                            <div class="">
                                {{ $barangMasuk->supplier->nama }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <!-- Kode Nota -->
                        <div class="form-group">
                            <label class="control-label" for="">{{ __('No. Faktur') }}</label>
                            <div class="">
                                {{ $barangMasuk->no_faktur }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="box-body" style="border-top: 1px solid #F4F4F4;">
                <table class="table table-bordered ">
                    <thead>
                        <tr style="background-color: rgb(71, 71, 71); color:#F4F4F4;">
                            <th>{{ __('No.') }}</th>
                            <th>{{ __('Nama Barang') }}</th>
                            <th>{{ __('Qty') }}</th>
                            <th>{{ __('Harga') }}</th>
                            <th>{{ __('Total') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $total_harga = 0;
                        $counter = 0;
                        @endphp
                        @foreach($cart as $key => $product)
                        @php
                        $counter++;
                        $total_harga += $product['harga'] * $product['quantity'];
                        @endphp
                        <tr>
                            <td>
                                {{ $counter; }}
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
                            <th></th>
                            <th>{{ __('Total Harga') }}</th>
                            <th></th>
                            <th></th>
                            <th> {{ number_format($total_harga, 2, ".") }} </th>
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
                <button type="submit" id="btbSubmit" class="btn btn-default btn-flat">
                    <i class="fa fa-print"></i> {{ __('Cetak') }}
                </button>
                {!! Form::close() !!}

                <a href="{{ route('barang-masuk.index') }}" class="btn btn-danger btn-flat pull-right">
                    &laquo; {{ __('Kembali') }}
                </a>
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