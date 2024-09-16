<?php

namespace App\Http\Controllers;

use App\DataTables\StokOpnameBarangDataTable;
use App\Http\Requests\StokOpnameBarangRequest;
use App\Models\DetailStokOpnameBarang;
use App\Models\StokOpnameBarang;
use App\Services\BarangService;
use Illuminate\Http\Request;
use PDF;

class StokOpnameBarangController extends Controller
{
    private $listBarang = null;

    //make construct
    public function __construct()
    {
        $this->listBarang = \App\Models\Barang::get();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(StokOpnameBarangDataTable $dataTable)
    {
        return $dataTable->render('stokOpnameBarang.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $cekStatus = StokOpnameBarang::where('status', 'Open')->first();
        if($cekStatus) return redirect()->route('stok-opname-barang.edit', [$cekStatus->id]);

        return view('stokOpnameBarang.add',[
            'listBarang' => $this->listBarang
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StokOpnameBarangRequest $request)
    {
        $stokOpnameBarang = StokOpnameBarang::create($request->all());
        
        if($stokOpnameBarang){
            
            $this->insertDetailStokOpnameBarang($stokOpnameBarang);

            return response()->json([
                'status' => 'success',
                'redirectTo' => route('stok-opname-barang.edit', [$stokOpnameBarang->id]),
                'message' => __('Data telah berhasil disimpan.')
            ], 200);
        }
    }

    function insertDetailStokOpnameBarang($stokOpnameBarang)
    {
        foreach($this->listBarang as $key => $barang)
        {
            DetailStokOpnameBarang::create([
                'id_stok_opname' => $stokOpnameBarang->id,
                'id_barang' => $barang->id,
                'stok_aplikasi' => $barang->stok,
                'stok_fisik' => null,
                'selisih' => null,
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StokOpnameBarang  $stokOpnameBarang
     * @return \Illuminate\Http\Response
     */
    public function show(StokOpnameBarang $stokOpnameBarang)
    {
        return view('stokOpnameBarang.show',[
            'stokOpnameBarang' => $stokOpnameBarang,
            'listBarang' => $stokOpnameBarang->details
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StokOpnameBarang  $stokOpnameBarang
     * @return \Illuminate\Http\Response
     */
    public function edit(StokOpnameBarang $stokOpnameBarang)
    {
        if($stokOpnameBarang->status !== 'Open') abort('404');

        return view('stokOpnameBarang.edit',[
            'stokOpnameBarang' => $stokOpnameBarang,
            'listBarang' => $stokOpnameBarang->details
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StokOpnameBarang  $stokOpnameBarang
     * @return \Illuminate\Http\Response
     */
    public function update(StokOpnameBarangRequest $request, StokOpnameBarang $stokOpnameBarang)
    {   
        if($stokOpnameBarang->status !== "Open") abort('403', __('Aksi tidak bisa dilakukan untuk status Stok Opname ini.'));
    
        $stokOpnameBarang->status = 'Selesai';
        $stokOpnameBarang->update($request->all());

        return response()->json([
            'status' => 'success',
            'redirectTo' => route('stok-opname-barang.show', $stokOpnameBarang->id),
            'message' => __('Data telah berhasil disimpan.')
        ], 200);
    }

    public function batalSOBarang(Request $request, StokOpnameBarang $stokOpnameBarang)
    {   
        // return $stokOpnameBarang;
        if($stokOpnameBarang->status !== "Open") abort('403', __('Aksi tidak bisa dilakukan untuk status Stok Opname ini.'));
        $stokOpnameBarang->status = 'Batal';
        $stokOpnameBarang->update($request->all());

        return redirect()->route('stok-opname-barang.index');
    }

    function updateStokFisik(DetailStokOpnameBarang $detailStokOpnameBarang, Request $request)
    {
        $detailStokOpnameBarang->stok_fisik = $request->stok_fisik;
        $detailStokOpnameBarang->selisih = $request->stok_fisik - $detailStokOpnameBarang->stok_aplikasi;
        $detailStokOpnameBarang->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StokOpnameBarang  $stokOpnameBarang
     * @return \Illuminate\Http\Response
     */
    public function destroy(StokOpnameBarang $stokOpnameBarang)
    {
        //
    }

    public function printKartuStokOpname(StokOpnameBarang $stokOpnameBarang)
    {

        $pdf = PDF::loadView('stokOpnameBarang.print', [
            'stokOpnameBarang' => $stokOpnameBarang,
            'listBarang' => $stokOpnameBarang->details
        ]);

        return $pdf->download('SO-Card.pdf');

        // return view('stokOpnameBarang.print',[
        //     'stokOpnameBarang' => $stokOpnameBarang,
        //     'listBarang' => $stokOpnameBarang->details
        // ]);
    }
}
