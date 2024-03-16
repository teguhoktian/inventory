<?php

namespace App\Services;

use App\Models\Supplier;
use Yajra\DataTables\DataTables;

class SupplierService
{
    public function getDT()
    {
        return DataTables::of(Supplier::latest()->get())
            ->addColumn('action', 'supplier.action')
            ->addIndexColumn()
            ->make(true);
    }

    public function destroy($collection)
    {
        $collection->delete();
    }

    public function create($request)
    {
        $collection = Supplier::create($request->all());
        return $collection;
    }

    public function update($request, $collection)
    {
        return $collection->update($request->all());
    }
}
