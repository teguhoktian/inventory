@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <div class="content">
        <div class="box box-success box-solid box-flat box-shadow">

            <div class="box-header with-border">
                <h4 class="box-title">
                    {{ __('Detail Transaksi Barang Keluar') }}
                </h4>
            </div>

            <!-- Atas -->
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-3">
                        <!-- Kode Transaksi -->
                        <div class="form-group">
                            <label class=" control-label" for="">{{ __('Kode Transaksi') }}</label>
                            <div class="">
                                {{ $barangKeluar->kode }}
                            </div>
                        </div>
                    </div>


                    <!-- Tanggal Transaksi -->
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class=" control-label" for="">{{ __('Tanggal Keluar') }}</label>
                            <div class="">
                                {{ $barangKeluar->tanggal_keluar }}
                            </div>
                        </div>
                    </div>




                    <!-- Supplier -->
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class=" control-label" for="">{{ __('Kantor') }}</label>
                            <div class="">
                                {{ $barangKeluar->kantor->nama }}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <!-- Kode Nota -->
                        <div class="form-group">
                            <label class=" control-label" for="">{{ __('PIC') }}</label>
                            <div class="">
                                {{ $barangKeluar->user_name }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="box-body" style="border-top: 1px solid #F4F4F4;">
                <table class="table table-bordered ">
                    <thead>
                        <tr class="bg-primary">
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
                                {{ $counter++; }}
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
                            <th>
                                {{
                                number_format($total_harga, 2, ".")

                                }}
                            </th>
                        </tr>
                    </tfoot>
                    @endif
                </table>
            </div>

            <div class="box-footer">

                {!! Form::open([
                'id' => 'delete-form-'.$barangKeluar->id,
                'target' => '_blank',
                'route' => ['barang-keluar.print', $barangKeluar->id],'style'=>'display:inline'])
                !!}
                <button type="submit" id="btbSubmit" class="btn btn-default btn-flat">
                    <i class="fa fa-print"></i> {{ __('Cetak') }}
                </button>
                {!! Form::close() !!}

                <a href="{{ route('barang-keluar.create') }}" class="btn btn-success btn-flat">
                    <i class="fa fa-plus"></i> {{ __('Buat Transaksi Baru') }}
                </a>

                <a href="{{ route('barang-keluar.index') }}" class="btn btn-danger btn-flat pull-right">
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