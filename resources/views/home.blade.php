@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-body">
                <div class="col-md-6">
                    <h4>
                        <i class="fa fa-home"></i>
                        {{ __('Sistem Informasi Ruang Gigi') }}
                    </h4>
                    <h3>{{ __('Selamat Datang') }}, {{ Auth::user()->name }}.</h3>
                </div>
                <!-- /.com-md-6 -->
            </div>
            <!-- /.box -->

            <div class="content row">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Barang</span>
                            <span class="info-box-number">1,410</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-green"><i class="fa fa-flag-o"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Barang Masuk</span>
                            <span class="info-box-number">410</span>
                        </div>

                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-red"><i class="fa fa-star-o"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Barang Keluar</span>
                            <span class="info-box-number">93,139</span>
                        </div>

                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-yellow"><i class="fa fa-files-o"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Sisa Kas</span>
                            <span class="info-box-number">13,648</span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- /.com-md-12 -->
    </div>
    <!-- /.row -->

    <div class="content">

    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection