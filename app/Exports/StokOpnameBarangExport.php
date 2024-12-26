<?php

namespace App\Exports;

use App\Models\StokOpnameBarang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StokOpnameBarangExport implements FromCollection, WithHeadings, WithMapping
{
    protected $stokOpnameId;
    private $startRow = 2;

    public function __construct($stokOpnameId)
    {
        $this->stokOpnameId = $stokOpnameId;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return StokOpnameBarang::with(['details.barang'])
            ->where('id', $this->stokOpnameId)
            ->get()
            ->flatMap(function ($stokOpname) {
                return $stokOpname->details;
            });
    }

    public function map($detail): array
    {
        $row = $this->startRow++;
        return [
            $detail->barang?->id,
            $detail->barang?->nama,
            $detail->stok_aplikasi ?? 0,
            $detail->stok_fisik ?? 0,
            // $selisihFormula, // Menambahkan rumus untuk kolom Selisih
            '=D'. $row . '-C' . $row,
            $detail->barang->jenis?->nama,
        ];
    }

    public function headings(): array
    {
        return [
            'Kode Barang',
            'Nama Barang',
            'Stok Aplikasi',
            'Stok Fisik',
            'Selisih',
            'Jenis Barang',
        ];
    }
}
