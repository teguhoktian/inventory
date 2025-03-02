@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content">

        <div class="col-sm-7">
            {!! html()->form('POST', route('barang-masuk.store'))
            ->attribute('id', 'moduleForm')
            ->class('form-horizontal')
            ->acceptsFiles()
            ->open() !!}
            <x-box type="success" flat="true" shadow="true">
                <x-slot name="header">
                    {{ __('Document Detail') }}
                </x-slot>

                @include('barangmasuk.form')

                <x-slot name="footer">
                    <a href="{{ route('barang-masuk.create') }}" class="btn-flat btn btn-danger">
                        <i class="fa fa-angle-double-left"></i> {{ __('Kembali ke Cart') }}
                    </a>
                    <button type="submit" id="btbSubmit" class="btn-flat btn btn-success pull-right">
                        <i class="fa fa-save"></i> {{ __('Selesaikan Transaksi') }}
                    </button>
                </x-slot>
            </x-box>
            {{ html()->form()->close() }}
        </div>
        <div class="col-sm-5">
            <x-box type="success" flat="true" shadow="true">


                <table class="table table-striped table-bordered">
                    <thead>
                        <tr class="bg-primary">
                            <th>{{ __('Item') }}</th>
                            <th>{{ __('Total') }}</th>
                        </tr>
                    </thead>
                    <!-- /.thead -->
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
                                <strong>{{ e($product['quantity']) }} x {{ e($product['nama']) }}</strong>
                                <p class="text-muted small">{{ e($product['jenis']) }}</p>
                            </td>
                            <td align="right"><strong>{{ number_format($product['harga'] * $product['quantity'], 2, '.',
                                    ',') }}</strong>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                    @if($total_harga > 0)
                    <tfoot>
                        <tr>
                            <td>
                                <strong>{{ __('Total') }}</strong>
                            </td>
                            <td align="right">
                                <strong>{{ number_format($total_harga, 2, '.', ',') }}</strong>
                            </td>
                        </tr>
                    </tfoot>
                    @endif
                </table>
                <!-- /.table -->
            </x-box>
        </div>


    </div>
</div>

<!-- /.content-wrapper -->
@endsection

@section('style')

@endsection


@section('javascript')
<script type="text/javascript">
    var routeIndex = "{{ route('barang-masuk.index') }}";
    $(function () {

        // Select2 untuk barang dan supplier
        $('#supplier, #barang').select2({
            width: "100%"
        });

        // Datepicker tanggal masuk
        $('#tanggal_masuk').datepicker({
            autoclose: true,
            format: "yyyy-mm-dd"
        });

        //Handle submit Form
        submitForm("moduleForm", "btbSubmit");
    });
</script>
@stop