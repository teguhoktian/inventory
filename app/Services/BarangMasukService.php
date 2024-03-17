<?php

namespace App\Services;

use App\Models\BarangMasuk;
use App\Models\BarangMasukDetail;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class BarangMasukService
{
    public function getDT()
    {
        return DataTables::of(BarangMasuk::withCount('detail')
            ->with(['supplier'])->latest()->get())
            ->addColumn('supplier', function ($row) {
                return $row->supplier?->nama;
            })
            ->addColumn('action', 'barangmasuk.action')
            ->addIndexColumn()
            ->make(true);
    }

    public function destroy($collection)
    {
        $collection->detail()->get()->each->delete();
        $collection->delete();
    }

    public function create($request)
    {
        $collection = BarangMasuk::create($request->all());
        $this->addCart($collection);
        return $collection;
    }

    public function update($request, $collection)
    {
        return $collection->update($request->all());
    }

    function addCart($collection)
    {
        $cart_products = collect(request()->session()->get('cart'));
        foreach ($cart_products as $key => $product) {
            BarangMasukDetail::create([
                'id_barang_masuk' => $collection->id,
                'id_barang' => $product['id_barang'],
                'quantity' => $product['quantity'],
                'harga' => $product['harga']
            ]);
        }

        request()->session()->put('cart', []);
    }
}
