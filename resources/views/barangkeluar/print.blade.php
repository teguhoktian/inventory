@extends('layouts.invoice')

@section('content')
<!-- Content Wrapper. Contains page content -->

<div class="invoice">
    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header">
                <i class="fa fa-file-text"></i>
                {{ __("Invoice Barang Keluar") }}
            </h2>
        </div>
    </div>
    <div class="box">
        <!-- Atas -->
        <div class="box-body">
            <div class="row">
                <div class="col-xs-3">
                    <!-- Kode Transaksi -->
                    <div class="form-group">
                        <label class=" control-label" for="">{{ __('Kode Transaksi') }}</label>
                        <div class="">
                            {{ $barangKeluar->kode }}
                        </div>
                    </div>
                </div>


                <!-- Tanggal Transaksi -->
                <div class="col-xs-3">
                    <div class="form-group">
                        <label class=" control-label" for="">{{ __('Tanggal Keluar') }}</label>
                        <div class="">
                            {{ $barangKeluar->tanggal_keluar }}
                        </div>
                    </div>
                </div>




                <!-- Supplier -->
                <div class="col-xs-3">
                    <div class="form-group">
                        <label class=" control-label" for="">{{ __('Kantor') }}</label>
                        <div class="">
                            {{ $barangKeluar->kantor->nama }}
                        </div>
                    </div>
                </div>
                <div class="col-xs-3">
                    <!-- Kode Nota -->
                    <div class="form-group">
                        <div class="col-lg-6">
                            <label class=" control-label" for="">{{ __('PIC') }}</label>
                            <div class="">
                                {{ $barangKeluar->pic }}
                            </div>
                        </div>
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
                        <th>
                            {{
                            number_format($total_harga, 2, ".")

                            }}
                        </th>
                    </tr>
                </tfoot>
                @endif
            </table>

            <br>

            <div>
                <div class="row text-center">
                    <div class="col-xs-6 col-xs-6">
                        {{ __('Mengetahui') }},
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        (........................................)
                    </div>

                    <div class="col-xs-6 col-xs-6">
                        {{ __('Petugas') }},
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        (........................................)
                    </div>
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