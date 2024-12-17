<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKartuStokBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kartu_stok_barang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_barang')->nullable();
            $table->foreign('id_barang')->references('id')->on('barang')->onDelete('cascade');

            $table->date('tanggal')->nullable();
            $table->enum('tipe', ['Masuk', 'Keluar'])->nullable();
            $table->integer('jumlah')->nullable();
            $table->bigInteger('harga')->nullable();
            $table->integer('sisa_stok')->unsigned()->nullable();
            $table->text('keterangan')->nullable();

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
        Schema::dropIfExists('kartu_stok_barang');
    }
}
