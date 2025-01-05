<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Jabatan::create(['nama_jabatan' => 'Pemimpin Cabang', 'parent_id' => null, 'deskripsi' => 'Pemimpin Cabang']);
        \App\Models\Jabatan::create(['nama_jabatan' => 'Manager Operasional', 'parent_id' => 1, 'deskripsi' => 'Manager Operasional']);
        \App\Models\Jabatan::create(['nama_jabatan' => 'Officer Dana dan Jasa', 'parent_id' => 2, 'deskripsi' => 'Officer Dana dan Jasa']);
        \App\Models\Jabatan::create(['nama_jabatan' => 'Customer Service', 'parent_id' => 3, 'deskripsi' => 'Customer Services Cabang']);
    }
}
