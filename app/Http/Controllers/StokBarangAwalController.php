<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\KartuStokBarang;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StokBarangAwalController extends Controller
{
    protected $cartName;

    public function __construct() {
        $this->cartName = 'stok_awal_cart';
    }

    //
    function create() 
    {
        $cart_products = collect(request()->session()->get($this->cartName));
        $barang = Barang::whereDoesntHave('stoks')->pluck('nama', 'id');
        return view(
            'stokawal.add',
            [
                'barang' => $barang,
                'cart' => $cart_products,
                'cart_count' => count($cart_products)
            ]
        );    
    }

    function addtocart(Request $request)
    {

        $request->validate(
            [
                'id_barang' => ['required'],
                'quantity' => ['required', 'numeric'],
                'harga' => ['required', 'numeric'],
            ],
            ['id_barang.required' => 'Barang harus dipilih.']
        );

        $product = Barang::findOrFail($request->id_barang);

        $cart = $request->session()->get($this->cartName, []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $request->quantity;
            $cart[$product->id]['harga'] = $request->harga;
        } else {
            $cart[$product->id] = [
                "id_barang" => $product->id,
                "satuan" => $product->satuan?->nama,
                "jenis" => $product->jenis?->nama,
                "nama" => $product->nama,
                "quantity" => $request->quantity,
                "harga" => $request->harga,
            ];
        }

        $request->session()->put($this->cartName, $cart);
        return back();
    }

    function removecartitem($id)
    {
        $cart = request()->session()->get($this->cartName);

        if (isset($cart[$id]))  unset($cart[$id]);

        request()->session()->put($this->cartName, $cart);

        return back();
    }

    public function store(Request $request)
    {
        //Simpan ke Stok Awal
        $cart_products = collect(request()->session()->get($this->cartName));
        //get now with carbon
        $now = Carbon::now();
        $keterangan = "SALDO AWAL";

        foreach ($cart_products as $key => $product) {
            
            $barang = Barang::find($product['id_barang']);
            $barang->stok += $product['quantity'];
            $barang->save();

            KartuStokBarang::create([
                'id_barang' => $product['id_barang'],
                'tanggal' => $now,
                'tipe' => "Masuk",
                'jumlah' => $product['quantity'],
                'harga' => $product['harga'],
                'sisa_stok' => $barang->stok,
                'keterangan' => strtoupper($keterangan)
            ]);
            
        }

        request()->session()->put($this->cartName, []);

        return response()->json([
            'status' => 'success',
            'message' => __('Data telah berhasil disimpan.')
        ], 200);
    }
}
