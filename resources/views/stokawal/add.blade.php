@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content">
        <div class="box box-solid box-success">

            <div class="box-header">
                <h2 class="box-title">
                    {{ __('Stok Awal') }}
                </h2>
            </div>

            <div class="box-body">
                @include('stokawal.form2')
            </div>

            @if($cart_count>0)
            {{ Form::open([ 'route' => 'stok-awal.store', 'files' => true, 'id' => 'moduleForm', 'class' =>
            'form-horizontal' ]) }}
            <div class="box-footer">
                <a href="{{ route('barang.index') }}" class="btn-flat btn btn-default">
                    <i class="fa fa-angle-double-left"></i> {{ __('Cancel') }}
                </a>
                <button type="submit" id="btbSubmit" class="btn-flat btn btn-success pull-right">
                    <i class="fa fa-save"></i> {{ __('Simpan') }}
                </button>
            </div>
            {{ Form::close() }}
            @endif
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

        $("#hargaBeli, #qty").on("input", function () {
            var Qty = $('#qty').val();
            var hargaBeli = $('#hargaBeli').val();
            console.log(Qty * hargaBeli)
            $("#totalHarga").val(Qty * hargaBeli);
        })

        $('#supplier, #barang').select2({
            width: "100%"
        });


        $('#tanggal_masuk').datepicker({
            autoclose: true,
            format: "yyyy-mm-dd"
        });

        $("#btbSubmit").click(function (e) {

            e.preventDefault();
            var form = $("#moduleForm");
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