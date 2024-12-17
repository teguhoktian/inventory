<?php

namespace App\Http\Controllers;

use App\Models\SatuanBarang;
use App\Services\SatuanBarangService;
use Illuminate\Http\Request;

class SatuanBarangController extends Controller
{

    protected $services;

    function __construct(SatuanBarangService $services)
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
        return view('satuanbarang.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('satuanbarang.add');
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
     * @param  \App\Models\SatuanBarang  $satuanBarang
     * @return \Illuminate\Http\Response
     */
    public function show(SatuanBarang $satuanBarang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SatuanBarang  $satuanBarang
     * @return \Illuminate\Http\Response
     */
    public function edit(SatuanBarang $satuanBarang)
    {
        //
        return view('satuanbarang.edit', ['satuanBarang' => $satuanBarang]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SatuanBarang  $satuanBarang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SatuanBarang $satuanBarang)
    {
        //
        $request->validate(['nama' => 'required']);

        $this->services->update($request, $satuanBarang);

        return response()->json([
            'status' => 'success',
            'message' => __('Data telah berhasil diupdate.')
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SatuanBarang  $satuanBarang
     * @return \Illuminate\Http\Response
     */
    public function destroy(SatuanBarang $satuanBarang)
    {
        //
        $this->services->destroy($satuanBarang);
        return response()->json([
            'status' => 'success',
            'message' => __('Data telah berhasil dihapus.')
        ], 200);
    }
}
