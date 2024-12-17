<?php

namespace App\Http\Controllers;

use App\Services\BarangKeluarService;
use Illuminate\Http\Request;
use PDF;

class LaporanBarangKeluarController extends Controller
{
    protected $service;

    public function __construct(BarangKeluarService $service) {
        $this->service = $service;
    }

    function index(Request $request)
    {   
        $barangKeluar = $request->has(['tanggal_mulai', 'tanggal_akhir']) ? $this->service->getBarangKeluarReport($request['tanggal_mulai'], $request['tanggal_akhir']) : [];
        
        return view('laporan.barang-keluar',[
            'barangKeluar' => $barangKeluar,
            'tanggal_mulai' => $request['tanggal_mulai'] ?:"",
            'tanggal_akhir' => $request['tanggal_akhir'] ?:"",
        ]); 
    }

    function printPDF(Request $request)
    {
        $barangKeluar = $request->has(['tanggal_mulai', 'tanggal_akhir']) ? $this->service->getBarangKeluarReport($request['tanggal_mulai'], $request['tanggal_akhir']) : [];
        
        $pdf = PDF::loadView('laporan.barang-keluar-pdf', [
            'barangKeluar' => $barangKeluar,
            'tanggal_mulai' => $request['tanggal_mulai'] ?:"",
            'tanggal_akhir' => $request['tanggal_akhir'] ?:"",
        ]);

        return $pdf->download('Laporan_barang_keluar' . now()->format('YmdHis') . '.pdf');
    }
}
