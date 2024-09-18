<?php

namespace App\Http\Controllers;

use App\Services\BarangService;
use Illuminate\Http\Request;

class LaporanStokBarangController extends Controller
{
    public $service = null;
    //make construct method
    public function __construct(BarangService $barangService)
    {
        $this->service = $barangService;
    }

    function index(Request $request)
    {   
        $stokBarang = $request->has(['tanggal_mulai', 'tanggal_akhir']) ? $this->service->getKartuStok($request['tanggal_mulai'], $request['tanggal_akhir']) : [];
        
        return view('laporan.stok-barang',[
            'stokBarang' => $stokBarang,
            'tanggal_mulai' => $request['tanggal_mulai'] ?:"",
            'tanggal_akhir' => $request['tanggal_akhir'] ?:"",
        ]); 
    }
}
