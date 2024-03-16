<?php

namespace App\Services;

use App\Models\SatuanBarang;
use Yajra\DataTables\DataTables;

class SatuanBarangService
{
    public function getDT()
    {
        return DataTables::of(SatuanBarang::latest()->get())
            ->addColumn('action', 'satuanbarang.action')
            ->addIndexColumn()
            ->make(true);
    }

    public function destroy($collection)
    {
        $collection->delete();
    }

    public function create($request)
    {
        $collection = SatuanBarang::create($request->only('nama'));
        return $collection;
    }

    public function update($request, $collection)
    {
        return $collection->update($request->all());
    }
}
