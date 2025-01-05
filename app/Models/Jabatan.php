<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Jabatan extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'jabatan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nama_jabatan', 'parent_id', 'deskripsi'];

    /**
     * Get the parent that owns the Jabatan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Jabatan::class, 'parent_id');
    }

    /**
     * Get all of the children for the Jabatan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(Jabatan::class, 'parent_id');
    }

    public static function getAllJabatan(){
        return DB::select("
            WITH RECURSIVE jabatan_hierarchy AS (
                SELECT 
                    j.id, 
                    j.nama_jabatan, 
                    j.deskripsi, 
                    j.parent_id, 
                    1 AS level
                FROM jabatan j
                WHERE j.parent_id IS NULL
                
                UNION ALL
                
                SELECT 
                    j.id, 
                    j.nama_jabatan, 
                    j.deskripsi, 
                    j.parent_id, 
                    h.level + 1
                FROM jabatan j
                JOIN jabatan_hierarchy h ON j.parent_id = h.id
            )
            SELECT 
                jh.*, 
                jp.nama_jabatan AS parent_name -- Ambil nama jabatan parent
            FROM jabatan_hierarchy jh
            LEFT JOIN jabatan jp ON jh.parent_id = jp.id -- Join ke tabel jabatan untuk mendapatkan nama parent
            ORDER BY jh.level, jh.nama_jabatan");
    }

    public static function getUserByKantor($kantorId)
    {
        return DB::select("
            WITH RECURSIVE jabatan_hierarchy AS (
                SELECT id, nama_jabatan, parent_id, 1 AS level
                FROM jabatan
                WHERE parent_id IS NULL
                UNION ALL
                SELECT j.id, j.nama_jabatan, j.parent_id, h.level + 1
                FROM jabatan j
                JOIN jabatan_hierarchy h ON j.parent_id = h.id
            )
            SELECT jh.*, ju.user_id, ju.status, u.name
            FROM jabatan_hierarchy jh
            JOIN jabatan_user ju ON ju.jabatan_id = jh.id
            JOIN users u ON u.id = ju.user_id
            WHERE ju.kantor_id = ?
            ORDER BY jh.level, FIELD(ju.status, 'Definitif', 'Pj.', 'Plt.')
        ", [$kantorId]);    
    }
}
