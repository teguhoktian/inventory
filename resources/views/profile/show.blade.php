@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <x-content-header :title="__('User Profile')" :subtitle="__('')" />

    <div class="content">
        <div class="box border-top-solid">
            <div class="box-header with-border">
                <a href="{{ route('profile.edit') }}" class="btn btn-primary">
                    {{ __('Ubah Profil') }}
                </a>
            </div>
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