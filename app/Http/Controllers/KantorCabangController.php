<?php

namespace App\Http\Controllers;

use App\Models\KantorCabang;
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

        $this->services->create($request);
        return response()->json([
            'status' => 'success',
            'message' => __('Data telah berhasil disimpan.')
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
        //
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
            'message' => __('Data telah berhasil diupdate.')
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
}
