<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasukDetail;
use App\Models\JenisBarang;
use App\Models\KartuStokBarang;
use App\Models\SatuanBarang;
use App\Services\BarangService;
use App\Traits\AutoGenerateCodeTrait;
use Illuminate\Http\Request;

class BarangController extends Controller
{

    use AutoGenerateCodeTrait;

    protected $services;
    protected $kode;

    function __construct(BarangService $services)
    {
        $this->services = $services;
        $this->kode = $this->generateCode(Barang::class, 'BRG-');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) return $this->services->getDT();

        return view('barang.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jenisBarang = JenisBarang::pluck('nama', 'id');
        $satuanBarang = SatuanBarang::pluck('nama', 'id');
        return view(
            'barang.add',
            [
                'kode' => $this->kode,
                'jenisBarang' => $jenisBarang,
                'satuanBarang' => $satuanBarang
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
        $request['kode'] = $this->kode;

        $request->validate(
            [
                'nama' => 'required|min:3',
                'id_jenis' => 'required',
                'id_satuan' => 'required',
            ],
            [
                'id_jenis.required' => __('Jenis Barang'),
                'id_satuan.required' => __('Satuan Barang'),
            ]
        );

        $this->services->create($request);

        return response()->json([
            'status' => 'success',
            'message' => __('Data telah berhasil disimpan.')
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(Barang $barang)
    {

        // $timeLineBarang = $barang->barangMasuk->merge($barang->barangKeluar)->sortBy('created_at'); 

        $timeLineBarang = KartuStokBarang::where('id_barang', $barang->id)->orderBy('tanggal', 'ASC')->get();
        
        // dd($timeLineBarang->toArray());

        return view(
            'barang.show',
            [
                'barang' => $barang,
                'timeLineBarang' => $timeLineBarang,
                'sisaSaldo' => 0,
                // 'sisaStok' => 0,
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit(Barang $barang)
    {
        $jenisBarang = JenisBarang::pluck('nama', 'id');
        $satuanBarang = SatuanBarang::pluck('nama', 'id');

        return view('barang.edit', [
            'barang' => $barang,
            'kode' => $barang->kode,
            'jenisBarang' => $jenisBarang,
            'satuanBarang' => $satuanBarang
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Barang $barang)
    {
        $request['kode'] = $barang->kode;

        $request->validate(
            [
                'nama' => 'required|min:3',
                'id_jenis' => 'required',
                'id_satuan' => 'required',
            ],
            [
                'id_jenis.required' => __('Jenis Barang'),
                'id_satuan.required' => __('Satuan Barang'),
            ]
        );

        $this->services->update($request, $barang);

        return response()->json([
            'status' => 'success',
            'message' => __('Data telah berhasil diupdate.')
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barang $barang)
    {
        $this->services->destroy($barang);

        return response()->json([
            'status' => 'success',
            'message' => __('Data telah berhasil dihapus.')
        ], 200);
    }

    function adjustmentStok(Barang $barang)
    {
        return view('barang.adjust', [
            'barang' => $barang,
        ]);
    }

    function adjustmentStokStore(Request $request, Barang $barang) 
    {
        $request->validate([
            'keterangan' => 'required',
            'tipe_penyesuaian' =>'required',
            'stok_penyesuaian' => 'required'
        ]);

        $stok_penyesuaian = ($request->tipe_penyesuaian === 'Masuk') ? $request->stok_penyesuaian : -$request->stok_penyesuaian;

        //Update Stok barang
        $barang->stok += $stok_penyesuaian;
        $barang->save();

        $detailBarang = \App\Models\BarangMasukDetail::where('id_barang', $barang->id)->latest()->first();


        //Masukkan ke Kartu Stok
        KartuStokBarang::create([
            'id_barang' => $barang->id,
            'tanggal' => now(),
            'tipe' => $request->tipe_penyesuaian,
            'jumlah' => $request->stok_penyesuaian,
            'harga' => $detailBarang->harga,
            'sisa_stok' => $barang->stok,
            'keterangan' => strtoupper($request->keterangan)
        ]);

        return response()->json([
            'status' => 'success',
            'redirectTo' => route('barang.show', $barang->id),
            'message' => __('Data telah berhasil dihapus.')
        ], 200);
        
    }
}
