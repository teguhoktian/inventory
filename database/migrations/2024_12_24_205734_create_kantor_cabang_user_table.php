<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKantorCabangUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kantor_cabang_user', function (Blueprint $table) {
            $table->id(); // Optional, jika tidak perlu bisa dihapus.
            $table->foreignId('kantor_cabang_id')->constrained('kantor_cabang')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps(); // Optional, jika perlu mencatat waktu relasi dibuat.
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kantor_cabang_user');
    }
}
