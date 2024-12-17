<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangKeluarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_keluar', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 35)->nullable();
            $table->date('tanggal_keluar')->nullable();
            $table->unsignedBigInteger('id_kantor')->nullable();
            $table->foreign('id_kantor')->references('id')->on('kantor_cabang')->onDelete('SET NULL');
            $table->string('pic', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang_keluar');
    }
}
