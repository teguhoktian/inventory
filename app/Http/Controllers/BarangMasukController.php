<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\Supplier;
use App\Services\BarangMasukService;
use App\Traits\AutoGenerateCodeTrait;
use PDF;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    use AutoGenerateCodeTrait;

    protected $services;
    protected $kode;

    function __construct(BarangMasukService $services)
    {
        $this->services = $services;
        $this->kode = $this->generateCode(BarangMasuk::class, 'TBM');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // return $request;
        if ($request->has('mode') && $request->mode == 'barang') {
            if (request()->ajax()) return $this->services->getDTBarang();
            return view('barangmasuk.index-barang');
        } else {
            if (request()->ajax()) return $this->services->getDT();
            return view('barangmasuk.index-invoice');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cart_products = collect(request()->session()->get('cart'));
        return view(
            'barangmasuk.add',
            [
                'cart' => $cart_products,
                'cart_count' => count($cart_products)
            ]
        );
    }

    function addtocart(Request $request)
    {

        $validated = $request->validate(
            [
                'kode_barang' => ['required'],
                'quantity' => ['required', 'numeric'],
                'harga' => ['required', 'numeric'],
            ],
            ['kode_barang.required' => 'Barang harus dipilih.']
        );

        $product = Barang::where('kode', $validated['kode_barang'])->first();

        $cart = $request->session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $request->quantity;
            $cart[$product->id]['harga'] = $request->harga;
        } else {
            $cart[$product->id] = [
                "id_barang" => $product->id,
                "kode_barang" => $product->kode,
                "satuan" => $product->satuan?->nama,
                "jenis" => $product->jenis?->nama,
                "nama" => $product->nama,
                "quantity" => $request->quantity,
                "harga" => $request->harga,
            ];
        }

        $request->session()->put('cart', $cart);
        // return back();
        return response()->json([
            'success' => true,
            'message' => 'Barang berhasil ditambahkan ke keranjang!'
        ]);
    }

    function removecartitem($id)
    {
        $cart = request()->session()->get('cart');

        if (isset($cart[$id]))  unset($cart[$id]);

        request()->session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => 'Barang berhasil dihapus dari keranjang!'
        ]);
    }

    // BarangMasukController.php
    public function emptyCart()
    {
        // Logika untuk mengosongkan cart, misalnya dengan menghapus semua item dari session
        session()->forget('cart');  // Misalnya cart disimpan di session

        return response()->json([
            'success' => true,
            'message' => 'Cart berhasil dikosongkan.',
        ]);
    }

    public function checkout()
    {
        $cart_products = collect(request()->session()->get('cart'));

        if ($cart_products->isEmpty()) return redirect()->route('barang-masuk.create');

        $supplier = Supplier::pluck('nama', 'id');
        $barang = Barang::pluck('nama', 'id');
        return view(
            'barangmasuk.checkout',
            [
                'kode' => $this->kode,
                'supplier' => $supplier,
                'barang' => $barang,
                'cart' => $cart_products,
                'cart_count' => count($cart_products)
            ]
        );
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal_masuk' => ['required'],
            'id_supplier' => ['required'],
            'no_faktur' => ['required'],
        ], [
            'no_faktur.required' => 'Nomor Faktur wajib diisi',
            'id_supplier.required' => 'Supplier wajib diisi',
        ]);

        $request['kode'] = $this->kode;
        $data = $this->services->create($request);

        return response()->json([
            'status' => 'success',
            'message' => __('Data telah berhasil disimpan.'),
            'redirectTo' => route('barang-masuk.show', $data->id)
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BarangMasuk  $barangMasuk
     * @return \Illuminate\Http\Response
     */
    public function show(BarangMasuk $barangMasuk)
    {
        $barang = $barangMasuk->detail;
        return view(
            'barangmasuk.show',
            [
                'barangMasuk' => $barangMasuk,
                'cart' => $barangMasuk->detail
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BarangMasuk  $barangMasuk
     * @return \Illuminate\Http\Response
     */
    public function edit(BarangMasuk $barangMasuk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BarangMasuk  $barangMasuk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BarangMasuk $barangMasuk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BarangMasuk  $barangMasuk
     * @return \Illuminate\Http\Response
     */
    public function destroy(BarangMasuk $barangMasuk)
    {
        $this->services->destroy($barangMasuk);
        return response()->json([
            'status' => 'success',
            'message' => __('Data telah berhasil dihapus.')
        ], 200);
    }

    public function print(BarangMasuk $barangMasuk)
    {
        // Tampilan view HTML
        return view(
            'barangmasuk.print',
            [
                'barangMasuk' => $barangMasuk,
                'cart' => $barangMasuk->detail
            ]
        );

        // $pdf = PDF::loadView('barangmasuk.print', [
        //             'barangMasuk' => $barangMasuk,
        //             'cart' => $barangMasuk->detail
        // ]);

        // return $pdf->download($barangMasuk->kode . ' Invoice Barang Masuk.pdf');    
    }
}
