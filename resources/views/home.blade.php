@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content-header">
        <h1>Dashboard
            <small>Inventory Dashboard</small>
        </h1>
    </div>
    <div class="content">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-shopping-cart"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ __('Total Barang') }}</span>
                        <span class="info-box-number">{{ $barangs->count() }} Item</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-sign-in"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ __('Barang Masuk') }}</span>
                        <span class="info-box-number">{{ $barangMasuk->count() }} Item</span>
                    </div>

                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-sign-out"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ __('Barang Keluar') }}</span>
                        <span class="info-box-number">{{ $barangKeluar->count() }} Item</span>
                    </div>

                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-money"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{__('Sisa Kas')}}</span>
                        <span class="info-box-number">
                            {{ number_format($barangMasuk->sum('total') - $barangKeluar->sum('total'),0,".",",") }}

                        </span>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- /.com-md-12 -->

    <!-- /.row -->

    <div class="content">

    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection