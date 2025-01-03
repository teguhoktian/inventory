@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content">
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