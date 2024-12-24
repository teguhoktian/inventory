<?php

namespace App\Http\Controllers;

use App\Models\KantorCabang;
use App\Models\User;
use App\Services\KantorCabangService;
use Illuminate\Http\Request;

class KantorCabangController extends Controller
{
    protected $services;

    function __construct(KantorCabangService $services)
    {
        $this->services = $services;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) return $this->services->getDT();
        return view('kantorcabang.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branches = KantorCabang::buildKategoriTree();
        return view('kantorcabang.add', ['branches' => $branches, 'kantorCabang' => null]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'nama' => 'required', 'kode' => 'required|unique:kantor_cabang,kode',
                'parent_id' => 'nullable|exists:kantor_cabang,id'
            ]
        );

        $data = $this->services->create($request);
        return response()->json([
            'status' => 'success',
            'message' => __('Data telah berhasil disimpan.'),
            'redirectTo' => route('kantor-cabang.show', $data->id)
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KantorCabang  $kantorCabang
     * @return \Illuminate\Http\Response
     */
    public function show(KantorCabang $kantorCabang)
    {
        $users = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'Admin');
        })->orderBy('name', 'asc')->pluck('name', 'id');
        return view('kantorcabang.show', ['kantorCabang' => $kantorCabang, 'users' => $users]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KantorCabang  $kantorCabang
     * @return \Illuminate\Http\Response
     */
    public function edit(KantorCabang $kantorCabang)
    {
        $branches = KantorCabang::buildKategoriTree();
        return view('kantorcabang.edit', ['kantorCabang' => $kantorCabang, 'branches' => $branches]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KantorCabang  $kantorCabang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KantorCabang $kantorCabang)
    {
        $request->validate(
            [
                'nama' => 'required', 
                'kode' => 'required|unique:kantor_cabang,kode,' . $kantorCabang->id,
                'parent_id' => 'nullable|exists:kantor_cabang,id|not_in:' . $kantorCabang->id,
                ]
        );

        $this->services->update($request, $kantorCabang);

        return response()->json([
            'status' => 'success',
            'message' => __('Data telah berhasil diupdate.'),
            'redirectTo' => route('kantor-cabang.show', $kantorCabang->id)
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KantorCabang  $kantorCabang
     * @return \Illuminate\Http\Response
     */
    public function destroy(KantorCabang $kantorCabang)
    {
        $this->services->destroy($kantorCabang);
        return response()->json([
            'status' => 'success',
            'message' => __('Data telah berhasil dihapus.')
        ], 200);
    }

    public function addUser(Request $request, KantorCabang $kantorCabang) 
    {   
        $kantorCabang->users()->syncWithoutDetaching($request->user_id);
        return response()->json([
            'status' => 'success',
            'message' => __('User berhasil ditambahkan.'),
            'redirectTo' => route('kantor-cabang.show', $kantorCabang->id)
        ], 200);
    }

    public function deleteUser(Request $request, KantorCabang $kantorCabang)
    {
        $kantorCabang->users()->detach($request->user_id);
        return redirect()->back();
    }
}
