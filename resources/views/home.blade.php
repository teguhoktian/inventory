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