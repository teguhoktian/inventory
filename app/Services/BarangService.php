<?php

namespace App\Services;

use App\Models\Barang;
use Illuminate\Support\Facades\DB;
// use Yajra\DataTables\DataTables;

class BarangService
{
    // public function getDT()
    // {
    //     return DataTables::of(Barang::withCount([
    //         'stoks as saldo_masuk' => function ($query) {
    //             $query->select(DB::raw('SUM(jumlah * harga)'))->where('tipe', 'Masuk');
    //         },
    //         'stoks as saldo_keluar' => function ($query) {
    //             $query->select(DB::raw('SUM(jumlah * harga)'))->where('tipe', 'Keluar');
    //         }
    //     ])
    //         ->latest()->get())
    //         ->addColumn('jenis_barang', function ($row) {
    //             return $row->jenis?->nama;
    //         })
    //         ->addColumn('harga_akhir', function ($row) {
    //             $lastStok = $row->stoks->last();
    //             return number_format($lastStok?->harga ?? 0, 0);
    //         })
    //         ->addColumn('posisi_kas', function ($row) {
    //             return number_format($row->saldo_masuk - $row->saldo_keluar, 0);
    //         })
    //         ->addColumn('satuan', function ($row) {
    //             return $row->satuan?->nama;
    //         })
    //         // ->addColumn('action', 'barang.action')
    //         ->addColumn('action', function ($row) {
    //             return view('barang.action', [
    //                 'id' => $row->id,
    //                 'hasLastStok' => $row->stoks->last() !== null
    //             ]);
    //         })
    //         ->addIndexColumn()
    //         ->make(true);
    // }

    public function destroy($collection)
    {
        $collection->delete();
    }

    public function create($request)
    {
        $collection = Barang::create($request->all());
        return $collection;
    }

    public function update($request, $collection)
    {
        return $collection->update($request->all());
    }

    public function getKartuStok($startDate, $endDate)
    {
        $barang = Barang::with('jenis')
        ->withCount([
            'stoks as stok_awal' => function ($query) use ($startDate) {
                $query->select(DB::raw('COALESCE(SUM(CASE WHEN tipe = "Masuk" THEN jumlah ELSE -jumlah END), 0)'))
                    ->where('tanggal', '<', $startDate);
            },
            'stoks as stok_masuk' => function ($query) use ($startDate, $endDate) {
                $query->select(DB::raw('COALESCE(SUM(jumlah), 0)'))
                    ->where('tipe', 'Masuk')
                    ->whereBetween('tanggal', [$startDate, $endDate]);
            },
            'stoks as stok_keluar' => function ($query) use ($startDate, $endDate) {
                $query->select(DB::raw('COALESCE(SUM(jumlah), 0)'))
                    ->where('tipe', 'Keluar')
                    ->whereBetween('tanggal', [$startDate, $endDate]);
            },
        ])
        ->latest()
        ->get();     
        
        return $barang;
    }
}
