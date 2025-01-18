<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
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
        // User
        $users = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'Admin');
        })->orderBy('name', 'asc')->pluck('name', 'id');

        //Jabatan
        $jabatans = Jabatan::getAllJabatan();

        //User di Kantor Cabang
        $userKantorCabang = Jabatan::getUserByKantor($kantorCabang->id);

        return view('kantorcabang.show', [
            'kantorCabang' => $kantorCabang, 
            'users' => $users,
            'jabatans' => $jabatans,
            'userKantorCabang' => $userKantorCabang
        ]);
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
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id', // Pastikan user_id ada di tabel users
            'jabatan_id' => 'required|exists:jabatan,id', // Pastikan parent_id ada di tabel jabatan
            'status' => 'required|in:Definitif,Pj.,Plt.', // Validasi status jabatan
        ]);

        // Menambahkan jabatan dan status ke dalam pivot tabel jabatan_user
        $kantorCabang->jabatans()->attach($request->jabatan_id, [
            'user_id' => $request->user_id,  // Menambahkan user_id
            'kantor_id' => $kantorCabang->id,  // Menambahkan kantor_id
            'status' => $request->status,      // Menambahkan status jabatan
        ]);

        return response()->json([
            'status' => 'success',
            'message' => __('User berhasil ditambahkan.'),
            'redirectTo' => route('kantor-cabang.show', $kantorCabang->id)
        ], 200);
    }

    public function deleteUser(Request $request, KantorCabang $kantorCabang)
    {
        $pivot = $kantorCabang->jabatans()->wherePivot('jabatan_id', $request->jabatan_id)->first();

        if ($pivot) {
            $kantorCabang->jabatans()->detach($request->jabatan_id);
            return redirect()->back();
        } 

        abort(404, __('Route not found'));
    }
}
