@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content">

        <x-box type="success" flat="true" shadow="true">
            <x-slot name="header">
                {{ __('Input Barang Masuk') }}
            </x-slot>

            @include('barangmasuk.form2')

            <br>
            {{ Form::open([ 'route' => 'barang-masuk.store', 'files' => true, 'id' => 'moduleForm', 'class' =>
            'form-horizontal' ]) }}
            @include('barangmasuk.form')
            {{ Form::close() }}


            <x-slot name="footer">

                <a href="{{ route('barang-masuk.index') }}" class="btn-flat btn btn-default">
                    <i class="fa fa-angle-double-left"></i> {{ __('Cancel') }}
                </a>
                <button type="submit" id="btbSubmit" class="btn-flat btn btn-success pull-right">
                    {{ __('Simpan') }}
                </button>

            </x-slot>

        </x-box>

        <div class="box box-solid box-success box-flat box-shadow">

            <div class="box-header">
                <h2 class="box-title">
                    {{ __('Input Barang Masuk') }}
                </h2>
                <!-- /.box-title -->
            </div>
            <!-- /.box-header -->

            <div class="box-body">
                @include('barangmasuk.form2')
            </div>
            <!--  -->

            <div class="box-body" style="border-top: 1px solid #F4F4F4;">
                {{ Form::open([ 'route' => 'barang-masuk.store', 'files' => true, 'id' => 'moduleForm', 'class' =>
                'form-horizontal' ]) }}
                @include('barangmasuk.form')
                {{ Form::close() }}
            </div>

            @if($cart_count>0)
            <div class="box-footer">
                <a href="{{ route('barang-masuk.index') }}" class="btn-flat btn btn-default">
                    <i class="fa fa-angle-double-left"></i> {{ __('Cancel') }}
                </a>
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
    var routeIndex = "{{ route('barang-masuk.index') }}";
    $(function () {

        // Reactive Harga Beli
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