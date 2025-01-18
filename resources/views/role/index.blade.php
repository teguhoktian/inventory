@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <div class="content">

        <x-box type="success">
            <x-slot name="header">
                {{ __('Role') }}
            </x-slot>

            <div style="margin-bottom: 1rem;">
                <button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#role-modal">
                    <i class="fa fa-plus"></i> {{ __('Add Role') }}
                </button>

                <!-- Permission Button Add -->
                <!-- <button type="button" class="btn btn-warning btn-flat" data-toggle="modal"
                    data-target="#permission-modal">
                    <i class="fa fa-plus"></i> {{ __('Add Permission') }}
                </button> -->
            </div>

            <!-- Content Box -->
            <table class="table table-striped table-bordered">
                <thead class="bg-primary">
                    <tr>
                        <td width="1px">No.</td>
                        <td>Role</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $role)
                    <tr class="role-row" data-target="permission-{{ $loop->iteration }}">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $role->name }}
                        </td>
                        <td style="width: 120px;">

                        </td>
                    </tr>
                    <tr id="permission-{{ $loop->iteration }}" class="permission-row"
                        style="display: none; background-color: rgba(237, 237, 237, 0.933);">
                        <td>

                        </td>
                        <td colspan="">
                            <div class="permissions-container">
                                @foreach ($permissions->chunk(4) as $chunk)
                                <div class="row" style="margin-bottom: 5px;">
                                    @foreach ($chunk as $permission)
                                    @if ($role->permissions->contains('id', $permission->id))
                                    <!-- Jika role memiliki permission -->
                                    <label class="label label-success permission-label col-xs-3"
                                        data-role-id="{{ $role->id }}" data-permission-id="{{ $permission->id }}"
                                        data-action="unassign"
                                        style="cursor: pointer; display: inline-block; margin: 2px; width: auto;">
                                        {{ $permission->name }}
                                    </label>
                                    @else
                                    <!-- Jika role tidak memiliki permission -->
                                    <label class="label label-default permission-label col-xs-3"
                                        data-role-id="{{ $role->id }}" data-permission-id="{{ $permission->id }}"
                                        data-action="assign"
                                        style="cursor: pointer; display: inline-block; margin: 2px; width: auto;">
                                        {{ $permission->name }}
                                    </label>
                                    @endif
                                    @endforeach
                                </div>
                                @endforeach
                            </div>

                        </td>
                        <td>
                            <a href="javascript:void(0)" class="btn btn-sm btn-danger delete-role-btn"
                                data-role-id="{{ $role->id }}">
                                <i class="fa fa-times"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </x-box>
        <!-- /. Box -->
    </div>
    <!-- /. End Content -->
</div>
<!-- /. End Content Wrapper -->

<!-- Modal Form untunk Add New Role -->
{{ Form::open([ 'route' => 'role.create-role', 'id' =>'addNewRoleForm', 'class' => 'form-horizontal' ]) }}
<x-modal id="role-modal">
    <x-slot name="header">
        <h4 class="modal-title">{{ __('Add New Role') }}</h4>
    </x-slot>
    <x-slot name="body">
        {{
        Form::label('role_name', __('Role Name'), ['class' => 'col-form-label'])
        }}
        {{
        Form::text('role_name', null, ['class' => 'form-control', 'placeholder'
        => __('Role Name'), 'required'])

        }}
    </x-slot>
    <x-slot name="footer">
        <button type="submit" class="btn btn-primary btn-flat" id="addNewRoleBtn">
            <i class="fa fa-check"></i> {{ __('Add New Role') }}
        </button>
    </x-slot>
</x-modal>
{{ Form::close() }}

<!-- Modal Form untunk Add New Permission -->
{{ Form::open([ 'route' => 'role.create-permission', 'id' => 'addNewPermissionForm', 'class' => 'form-horizontal' ]) }}
<x-modal id="permission-modal">
    <x-slot name="header">
        <h4 class="modal-title">{{ __('Add Permission') }}</h4>
    </x-slot>
    <x-slot name="body">

    </x-slot>
    <x-slot name="footer">
        <button type="submit" class="btn btn-warning btn-flat">
            <i class="fa fa-check"></i> {{ __('Add New Permission') }}
        </button>
    </x-slot>
</x-modal>
{{ Form::close() }}

@endsection

@section('style')
<style>
    .role-row {
        cursor: pointer;
    }
</style>
@endsection

@section('javascript')
<script>

    $(function () {
        submitForm('addNewRoleForm', 'addNewRoleFormBtn');

        //Tombol Delete
        $('.delete-role-btn').on('click', function (e) {
            e.preventDefault();

            const roleId = $(this).data('role-id'); // Ambil ID role
            const url = "{{ route('role.delete', ':id') }}".replace(':id', roleId); // Ganti dengan route Anda
            const token = "{{ csrf_token() }}"; // Ambil token CSRF

            // Konfirmasi hapus
            if (!confirm('Apakah Anda yakin ingin menghapus role ini?')) {
                return;
            }

            // AJAX request
            $.ajax({
                url: url,
                type: 'DELETE',
                data: {
                    _token: token,
                    id: roleId,
                },
                success: function (response) {
                    if (response.success) {
                        // Hapus row dari tabel
                        $(`tr[data-target="permission-${roleId}"]`).remove();
                        $(`#permission-${roleId}`).remove();

                        // Tampilkan pesan sukses
                        //alert('Role berhasil dihapus.');
                        location.reload();
                    } else {
                        alert('Gagal menghapus role. Silakan coba lagi.');
                    }
                },
                error: function (xhr) {
                    alert('Terjadi kesalahan: ' + xhr.responseText);
                },
            });
        });
    })

    document.addEventListener('DOMContentLoaded', function () {
        const rows = document.querySelectorAll('.role-row');

        rows.forEach(row => {
            row.addEventListener('click', function () {
                const targetId = row.getAttribute('data-target');
                const targetRow = document.getElementById(targetId);

                if (targetRow.style.display === 'none') {
                    targetRow.style.display = 'table-row'; // Tampilkan baris
                } else {
                    targetRow.style.display = 'none'; // Sembunyikan baris
                }
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        const permissionLabels = document.querySelectorAll('.permission-label');

        permissionLabels.forEach(label => {
            label.addEventListener('click', function () {
                const roleId = this.getAttribute('data-role-id');
                const permissionId = this.getAttribute('data-permission-id');
                const action = this.getAttribute('data-action'); // assign atau unassign

                // Kirim permintaan AJAX
                fetch('{{ route("role.syncPermission") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Pastikan token CSRF disertakan
                    },
                    body: JSON.stringify({
                        role_id: roleId,
                        permission_id: permissionId,
                        action: action
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Perbarui label setelah berhasil
                            if (action === 'assign') {
                                this.classList.remove('label-default');
                                this.classList.add('label-success');
                                this.setAttribute('data-action', 'unassign');
                            } else if (action === 'unassign') {
                                this.classList.remove('label-success');
                                this.classList.add('label-default');
                                this.setAttribute('data-action', 'assign');
                            }
                        } else {
                            alert('Gagal memperbarui permission: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat menghubungi server.');
                    });
            });
        });
    });
</script>

@stop