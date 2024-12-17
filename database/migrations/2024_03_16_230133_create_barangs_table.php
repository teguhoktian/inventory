<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_jenis')->nullable();
            $table->unsignedBigInteger('id_satuan')->nullable();
            $table->foreign('id_jenis')->references('id')->on('jenis_barang')->onDelete('SET NULL');
            $table->foreign('id_satuan')->references('id')->on('satuan_barang')->onDelete('SET NULL');
            $table->string('nama', 100)->nullable();
            $table->string('kode', 20)->nullable();
            $table->bigInteger('stok')->default(0);
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
        Schema::dropIfExists('barang');
    }
}
