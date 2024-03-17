<?php

namespace App\Services;

use App\Models\Barang;
use Yajra\DataTables\DataTables;

class BarangService
{
    public function getDT()
    {
        return DataTables::of(Barang::with(['satuan', 'jenis'])->latest()->get())
            ->addColumn('jenis_barang', function ($row) {
                return $row->jenis?->nama;
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
