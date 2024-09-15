<?php

namespace App\Services;

use App\Models\KartuStokBarang;

class KartuStokBarangService
{
    public function __construct()
    {
        //
    }

    function barangMasukStok($barangMasukDetail, $posisi = 'Masuk', $koreksi = false) 
    {
        $keterangan = $koreksi ? "Koreksi Stok " : $posisi . " Stok ";
        $keterangan .= 'Invoice ' . $barangMasukDetail->barangMasuk->kode;

        return KartuStokBarang::create([
            'id_barang' => $barangMasukDetail->barang->id,
            'tanggal' => $barangMasukDetail->barangMasuk->tanggal_masuk,
            'tipe' => $posisi,
            'jumlah' => $barangMasukDetail->quantity,
            'harga' => $barangMasukDetail->harga,
            'sisa_stok' => $barangMasukDetail->barang->stok,
            'keterangan' => strtoupper($keterangan)
        ]);
    }
}
