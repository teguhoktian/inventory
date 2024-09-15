<?php

namespace App\Services;

use App\Models\BarangKeluar;
use App\Models\BarangKeluarDetail;
use Yajra\DataTables\DataTables;

class BarangKeluarService
{
    public function getDT()
    {
        return DataTables::of(BarangKeluar::withCount('detail')->with(['kantor'])->latest()->get())
            ->addColumn('kantor', function ($row) {
                return $row->kantor?->nama;
            })
            ->addColumn('total_harga', function ($row) {
                
                $total = $row->detail->sum(function($data) {
                    return $data->quantity * $data->harga;
                });

                return number_format($total, 2);
            })
            ->addColumn('action', 'barangkeluar.action')
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
        $collection = BarangKeluar::create($request->all());
        $this->addCart($collection);
        return $collection;
    }

    public function update($request, $collection)
    {
        return $collection->update($request->all());
    }

    function addCart($collection)
    {
        $cart_products = collect(request()->session()->get('cart_out'));
        foreach ($cart_products as $key => $product) {
            BarangKeluarDetail::create([
                'id_barang_keluar' => $collection->id,
                'id_barang' => $product['id_barang'],
                'quantity' => $product['quantity'],
                'harga' => $product['harga']
            ]);
        }

        request()->session()->put('cart_out', []);
    }
}
