<?php

namespace App\Http\Controllers;

use App\Services\BarangMasukService;
use Illuminate\Http\Request;
use PDF;

class LaporanBarangMasukController extends Controller
{
    //
    protected $service;

    public function __construct(BarangMasukService $service)
    {
        $this->service = $service;
    }

    private function getCollection($request)
    {
        return $request->has(['tanggal_mulai', 'tanggal_akhir']) ? $this->service->getBarangMasukReport($request['tanggal_mulai'], $request['tanggal_akhir']) : [];
    }

    function index(Request $request)
    {
        $barangMasuk = $this->getCollection($request);

        return view('laporan.barang-masuk', [
            'barangMasuk' => $barangMasuk,
            'tanggal_mulai' => $request['tanggal_mulai'] ?: "",
            'tanggal_akhir' => $request['tanggal_akhir'] ?: "",
        ]);
    }

    function printPDF(Request $request)
    {
        $barangMasuk = $this->getCollection($request);
        $userId = $request->user()->id;
        $kantorId = $request->user()->kantorCabangs->first()->id;

        $pdf = PDF::loadView('laporan.barang-masuk-pdf', [
            'barangMasuk' => $barangMasuk,
            'tanggal_mulai' => $request['tanggal_mulai'] ?: "",
            'tanggal_akhir' => $request['tanggal_akhir'] ?: "",
            'signer' => \App\Models\User::getUserAndAtasan($userId, $kantorId),
        ]);

        return $pdf->download('Laporan_barang_masuk' . now()->format('YmdHis') . '.pdf');
    }
}
