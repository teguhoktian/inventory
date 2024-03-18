<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Barang extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'barang';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get the satuan that owns the Barang
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function satuan(): BelongsTo
    {
        return $this->belongsTo(SatuanBarang::class, 'id_satuan');
    }

    /**
     * Get the jenis that owns the Barang
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jenis(): BelongsTo
    {
        return $this->belongsTo(JenisBarang::class, 'id_jenis');
    }

    /**
     * Get all of the barangMasuk for the Barang
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function barangMasuk(): HasMany
    {
        return $this->hasMany(BarangMasukDetail::class, 'id_barang');
    }

    /**
     * Get all of the barangKeluar for the Barang
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function barangKeluar(): HasMany
    {
        return $this->hasMany(BarangKeluarDetail::class, 'id_barang');
    }
}
