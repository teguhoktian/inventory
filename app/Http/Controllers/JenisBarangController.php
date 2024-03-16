<?php

namespace App\Http\Controllers;

use App\Models\JenisBarang;
use App\Services\JenisBarangService;
use Illuminate\Http\Request;

class JenisBarangController extends Controller
{
    protected $services;

    function __construct(JenisBarangService $services)
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
        return view('jenisbarang.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('jenisbarang.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['nama' => 'required']);
        $this->services->create($request);
        return response()->json([
            'status' => 'success',
            'message' => __('Data telah berhasil disimpan.')
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JenisBarang  $jenisBarang
     * @return \Illuminate\Http\Response
     */
    public function show(JenisBarang $jenisBarang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JenisBarang  $jenisBarang
     * @return \Illuminate\Http\Response
     */
    public function edit(JenisBarang $jenisBarang)
    {
        return view('jenisbarang.edit', ['jenisBarang' => $jenisBarang]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JenisBarang  $jenisBarang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JenisBarang $jenisBarang)
    {
        //
        $request->validate(['nama' => 'required']);

        $this->services->update($request, $jenisBarang);

        return response()->json([
            'status' => 'success',
            'message' => __('Data telah berhasil diupdate.')
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JenisBarang  $jenisBarang
     * @return \Illuminate\Http\Response
     */
    public function destroy(JenisBarang $jenisBarang)
    {
        //
        $this->services->destroy($jenisBarang);
        return response()->json([
            'status' => 'success',
            'message' => __('Data telah berhasil dihapus.')
        ], 200);
    }
}
