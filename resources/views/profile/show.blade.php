@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-body">
                <div class="col-md-6">
                    <h4>
                        <i class="fa fa-user"></i> 
                        {{ __('Profil') }}
                    </h4>
                </div>
                <!-- /.com-md-6 -->

                <div class="col-md-6 text-right">
                    <a href="{{ route('profile.edit') }}" class="btn-flat btn-social btn btn-primary">
                        <i class="fa fa-edit"></i> {{ __('Ubah Profil') }}
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
			<div class="box-body">
                <table class="table">
                    <tr>
                        <td width="10%">{{ __('Nama') }}</td>
                        <td width="1">:</td>
                        <td>{{ Auth::user()->name }}</td>
                    </tr>
                    <tr>
                        <td width="10%">{{ __('Username') }}</td>
                        <td width="1">:</td>
                        <td>{{ Auth::user()->username }}</td>
                    </tr>
                    <tr>
                        <td width="10%">{{ __('Email') }}</td>
                        <td width="1">:</td>
                        <td>{{ Auth::user()->email }}</td>
                    </tr>
                    <tr>
                        <td width="10%">{{ __('Hak Akses') }}</td>
                        <td width="1">:</td>
                        <td>{{ Auth::user()->roles->pluck('name')->implode(', ') }}</td>
                    </tr>
                    @hasanyrole('Penduduk Desa')
                    <tr>
                        <td width="10%">{{ __('NIK') }}</td>
                        <td width="1">:</td>
                        <td><a href="{{ route('penduduk.edit', Auth::user()->penduduk->id) }}">{{ Auth::user()->penduduk->nik }}</a></td>
                    </tr>
                    @endhasanyrole
                </table>
            </div>
        </div>
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
