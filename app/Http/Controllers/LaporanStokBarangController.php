<?php

namespace App\Http\Controllers;

use App\Services\BarangService;
use Illuminate\Http\Request;
use PDF;

class LaporanStokBarangController extends Controller
{
    public $service = null;
    //make construct method
    public function __construct(BarangService $barangService)
    {
        $this->service = $barangService;
    }

    private function getCollection($request)
    {
        $stokBarang = $request->has(['tanggal_mulai', 'tanggal_akhir']) 
        ? $this->service->getKartuStok($request['tanggal_mulai'], $request['tanggal_akhir']) 
        : collect(); // Pastikan collect jika kosong
        
        return $stokBarang;
    }

    function index(Request $request)
    {   
        
        $stokBarang = $this->getCollection($request);

        return view('laporan.stok-barang', [
            'stokBarang' => $stokBarang->groupBy(fn($item) => $item->jenis->nama), // Gunakan nama dari relasi
            'tanggal_mulai' => $request['tanggal_mulai'] ?? "",
            'tanggal_akhir' => $request['tanggal_akhir'] ?? "",
        ]);  
    }

    function printPDF(Request $request)
    {
        $stokBarang = $this->getCollection($request);

        $pdf = PDF::loadView('laporan.stok-barang-pdf', [
            'stokBarang' => $stokBarang->groupBy(fn($item) => $item->jenis->nama), // Gunakan nama dari relasi
            'tanggal_mulai' => $request['tanggal_mulai'] ?:"",
            'tanggal_akhir' => $request['tanggal_akhir'] ?:"",
        ]);

        return $pdf->download('Laporan_Stok_Barang' . now()->format('YmdHis') . '.pdf');
    }
}
