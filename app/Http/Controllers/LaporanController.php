<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    //make method barangMasuk
    public function barangMasuk(Request $request){
        //make query barang masuk
        $bulanMasuk = $request->bulan_masuk;
        

        return view('laporan.barang_masuk');
    }

    public function barangKeluar(){
        return view('laporan.barang_keluar');
    }
}
