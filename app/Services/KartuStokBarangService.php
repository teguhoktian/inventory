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

    function barangKeluarStok($barangKeluarDetail, $posisi = 'Keluar', $koreksi = false) 
    {
        $keterangan = $koreksi ? "Koreksi Stok " : $posisi . " Stok ";
        $keterangan .= 'Invoice ' . $barangKeluarDetail->barangKeluar->kode;

        return KartuStokBarang::create([
            'id_barang' => $barangKeluarDetail->barang->id,
            'tanggal' => $barangKeluarDetail->barangKeluar->tanggal_keluar,
            'tipe' => $posisi,
            'jumlah' => $barangKeluarDetail->quantity,
            'harga' => $barangKeluarDetail->harga,
            'sisa_stok' => $barangKeluarDetail->barang->stok,
            'keterangan' => strtoupper($keterangan)
        ]);
    }
}
