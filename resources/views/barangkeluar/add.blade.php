@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <x-content-header :title="__('Form Barang Keluar')" :subtitle="__('Tambah barang keluar')" />

    <div class="content">
        <div class="box border-top-solid">

            <div class="box-header with-border">
                <a href="{{ route('barang-keluar.index') }}" class="btn-sm btn btn-success">
                    <i class="fa fa-angle-double-left"></i> {{ __('Daftar') }}
                </a>
            </div>

            <div class="box-body">
                @include('barangkeluar.form2')
            </div>

            <div class="box-body" style="border-top: 1px solid #F4F4F4;">
                {{ Form::open([ 'route' => 'barang-keluar.store', 'files' => true, 'id' => 'moduleForm', 'class' =>
                'form-horizontal' ]) }}
                @include('barangkeluar.form')
                {{ Form::close() }}
            </div>

            @if($cart_count>0)
            <div class="box-footer">
                <button type="submit" id="btbSubmit" class="btn-flat btn btn-success pull-right">
                    {{ __('Simpan') }}
                </button>
            </div>
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
    var routeIndex = "{{ route('barang-keluar.index') }}";
    let getLastPriceRoute = "{{ route('barang-keluar.getLastPrice', ':id') }}";
    $(function () {

        $("#hargaBeli, #qty").change(function () {
            var Qty = $('#qty').val();
            var hargaBeli = $('#hargaBeli').val();
            console.log(Qty * hargaBeli)
            $("#totalHarga").val(Qty * hargaBeli);
        })

        $('#kantor, #barang').select2({
            width: "100%"
        });

        $('#barang').on('select2:select', function (e) {
            let data = $("#barang option:selected").val();
            $('#hargaBeli').val(0);
            $('#totalHarga').val(0);
            $('#qty').val(0);
            if (data) {
                var url = getLastPriceRoute.replace(':id', data);
                $.ajax({
                    url: url,
                    type: 'get',
                    success: function (response) {
                        let harga = response.harga;
                        $('#hargaBeli').val(harga);
                    }
                });
            }
        });


        $('#tanggal_keluar').datepicker({
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