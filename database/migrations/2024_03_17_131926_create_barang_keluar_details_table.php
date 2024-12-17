<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangKeluarDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_keluar_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_barang')->nullable();
            $table->foreign('id_barang')->references('id')->on('barang')->onDelete('cascade');

            $table->unsignedBigInteger('id_barang_keluar')->nullable();
            $table->foreign('id_barang_keluar')->references('id')->on('barang_keluar')->onDelete('cascade');

            $table->integer('quantity')->unsigned()->nullable();
            $table->bigInteger('harga')->unsigned()->nullable();
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
        Schema::dropIfExists('barang_keluar_detail');
    }
}
