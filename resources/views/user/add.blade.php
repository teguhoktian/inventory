@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content">
        <div class="box box-solid box-success box-flat box-shadow">
            <div class="box-header">
                <h3 class="box-title">{{ __('Tambah Pengguna') }}</h3>
            </div>
            <div class="box-body">
                {{ Form::open([ 'route' => 'user.store', 'files' => true, 'id' => 'moduleForm', 'class' =>
                'form-horizontal' ]) }}
                @include('user.form')
            </div>
            <div class="box-footer with-border">
                <a href="{{ route('user.index') }}" class="btn-flat btn-default btn btn-default">
                    <i class="fa fa-arrow-left"></i> {{ __('Cancel') }}
                </a>
                <button type="submit" id="btbSubmit" class="btn-flat btn btn-primary pull-right">
                    <i class="fa fa-save"></i> {{ __('Simpan') }}
                </button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
<!-- /.content-wrapper -->
@endsection

@section('style')

@endsection


@section('javascript')
<script type="text/javascript">
    var routeIndex = "{{ route('user.index') }}";
    $(function () {

        $('#select2').select2({
            width: "100%",
        });

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
                        window.location = "{{ route('user.index') }}";
                    });
                }
            })

            $("#btbSubmit").attr("disabled", false);

        });
    });
</script>
@stop