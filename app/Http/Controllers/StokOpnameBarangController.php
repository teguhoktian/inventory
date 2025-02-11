<?php

namespace App\Http\Controllers;

use App\DataTables\StokOpnameBarangDataTable;
use App\Exports\StokOpnameBarangExport;
use App\Http\Requests\StokOpnameBarangRequest;
use App\Imports\StokOpnameBarangImport;
use App\Models\DetailStokOpnameBarang;
use App\Models\StokOpnameBarang;
// use App\Services\BarangService;
use App\Traits\AutoGenerateCodeTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class StokOpnameBarangController extends Controller
{
    use AutoGenerateCodeTrait;

    private $listBarang = null;
    protected $kode;

    //make construct
    public function __construct()
    {
        $this->listBarang = \App\Models\Barang::get();
        $this->kode = $this->generateCode(StokOpnameBarang::class, 'TSO-');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(StokOpnameBarangDataTable $dataTable)
    {
        return $dataTable->render('stokOpnameBarang.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $cekStatus = StokOpnameBarang::where('status', 'Open')->first();
        if($cekStatus) return redirect()->route('stok-opname-barang.edit', [$cekStatus->id]);

        return view('stokOpnameBarang.add',[
            'listBarang' => $this->listBarang
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StokOpnameBarangRequest $request)
    {
        $request['kode'] = $this->kode;
        $stokOpnameBarang = StokOpnameBarang::create([...$request->all(), 'user_id' => Auth::id()]);
        
        if($stokOpnameBarang){
            
            $this->insertDetailStokOpnameBarang($stokOpnameBarang);

            return response()->json([
                'status' => 'success',
                'redirectTo' => route('stok-opname-barang.edit', [$stokOpnameBarang->id]),
                'message' => __('Data telah berhasil disimpan.')
            ], 200);
        }
    }

    function insertDetailStokOpnameBarang($stokOpnameBarang)
    {
        foreach($this->listBarang as $key => $barang)
        {
            DetailStokOpnameBarang::create([
                'id_stok_opname' => $stokOpnameBarang->id,
                'id_barang' => $barang->id,
                'stok_aplikasi' => $barang->stok,
                'stok_fisik' => null,
                'selisih' => null,
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StokOpnameBarang  $stokOpnameBarang
     * @return \Illuminate\Http\Response
     */
    public function show(StokOpnameBarang $stokOpnameBarang)
    {
        $stokOpnameBarang = StokOpnameBarang::with('details.barang.jenis')->find($stokOpnameBarang->id);

        // Kelompokkan berdasarkan jenis barang
        $groupedByJenis = $stokOpnameBarang->details->groupBy(function ($detail) {
            return $detail->barang->jenis->nama;  // Pastikan relasi jenis barang sudah benar
        });

        return view('stokOpnameBarang.show', [
            'stokOpnameBarang' => $stokOpnameBarang,
            'groupedByJenis' => $groupedByJenis
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StokOpnameBarang  $stokOpnameBarang
     * @return \Illuminate\Http\Response
     */
    public function edit(StokOpnameBarang $stokOpnameBarang)
    {
        if($stokOpnameBarang->status !== 'Open') abort('404');
        $stokOpnameBarang->petugas = $stokOpnameBarang->user?->name;
        return view('stokOpnameBarang.edit',[
            'stokOpnameBarang' => $stokOpnameBarang,
            'listBarang' => $stokOpnameBarang->details
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StokOpnameBarang  $stokOpnameBarang
     * @return \Illuminate\Http\Response
     */
    public function update(StokOpnameBarangRequest $request, StokOpnameBarang $stokOpnameBarang)
    {   
        if($stokOpnameBarang->status !== "Open") abort('403', __('Aksi tidak bisa dilakukan untuk status Stok Opname ini.'));
    
        $stokOpnameBarang->status = 'Selesai';
        $stokOpnameBarang->update($request->all());

        return response()->json([
            'status' => 'success',
            'redirectTo' => route('stok-opname-barang.show', $stokOpnameBarang->id),
            'message' => __('Data telah berhasil disimpan.')
        ], 200);
    }

    public function batalSOBarang(Request $request, StokOpnameBarang $stokOpnameBarang)
    {   
        // return $stokOpnameBarang;
        if($stokOpnameBarang->status !== "Open") abort('403', __('Aksi tidak bisa dilakukan untuk status Stok Opname ini.'));
        $stokOpnameBarang->status = 'Batal';
        $stokOpnameBarang->update($request->all());

        return redirect()->route('stok-opname-barang.index');
    }

    function updateStokFisik(DetailStokOpnameBarang $detailStokOpnameBarang, Request $request)
    {
        $detailStokOpnameBarang->stok_fisik = $request->stok_fisik;
        $detailStokOpnameBarang->selisih = $request->stok_fisik - $detailStokOpnameBarang->stok_aplikasi;
        $detailStokOpnameBarang->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StokOpnameBarang  $stokOpnameBarang
     * @return \Illuminate\Http\Response
     */
    public function destroy(StokOpnameBarang $stokOpnameBarang)
    {
        //
    }

    public function printKartuStokOpname(StokOpnameBarang $stokOpnameBarang)
    {

        // $pdf = PDF::loadView('stokOpnameBarang.print', [
        //     'stokOpnameBarang' => $stokOpnameBarang,
        //     'listBarang' => $stokOpnameBarang->details
        // ]);

        $stokOpnameBarang = StokOpnameBarang::with('details.barang.jenis')->find($stokOpnameBarang->id);

        // Kelompokkan berdasarkan jenis barang
        $groupedByJenis = $stokOpnameBarang->details->groupBy(function ($detail) {
            return $detail->barang->jenis->nama;  // Pastikan relasi jenis barang sudah benar
        });

        $pdf = PDF::loadView('stokOpnameBarang.print', [
            'stokOpnameBarang' => $stokOpnameBarang,
            'groupedByJenis' => $groupedByJenis
        ]);

        return $pdf->download('SO-CARD_' . now()->format('YmdHis') . '.pdf');
    }

    public function downloadBarangStokOpname(StokOpnameBarang $stokOpnameBarang) 
    {
        return Excel::download(new StokOpnameBarangExport($stokOpnameBarang->id), 'so_barang.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }

    public function uploadBarangStokOpname(Request $request, StokOpnameBarang $stokOpnameBarang) 
    {
        $request->validate([
            'file_upload' => 'required|mimes:xlsx,xls,csv|max:10240', // Batasi ukuran file jika diperlukan
        ]);

        // Proses file Excel
        try {
            $path = $request->file('file_upload')->store('uploads');
            // return $path;
            Excel::import(new StokOpnameBarangImport($stokOpnameBarang->id), storage_path("app/{$path}"));
            
            return redirect()->back()->with('success', 'Data berhasil diupload dan diperbarui.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengupload file: ' . $e->getMessage());
        }
    }
}
