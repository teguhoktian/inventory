@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <x-content-header :title="__('Edit')" :subtitle="__('Ubah Data Barang')" />

    <div class="content">
        <div class="box border-top-solid">
            <div class="box-header with-border">
                <a href="{{ route('barang.index') }}" class="btn-flat btn btn-default">
                    &laquo; {{ __('Kembali') }}
                </a>
            </div>
            <div class="box-body my-form-body">
                {{ Form::model($barang,
                [
                'route' => ['barang.update', $barang->id],
                'files' => true,
                'id' => 'moduleForm',
                'class' => 'form-horizontal',
                'method' => 'PATCH'
                ])
                }}
                @include('barang.form')
                <div class="form-group">
                    <div class="col-sm-11">
                        <button type="submit" id="btbSubmit" class="btn-flat btn btn-success pull-right">
                            {{ __('Update') }}
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
    var routeIndex = "{{ route('barang.index') }}";
    $(function () {

        $('#jenisBarang, #satuanBarang').select2({
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
                        window.location = routeIndex;
                    });
                }
            })

            $("#btbSubmit").attr("disabled", false);

        });
    });
</script>
@stop