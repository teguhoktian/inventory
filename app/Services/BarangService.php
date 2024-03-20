<?php

namespace App\Services;

use App\Models\Barang;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class BarangService
{
    public function getDT()
    {
        return DataTables::of(Barang::withCount([
            'barangMasuk as harga_masuk' => function ($query) {
                $query->select(DB::raw('SUM(quantity * harga)'));
            },
            'barangKeluar as harga_keluar' => function ($query) {
                $query->select(DB::raw('SUM(quantity * harga)'));
            }
        ])
            ->latest()->get())
            ->addColumn('jenis_barang', function ($row) {
                return $row->jenis?->nama;
            })
            ->addColumn('posisi_kas', function ($row) {
                return number_format($row->harga_masuk - $row->harga_keluar, 2, '.', ',');
            })
            ->addColumn('satuan', function ($row) {
                return $row->satuan?->nama;
            })
            ->addColumn('action', 'barang.action')
            ->addIndexColumn()
            ->make(true);
    }

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
}
