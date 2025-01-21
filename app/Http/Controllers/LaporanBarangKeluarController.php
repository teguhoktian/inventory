<?php

namespace App\Http\Controllers;

use App\Services\BarangKeluarService;
use Illuminate\Http\Request;
use PDF;

class LaporanBarangKeluarController extends Controller
{
    protected $service;

    public function __construct(BarangKeluarService $service)
    {
        $this->service = $service;
    }

    private function getCollection($request)
    {
        $barangKeluar = $request->has(['tanggal_mulai', 'tanggal_akhir'])
            ? $this->service->getBarangKeluarReport($request['tanggal_mulai'], $request['tanggal_akhir'])
            : collect();

        $groupedBarangKeluar = $barangKeluar->groupBy([
            fn($item) => $item->barangKeluar->kantor->nama ?? 'Tidak Diketahui',
            fn($item) => $item->barang->jenis->nama ?? 'Tidak Diketahui',
        ]);

        return $groupedBarangKeluar;
    }

    function index(Request $request)
    {
        $barangKeluar = $this->getCollection($request);

        return view('laporan.barang-keluar', [
            'barangKeluar' => $barangKeluar,
            'tanggal_mulai' => $request['tanggal_mulai'] ?: "",
            'tanggal_akhir' => $request['tanggal_akhir'] ?: "",
        ]);
    }

    function printPDF(Request $request)
    {
        // return \App\Models\User::getUserAndAtasan(26, 10);
        $barangKeluar = $this->getCollection($request);

        $pdf = PDF::loadView('laporan.barang-keluar-pdf', [
            'barangKeluar' => $barangKeluar,
            'tanggal_mulai' => $request['tanggal_mulai'] ?: "",
            'tanggal_akhir' => $request['tanggal_akhir'] ?: "",
            'signer' => \App\Models\User::getUserAndAtasan(26, 10),
        ]);

        return $pdf->download('Laporan_barang_keluar' . now()->format('YmdHis') . '.pdf');
    }
}
