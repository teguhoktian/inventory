@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <div class="content">
        <div class="box box-solid box-success">
            <div class="box-header">
                <h2 class="box-title">
                    {{ __('Edit Jenis Barang') }}
                </h2>
            </div>

            {{ Form::model($jenisBarang,
            [
            'route' => ['jenis-barang.update', $jenisBarang->id],
            'files' => true,
            'id' => 'moduleForm',
            'class' => 'form-horizontal',
            'method' => 'PATCH'
            ])
            }}
            <div class="box-body my-form-body">

                @include('jenisbarang.form')

            </div>

            <div class="box-footer with-border">
                <a href="{{ route('jenis-barang.index') }}" class="btn-flat btn btn-default">
                    <i class="fa fa-list"></i> {{ __('Kembali ke Daftar') }}
                </a>

                <button type="submit" id="btbSubmit" class="btn-flat btn btn-success pull-right">
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