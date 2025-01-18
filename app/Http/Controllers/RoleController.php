<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    //
    public function index()
    {
        $roles = \App\Models\Role::with(['permissions'])->select(['id', 'name', 'guard_name'])->orderBy('name', 'ASC')->get();
        $permissions = \App\Models\Permission::get();
        return view('role.index', [
            'roles' => $roles,
            'permissions' => $permissions,
        ]);
    }

    function addRole(Request $request)
    {
        $request->validate([
            'role_name' => 'required|string|unique:roles,name'
        ]);

        $role = \App\Models\Role::create(['name' => $request->role_name]);

        return response()->json([
            'status' => 'success',
            'message' => __('Data telah berhasil disimpan.'),
            'redirectTo' => route('role.index')
        ], 200);
    }

    // function addPermission(Request $request) {}

    function syncPermission(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'permission_id' => 'required|exists:permissions,id',
            'action' => 'required|in:assign,unassign',
        ]);

        // Ambil role dan permission berdasarkan ID
        $role = \App\Models\Role::findById($request->role_id);
        $permission = \App\Models\Permission::findById($request->permission_id);

        if ($request->action === 'assign') {
            // Tambahkan permission ke role
            $role->givePermissionTo($permission);
            return response()->json([
                'success' => true,
                'message' => 'Permission successfully assigned to role.',
            ]);
        } elseif ($request->action === 'unassign') {
            // Hapus permission dari role
            $role->revokePermissionTo($permission);
            return response()->json([
                'success' => true,
                'message' => 'Permission successfully unassigned from role.',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid action.',
        ], 400);
    }

    public function destroy(\App\Models\Role $role)
    {
        try {
            // Simpan data role untuk pesan konfirmasi
            $roleName = $role->name;

            // Hapus role
            $role->delete();

            // Kirimkan respons sukses
            return response()->json([
                'success' => true,
                'message' => "Role '{$roleName}' berhasil dihapus.",
            ], 200);
        } catch (\Exception $e) {
            // Tangani error dan kirimkan respons gagal
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus role.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
