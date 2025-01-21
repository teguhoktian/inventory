<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('jabatan_user', function (Blueprint $table) {
            // Tambahkan kolom is_active
            $table->boolean('is_active')
                ->default(true) // Default-nya true (aktif)
                ->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jabatan_user', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });
    }
};
