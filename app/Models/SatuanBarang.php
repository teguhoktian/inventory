<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SatuanBarang extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'satuan_barang';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nama'];

    /**
     * Set the Nama
     *
     * @param  string  $value
     * @return void
     */
    public function setNamaAttribute($value)
    {
        return $this->attributes['nama'] = strtolower($value);
    }
}
