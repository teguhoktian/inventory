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


                            {!! html()->text('kode', $kantorCabang->kode)
                            ->class('form-control')
                            ->disabled(true) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="inputName">{{ __('Nama') }}</label>
                        <div class="col-sm-10 {{ ($errors->has('nama') ? ' is-invalid' : '') }}">

                            {!! html()->text('nama', $kantorCabang->nama)
                            ->class('form-control')
                            ->disabled(true) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="inputName">{{ __('Induk') }}</label>
                        <div class="col-sm-10">

                            {!! html()->text('nama', $kantorCabang->parent_text)
                            ->class('form-control')
                            ->disabled(true) !!}
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

                    {!! html()->form('POST', route('kantor-cabang.addUser', $kantorCabang->id))
                    ->attribute('id', 'moduleForm')
                    ->class('form-inline')
                    ->acceptsFiles()
                    ->open() !!}

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



                    {{ html()->form()->close() }}
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
                                @if($jabatan->status !== 'Definitif') {{ $jabatan->status }} @endif
                                {{ $jabatan->nama_jabatan }}
                            </td>
                            <td>
                                <button class="btn btn-sm {{ $jabatan->is_active ? 'btn-success' : 'btn-danger' }}"
                                    onclick="toggleStatus({{ $jabatan->posisi_id }})"
                                    id="status-button-{{ $jabatan->posisi_id }}">
                                    {{ $jabatan->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                </button>
                            </td>
                            <td width="1px">
                                <button class="btn btn-sm btn-danger text-muted"
                                    onclick="submitDelete('delete-form-{{ $jabatan->id }}')">
                                    <i class="fa fa-unlink"></i>
                                    {{ __('Detach') }}
                                </button>

                                {!! html()->form('DELETE', route('kantor-cabang.deleteUser', $kantorCabang->id))
                                ->id('delete-form-'.$jabatan->id)
                                ->style('display: inline;')
                                ->open() !!}

                                {!! html()->hidden('jabatan_id', $jabatan->id) !!}

                                {!! html()->form()->close() !!}
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

    // Toggle Status Jabatan
    function toggleStatus(jabatanId) {
        // Kirim AJAX request
        fetch(`{{ route('kantor-cabang.status', ['id' => ':id']) }}`.replace(':id', jabatanId), {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({})
        })
            .then(response => response.json())
            .then(data => {

                if (data.success) {
                    // Update tombol status
                    const statusButton = document.getElementById(`status-button-${jabatanId}`);
                    statusButton.textContent = data.is_active ? 'Aktif' : 'Tidak Aktif';
                    statusButton.className = data.is_active ? 'btn btn-sm btn-success' : 'btn btn-sm btn-danger';

                    // Tampilkan pesan sukses (opsional)
                    //alert(data.message);
                } else {
                    alert('Gagal mengubah status.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat mengubah status.');
            });
    }
</script>
@stop