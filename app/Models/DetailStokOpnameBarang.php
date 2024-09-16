<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailStokOpnameBarang extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'stok_opname_barang_detail';

    /**
     * Get the stokOpname that owns the DetailStokOpnameBarang
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function stokOpname(): BelongsTo
    {
        return $this->belongsTo(StokOpnameBarang::class, 'id_stok_opname');
    }

    /**
     * Get the barang that owns the DetailStokOpnameBarang
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }
}
