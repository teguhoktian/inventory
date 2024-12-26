<?php

namespace App\Imports;

use App\Models\DetailStokOpnameBarang;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StokOpnameBarangImport implements ToModel, WithHeadingRow
{
    protected $stokOpnameId;

    // Konstruktor untuk menyimpan ID stok opname
    public function __construct($stokOpnameId)
    {
        $this->stokOpnameId = $stokOpnameId;
    }

    /**
     * Proses setiap baris data dari Excel
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // dd($row);
        // Temukan detail berdasarkan kode barang dan stok opname ID
        $detail = DetailStokOpnameBarang::where('id_stok_opname', $this->stokOpnameId)
            ->where('id_barang', $row['kode_barang'])  // Gantilah dengan nama kolom yang sesuai
            ->first();
            
        // Jika detail ditemukan, update stok fisik dan selisih
        if ($detail) {
            $stokFisik = $row['stok_fisik'] ?? 0;
            $detail->update([
                'stok_fisik' => (int) $stokFisik,
                'selisih' => (int) $stokFisik - (int) $detail->stok_aplikasi,  // Perbarui selisih
            ]);
        }


        return $detail;
    }
}
