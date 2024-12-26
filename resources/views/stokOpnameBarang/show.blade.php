@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content">

        <div class="box box-solid box-success  box-flat box-shadow">

            <div class="box-header with-border">

                <!-- Box Title -->
                <h3 class="box-title">
                    <i class="fa fa-list"></i>
                    {{__('Kartu Stok Opname')}}
                </h3>
            </div>


            <!-- Form Atas -->
            <div class="box-body">
                <div style="margin-bottom: 1.5rem;">
                    <div class="btn-group">

                        <a href="{{ route('stok-opname-barang.index') }}" class="btn-flat btn btn-default">
                            <i class="fa fa-fast-backward"></i> {{ __('Kembali') }}
                        </a>
                        <a href="{{ route('stok-opname-barang.cetakStok', $stokOpnameBarang->id) }}"
                            class="btn-flat btn btn-warning">
                            <i class="fa fa-print"></i> {{ __('Cetak Kartu') }}
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="nama">{{__('Kode')}}</label>
                            <div>
                                {{$stokOpnameBarang->kode}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="nama">{{__('Nama')}}</label>
                            <div>
                                {{$stokOpnameBarang->nama}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="nama">{{__('Tanggal')}}</label>
                            <div>
                                {{$stokOpnameBarang->tanggal}}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="nama">{{__('Petugas')}}</label>
                            <div>
                                {{$stokOpnameBarang->user?->name}}
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
            @if($groupedByJenis)
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