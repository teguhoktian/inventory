<?php

namespace App\Services;

use App\Models\KantorCabang;
use Yajra\DataTables\DataTables;

class KantorCabangService
{
    public function getDT()
    {
        return DataTables::of(KantorCabang::latest()->get())
            ->addColumn('action', 'kantorcabang.action')
            ->addIndexColumn()
            ->make(true);
    }

    public function destroy($collection)
    {
        $collection->delete();
    }

    public function create($request)
    {
        $collection = KantorCabang::create($request->only('parent_id', 'nama', 'kode'));
        return $collection;
    }

    public function update($request, $collection)
    {
        return $collection->update($request->all());
    }
}
