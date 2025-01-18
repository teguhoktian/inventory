<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\UserServices;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UsersDataTable $dataTable)
    {
        // if (request()->ajax()) return $services->getDT();
        // return view('user.index');
        return $dataTable->render('user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(UserServices $services)
    {
        $options = $services->options();
        return view('user.add', [
            'roles' => $options['roles'],
            'cabangs' => $options['cabangs'],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request, UserServices $services)
    {
        $user = $services->create($request);
        return response()->json([
            'status' => 'success',
            'message' => __('Data telah berhasil disimpan.'),
            'redirectTo' => route('user.edit', $user->id)
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user) {}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, UserServices $services)
    {
        $options = $services->options();
        $user->roles = $user->roles->pluck('id', 'id');
        $user->cabangs = $user->kantorCabangs()->pluck('kantor_id', 'kantor_id');

        return view('user.edit', [
            'user' => $user,
            'roles' => $options['roles'],
            'cabangs' => $options['cabangs'],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user, UserServices $services)
    {
        // if ($user->kode_desa !== env('APP_KODE_DESA')) abort('403');
        $services->update($request, $user);
        return response()->json([
            'status' => 'success',
            'message' => __('Data telah berhasil disimpan.'),
            'redirectTo' => route('user.edit', $user->id)
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, UserServices $services)
    {
        $services->destroy($user);
        return response()->json([
            'status' => 'success',
            'message' => __('Data telah berhasil dihapus.')
        ], 200);
    }
}
