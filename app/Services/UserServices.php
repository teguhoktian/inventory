<?php

namespace App\Services;

use App\Models\KantorCabang;
use Yajra\DataTables\DataTables;
use App\Models\User;
use App\Notifications\UserEmailVerification;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserServices
{
    public function getDT()
    {
        return DataTables::of(User::latest()->get())
            ->addColumn('role', function ($row) {
                $role = '<span class="btn btn-sm bg-aqua-active">' . $row->roles->pluck('name')->implode(', ') . '</span>';
                return $role;
            })
            ->addColumn('action', 'user.action')
            ->addIndexColumn()
            ->rawColumns(['action', 'role'])
            ->make(true);
    }

    public function destroy($user)
    {
        $user->delete();
    }

    public function create($request)
    {
        $user = null;
        $request['password'] = Hash::make($request['password']);
        $request['kode_desa'] = env('APP_KODE_DESA');
        $user = User::create($request->all());
        $user->syncRoles([$request->roles]);
        $user->kantorCabangs()->sync($request->cabangs);
        //$user->notify(new UserEmailVerification());
        return $user;
    }

    public function update($request, $user)
    {
        if (is_null($request['password'])) {
            $request['password'] = $user->password;
        } else {
            $request['password'] = Hash::make($request['password']);
        }

        $user->roles()->sync([$request->roles]);

        $user->kantorCabangs()->sync($request->cabangs);

        return $user->update($request->all());
    }

    public function options()
    {
        return [
            'roles' => Role::pluck('name', 'id'),
            'cabangs' => KantorCabang::orderby('nama', 'ASC')->pluck('nama', 'id'),
        ];
    }
}
