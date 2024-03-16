@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-body">
                <div class="col-md-6">
                    <h4><i class="fa fa-user"></i> {{ __('Tambah Data') }}</h4>
                </div>
                <!-- /.com-md-6 -->

                <div class="col-md-6 text-right">
                    <a href="{{ route('jenis-barang.index') }}" class="btn-flat btn btn-success">
                        <i class="fa fa-list"></i> {{ __('Daftar') }}
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
            <div class="box-body my-form-body">
                {{ Form::open([ 'route' => 'jenis-barang.store', 'files' => true, 'id' => 'moduleForm', 'class' =>
                'form-horizontal' ]) }}
                @include('jenisbarang.form')
                <div class="form-group">
                    <div class="col-sm-11">
                        <button type="submit" id="btbSubmit" class="btn-flat btn btn-success pull-right">
                            {{ __('Simpan') }}
                        </button>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->
@endsection

@section('style')

@endsection


@section('javascript')
<script type="text/javascript">
    var routeIndex = "{{ route('jenis-barang.index') }}";
    $(function () {

        $("#moduleForm").submit(function (e) {
            e.preventDefault();

            var form = $(this);
            var _url = form.attr('action');
            var _method = form.attr('method');
            var data = form.serialize();

            $.ajax({
                url: _url,
                type: _method,
                data: data,
                dataType: 'json',
                beforeSend: function () {
                    $('div').removeClass('has-error');
                    $('.help-block').remove();
                    $("#btbSubmit").attr("disabled", true);
                },
                error: function (response) {
                    if (response.status == '422') {
                        $.each(response.responseJSON.errors, function (i, error) {
                            var el = $(document).find('[name="' + i + '"]');
                            el.parent().addClass("has-error").append('<span class="help-block">' + error[0] + '</span>');
                        });
                    }
                },
                success: function (response) {
                    swal({
                        title: "{{ __('Simpan Data') }}",
                        type: "success",
                        text: "{{ __('Data Berhasil Disimpan') }}"
                    }, function () {
                        window.location = routeIndex;
                    });
                }
            })

            $("#btbSubmit").attr("disabled", false);

        });
    });
</script>
@stop