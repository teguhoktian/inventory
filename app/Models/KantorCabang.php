<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KantorCabang extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kantor_cabang';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['parent_id', 'kode', 'nama'];


    /**
     * Get the parent that owns the KantorCabang
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(KantorCabang::class, 'parent_id');
    }

    /**
     * Get all of the children for the KantorCabang
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(KantorCabang::class, 'parent_id');
    }

    /**
     * buildKategoriTree
     *
     * @param [type] $categories
     * @param [type] $parentId
     * @param string $prefix
     * @return void
     */
    public static function buildKategoriTree($categories = null, $parentId = null, $prefix = '')
    {
        $categories = $categories ?: self::all(); // Ambil semua kategori jika belum ada
        $tree = [];

        foreach ($categories as $category) {
            if ($category->parent_id == $parentId) {
                // Tambahkan prefix ke nama, dan simpan id serta kode
                $tree[] = [
                    'id' => $category->id,
                    'kode' => $category->kode,
                    'nama' => $prefix . $category->nama,
                ];

                // Rekursif untuk children
                $tree = array_merge($tree, self::buildKategoriTree($categories, $category->id, $prefix . ' --- '));
            }
        }

        return $tree;
    }

    /**
     * Interact with the getParentTextAttribute attribute.
     *
     * return void
     */
    public function getParentTextAttribute()
    {
        return $this->parent ? $this->parent->kode . " - " . $this->parent->nama : null;
    }

    /**
     * The jabatans that belong to the KantorCabang
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function jabatans(): BelongsToMany
    {
        return $this->belongsToMany(Jabatan::class, 'jabatan_user', 'kantor_id', 'jabatan_id')
            ->withTimestamps()
            ->withPivot(['status']);
    }
}
