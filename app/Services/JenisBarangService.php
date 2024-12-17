<?php

namespace App\Services;

use App\Models\JenisBarang;
use Yajra\DataTables\DataTables;

class JenisBarangService
{
    public function getDT()
    {
        return DataTables::of(JenisBarang::latest()->get())
            ->addColumn('action', 'jenisbarang.action')
            ->addIndexColumn()
            ->make(true);
    }

    public function destroy($collection)
    {
        $collection->delete();
    }

    public function create($request)
    {
        $collection = JenisBarang::create($request->only('nama'));
        return $collection;
    }

    public function update($request, $collection)
    {
        return $collection->update($request->all());
    }
}
