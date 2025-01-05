@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content">
        <div class="box box-solid box-success box-flat box-shadow">

            <div class="box-header with-border">
                <h2 class="box-title">
                    {{ __('Detail Kantor') }}
                </h2>

            </div>

            <form class="form-horizontal">
                <div class="box-body">

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="">{{ __('Kode') }}</label>
                        <div class="col-sm-10 {{ ($errors->has('kode') ? ' is-invalid' : '') }}">
                            {{ Form::text('nama', $kantorCabang->kode, [ 'class' => 'form-control', 'disabled'
                            =>
                            'disabled']) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="inputName">{{ __('Nama') }}</label>
                        <div class="col-sm-10 {{ ($errors->has('nama') ? ' is-invalid' : '') }}">
                            {{ Form::text('nama', $kantorCabang->nama, [ 'class' => 'form-control', 'disabled' =>
                            'disabled']) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="inputName">{{ __('Induk') }}</label>
                        <div class="col-sm-10">
                            {{ Form::text('nama', $kantorCabang->parent_text, [
                            'class' => 'form-control', 'disabled'
                            =>
                            'disabled']) }}
                        </div>
                    </div>

                </div>

                <div class="box-footer with-border">
                    <div class="form-group" style="margin-bottom: 0;">
                        <div class="col-sm-offset-2 col-sm-10">

                            <a href="{{ route('kantor-cabang.edit', ['kantor_cabang' => $kantorCabang->id]) }}"
                                class="btn-flat btn btn-primary">
                                <i class="fa fa-edit"></i> {{ __('Edit') }}
                            </a>

                            <a href="{{ route('kantor-cabang.index') }}" class="btn-flat btn btn-danger">
                                <i class="fa fa-times"></i> {{ __('Kembali') }}
                            </a>

                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- ./ Box Detail Kantor -->

        <div class="box box-solid box-success box-flat box-shadow">
            <div class="box-header">
                <h2 class="box-title">
                    <i class="fa fa-users"></i> {{ __('Attach User') }}
                </h2>
            </div>

            <div class="box-body">

                <div style="margin-bottom: 1rem;">
                    {{ Form::open(['route' => ['kantor-cabang.addUser', $kantorCabang->id], 'files' => true, 'id' =>
                    'moduleForm', 'class' => 'form-inline']) }}

                    <!-- User -->
                    <div class="form-group">
                        <label for="" class="sr-only">
                            {{ __('Pilih User') }}
                        </label>
                        <select class="form-control" name="user_id" id="select2">
                            <option value="">-- Pilih User --</option>
                            @foreach ($users as $id => $nama)
                            <option value="{{ $id }}">{{ $nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Pilih Jabatan -->
                    <div class="form-group">
                        <label for="" class="sr-only">
                            {{ __('Pilih Jabatan') }}
                        </label>
                        <select name="jabatan_id" class="form-control" id="jabatan">
                            <option value="">-- Pilih Jabatan --</option>
                            @foreach ($jabatans as $data)
                            <option value="{{ $data->id }}">
                                {{ str_repeat('---', $data->level - 1) }} {{ $data->deskripsi }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Pilih Status Jabatan -->
                    <div class="form-group">
                        <label for="" class="sr-only">
                            {{ __('Pilih Status') }}
                        </label>
                        <select class="form-control" name="status">
                            <option value="">-- Pilih Status --</option>
                            <option value="Definitif">Definitif</option>
                            <option value="Pj.">Pj.</option>
                            <option value="Plt.">Plt.</option>
                        </select>
                    </div>

                    <div class="form-group">

                        <button class="btn btn-flat btn-primary" id="btnSubmit">
                            <i class="fa fa-plus"></i> {{ __('Attach') }}
                        </button>
                    </div>


                    </form>
                </div>

                <!-- Table Form -->
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr style="background-color: #EEE;">
                            <th>
                                {{ __('No.') }}
                            </th>
                            <th>
                                {{ __('Nama') }}
                            </th>
                            <th>
                                {{ __('Jabatan') }}
                            </th>
                            <th>
                                {{ __('Status') }}
                            </th>
                            <th>
                                {{ __('Action') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($userKantorCabang as $jabatan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                {{ $jabatan->name }}
                            </td>
                            <td>
                                {{ $jabatan->nama_jabatan }}
                            </td>
                            <td>
                                {{ $jabatan->status }}
                            </td>
                            <td width="1px">
                                <button class="btn btn-sm btn-danger text-muted"
                                    onclick="submitDelete('delete-form-{{ $jabatan->id }}')">
                                    <i class="fa fa-unlink"></i>
                                    {{ __('Detach') }}
                                </button>
                                {!! Form::open([
                                'id' => 'delete-form-'.$jabatan->id,
                                'method' => 'DELETE',
                                'route' => ['kantor-cabang.deleteUser',
                                $kantorCabang->id],'style'=>'display:inline'])
                                !!}
                                {!! Form::hidden('jabatan_id', $jabatan->id) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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
    var routeIndex = "{{ route('kantor-cabang.index') }}";
    $(function () {

        $('#select2, #jabatan').select2({

        });

        submitForm("moduleForm", "btbSubmit");

    });

    function submitDelete(formId) {
        document.getElementById(formId).submit();
    }
</script>
@stop