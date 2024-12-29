<?php

namespace App\Services;

use App\Models\BarangMasuk;
use App\Models\BarangMasukDetail;
use Yajra\DataTables\DataTables;

class BarangMasukService
{
    public function getDT()
    {
        return DataTables::of(BarangMasuk::withCount('detail')
            ->with(['supplier', 'detail'])->latest()->get())
            ->addColumn('supplier', function ($row) {
                return $row->supplier?->nama;
            })
            ->addColumn('total_harga', function ($row) {
                
                $total = $row->detail->sum(function($data) {
                    return $data->quantity * $data->harga;
                });

                return number_format($total, 2);
            })
            ->addColumn('action', 'barangmasuk.action')
            ->addIndexColumn()
            ->make(true);
    }

    public function getDTBarang()
    {
        return DataTables::of(
            BarangMasukDetail::select(
                'barang_masuk_detail.*',
                'barang_masuk.kode as kode_invoice',
                'barang.kode as kode_barang',
                'barang.nama as nama_barang',
                'jenis_barang.nama as jenis_barang', // Jika ada relasi jenis_barang
                'barang_masuk.no_faktur',
                'barang_masuk.tanggal_masuk'
            )
            ->join('barang_masuk', 'barang_masuk_detail.id_barang_masuk', '=', 'barang_masuk.id')
            ->join('barang', 'barang_masuk_detail.id_barang', '=', 'barang.id')
            ->leftJoin('jenis_barang', 'barang.id_jenis', '=', 'jenis_barang.id')
            ->orderBy('barang_masuk.kode', 'DESC') // Jika ada jenis barang
        )
        ->addColumn('harga', function ($row) {
            return number_format($row->harga, 2);
        })
        ->addColumn('total_harga', function ($row) {
            return number_format($row->quantity * $row->harga, 2);
        })
        ->addColumn('action', 'barangmasuk.action')
        ->addIndexColumn()
        ->filterColumn('kode_invoice', function($query, $keyword) {
            $query->where('barang_masuk.kode', 'like', "%$keyword%");
        })
        ->filterColumn('nama_barang', function($query, $keyword) {
            $query->where('barang.nama', 'like', "%$keyword%");
        })
        ->filterColumn('no_faktur', function($query, $keyword) {
            $query->where('barang_masuk.no_faktur', 'like', "%$keyword%");
        })
        ->filterColumn('tanggal_masuk', function($query, $keyword) {
            $query->where('barang_masuk.tanggal_masuk', 'like', "%$keyword%");
        })
        ->rawColumns(['action'])
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

    function getBarangMasukReport($startDate, $endDate)
    {
        return BarangMasukDetail::join('barang_masuk', 'barang_masuk_detail.id_barang_masuk', '=', 'barang_masuk.id')
        ->whereBetween('barang_masuk.tanggal_masuk', [$startDate, $endDate])
        ->orderBy('barang_masuk.tanggal_masuk', 'asc') // Urutkan berdasarkan tanggal masuk
        ->get();
    }
}
