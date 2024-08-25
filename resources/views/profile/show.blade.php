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
                    <a href="{{ route('profile.edit') }}" class="btn-social btn btn-primary">
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
                        <th width="10%">{{ __('Nama') }}</th>
                        <td width="1">:</td>
                        <td>{{ Auth::user()->name }}</td>
                    </tr>
                    <tr>
                        <th width="10%">{{ __('Username') }}</th>
                        <td width="1">:</td>
                        <td>{{ Auth::user()->username }}</td>
                    </tr>
                    <tr>
                        <th width="10%">{{ __('Email') }}</th>
                        <td width="1">:</td>
                        <td>{{ Auth::user()->email }}</td>
                    </tr>
                    <tr>
                        <th width="10%">{{ __('Hak Akses') }}</th>
                        <td width="1">:</td>
                        <td>{{ Auth::user()->roles->pluck('name')->implode(', ') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection