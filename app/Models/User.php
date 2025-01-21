<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class User extends Authenticatable implements MustVerifyEmail, HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Active Scope
     *
     * @param [type] $query
     * @return void
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * The kantorCabangs that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    // public function kantorCabangs(): BelongsToMany
    // {
    //     return $this->belongsToMany(KantorCabang::class, 'kantor_cabang_user', 'user_id', 'kantor_cabang_id')
    //                 ->withTimestamps(); 
    // }
    public function kantorCabangs()
    {
        return $this->belongsToMany(KantorCabang::class, 'jabatan_user', 'user_id', 'kantor_id')
            ->withPivot(['jabatan_id', 'status']);
    }

    /**
     * Register media collections.
     *
     * @return void
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('profile_image')
            ->singleFile(); // Hanya satu file untuk gambar profil
    }

    /**
     * Accessor untuk mendapatkan URL gambar profil.
     *
     * @return string
     */
    public function getImageAttribute()
    {
        // Cek apakah user memiliki media dengan collection 'image_profile'
        $media = $this->getFirstMediaUrl('profile_image', 'thumb');

        // Jika ada media, kembalikan URL-nya; jika tidak, kembalikan URL default
        return $media ?: url('/img/no_foto.png');
    }

    /**
     * Daftarkan konversi media.
     *
     * @param Media|null $media
     * @return void
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(100)
            ->height(100)
            ->sharpen(10);
    }

    /**
     * The jabatans that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function jabatans(): BelongsToMany
    {
        return $this->belongsToMany(Jabatan::class, 'jabatan_user', 'user_id', 'jabatan_id')
            ->withPivot(['status']);
    }

    public static function getUserAndAtasan($idUser, $idKantor)
    {
        // Ambil data jabatan user
        $jabatanUser = DB::table('jabatan_user')
            ->where('user_id', $idUser)
            ->where('kantor_id', $idKantor)
            ->first();

        if (!$jabatanUser) {
            return ['message' => 'Data jabatan user tidak ditemukan'];
        }

        // Ambil data jabatan user saat ini
        $jabatan = DB::table('jabatan')->where('id', $jabatanUser->jabatan_id)->first();

        if (!$jabatan) {
            return ['message' => 'Data jabatan tidak ditemukan'];
        }

        // Ambil data jabatan atasan langsung
        $atasanJabatans = DB::table('jabatan')->where('id', $jabatan->parent_id)->get();

        // Ambil data user dari jabatan atasan langsung
        $atasanUsers = $atasanJabatans->map(function ($atasanJabatan) use ($idKantor) {
            return DB::table('jabatan_user')
                ->where('jabatan_id', $atasanJabatan->id)
                ->where('kantor_id', $idKantor)
                ->get()
                ->map(function ($atasanUser) use ($atasanJabatan) {
                    return [
                        'id' => $atasanUser->user_id,
                        'name' => DB::table('users')->where('id', $atasanUser->user_id)->value('name'),
                        'position' => $atasanJabatan->nama_jabatan,
                    ];
                });
        })->flatten(1);

        // Ambil data jabatan atasan dari atasan langsung
        $atasanDariAtasanJabatans = $atasanJabatans->map(function ($atasanJabatan) {
            return DB::table('jabatan')->where('id', $atasanJabatan->parent_id)->get();
        })->flatten(1);

        // Ambil data user dari jabatan atasan dari atasan langsung
        $atasanDariAtasanUsers = $atasanDariAtasanJabatans->map(function ($atasanDariAtasanJabatan) use ($idKantor) {
            return DB::table('jabatan_user')
                ->where('jabatan_id', $atasanDariAtasanJabatan->id)
                ->where('kantor_id', $idKantor)
                ->get()
                ->map(function ($atasanDariAtasanUser) use ($atasanDariAtasanJabatan) {
                    return [
                        'id' => $atasanDariAtasanUser->user_id,
                        'name' => DB::table('users')->where('id', $atasanDariAtasanUser->user_id)->value('name'),
                        'position' => $atasanDariAtasanJabatan->nama_jabatan,
                    ];
                });
        })->flatten(1);

        return [
            'user' => [
                'id' => $idUser,
                'name' => DB::table('users')->where('id', $idUser)->value('name'),
                'position' => $jabatan->nama_jabatan,
            ],
            'atasan' => $atasanUsers->toArray(),
            'atasan_dari_atasan' => $atasanDariAtasanUsers->toArray(),
        ];
    }
}
