@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content">

        <div class="row">
            <div class="col-md-3">
                <div class="box box-success">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="{{ Auth::user()->image }}"
                            alt="User profile picture">

                        <h3 class="profile-username text-center">
                            {{ Auth::user()->name }}
                        </h3>

                        <p class="text-muted text-center">Role: {{ Auth::user()->roles->pluck('name')->implode(',') }}
                        </p>

                        <!--  <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Followers</b> <a class="pull-right">1,322</a>
                            </li>
                            <li class="list-group-item">
                                <b>Following</b> <a class="pull-right">543</a>
                            </li>
                            <li class="list-group-item">
                                <b>Friends</b> <a class="pull-right">13,287</a>
                            </li>
                        </ul>

                        <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <!-- /.col-md-3 -->

            <div class="col-md-9">
                <div class="box box-solid box-flat box-shadow box-success">
                    <div class="box-header with-border">
                        <h2 class="box-title">
                            {{ __('My Profile') }}
                        </h2>
                    </div>
                    <div class="box-body">
                        @include('profile.personal')
                    </div>
                </div>
                <!-- /.box -->

                <div class="box box-flat box-success box-sadow box-solid">
                    <div class="box-header with-border">
                        <h2 class="box-title">
                            {{ __('Password') }}
                        </h2>
                    </div>
                    <div class="box-body">
                        @include('profile.password')
                    </div>
                </div>
            </div>
            <!-- /.col-md-9 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

@section('style')

@endsection


@section('javascript')
<script type="text/javascript">

    $(function () {

        submitFile("personalForm", "personalBtn");
        submitForm("passwordForm", "passwordBtn");

    });
</script>
@stop