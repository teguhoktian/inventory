<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Services\BarangKeluarService;
use App\Traits\AutoGenerateCodeTrait;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class BarangKeluarController extends Controller
{
    use AutoGenerateCodeTrait;

    protected $services;
    protected $kode;

    function __construct(BarangKeluarService $services)
    {
        $this->services = $services;
        $this->kode = $this->generateCode(BarangKeluar::class, 'TBK-');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) return $this->services->getDT();
        return view('barangkeluar.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cart_products = collect(request()->session()->get('cart_out'));
        $barang = \App\Models\Barang::where('stok', '>', 0)->pluck('nama', 'id');
        $kantor = \App\Models\KantorCabang::pluck('nama', 'id');
        return view(
            'barangkeluar.add',
            [
                'kode' => $this->kode,
                'barang' => $barang,
                'kantor' => $kantor,
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

        $product = \App\Models\Barang::findOrFail($request->id_barang);

        $cart = $request->session()->get('cart_out', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $request->quantity;
            $cart[$product->id]['harga'] = $request->harga;
        } else {
            $cart[$product->id] = [
                "id_barang" => $product->id,
                "satuan" => $product->satuan?->nama,
                "nama" => $product->nama,
                "quantity" => $request->quantity,
                "harga" => $request->harga,
            ];
        }

        // Cek Apakah Stok tersedia
        if (($product->stok) <= ($cart[$product->id]['quantity'])) {
            throw ValidationException::withMessages(['quantity' => 'Pesanan Melebihi Stok']);
        } else {

            $request->session()->put('cart_out', $cart);
            return back();
        }
    }

    function removecartitem($id)
    {
        $cart = request()->session()->get('cart_out');

        if (isset($cart[$id]))  unset($cart[$id]);

        request()->session()->put('cart_out', $cart);

        return back();
    }

    function getLastPrice($id)
    {
        // if (!request()->ajax()) abort('404');

        $detailBarang = \App\Models\BarangMasukDetail::where('id_barang', $id)->latest()->first();

        return $detailBarang;
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
            'tanggal_keluar' => ['required'],
            'pic' => ['required'],
            'id_kantor' => ['required'],
        ], [
            'pic.required' => 'Nama PIC wajib diisi',
            'id_kantor.required' => 'Kantor wajib diisi',
        ]);

        $request['kode'] = $this->kode;
        $this->services->create($request);

        return response()->json([
            'status' => 'success',
            'message' => __('Data telah berhasil disimpan.')
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BarangKeluar  $barangKeluar
     * @return \Illuminate\Http\Response
     */
    public function show(BarangKeluar $barangKeluar)
    {
        $barang = $barangKeluar->detail;
        return view(
            'barangkeluar.show',
            [
                'barangKeluar' => $barangKeluar,
                'cart' => $barangKeluar->detail
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BarangKeluar  $barangKeluar
     * @return \Illuminate\Http\Response
     */
    public function edit(BarangKeluar $barangKeluar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BarangKeluar  $barangKeluar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BarangKeluar $barangKeluar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BarangKeluar  $barangKeluar
     * @return \Illuminate\Http\Response
     */
    public function destroy(BarangKeluar $barangKeluar)
    {
        $this->services->destroy($barangKeluar);
        return response()->json([
            'status' => 'success',
            'message' => __('Data telah berhasil dihapus.')
        ], 200);
    }
}