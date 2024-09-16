@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <x-content-header :title="__('Kartu Stok Opname')" :subtitle="__('')" />

    <div class="content">

        <div class="box border-top-solid">

            <div class="box-header with-border">

                <!-- Box Title -->
                <h3 class="box-title">
                    <i class="fa fa-list"></i>
                    {{__('Kartu Stok Opname')}} {{ $stokOpnameBarang->nama }}
                </h3>


                <div class="box-tools pull-right">
                    <div class="btn-group">

                        <a href="{{ route('stok-opname-barang.index') }}" class="btn-flat btn btn-default">
                            <i class="fa fa-fast-backward"></i> {{ __('Kembali') }}
                        </a>
                    </div>
                </div>
            </div>


            <!-- Form Atas -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nama">{{__('Nama')}}</label>
                            <div>
                                {{$stokOpnameBarang->nama}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nama">{{__('Tanggal')}}</label>
                            <div>
                                {{$stokOpnameBarang->tanggal}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nama">{{__('Keterangan')}}</label>
                            <div>
                                {{$stokOpnameBarang->keterangan}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Form Bawah -->
            @if($listBarang)
            <div class="box-body with-border">
                @include('stokOpnameBarang.formEmpat')
            </div>
            @endif

            <!-- <div class="box-footer with-border">
                <small>Daftar Barang untuk Stock Opname akan ditampilan seluruhnya</small>
            </div> -->

        </div>

    </div>


</div>
<!-- /.content-wrapper -->
@endsection

@section('style')

@endsection


@section('javascript')

@stop