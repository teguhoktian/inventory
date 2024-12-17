<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailStokOpnameBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stok_opname_barang_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_stok_opname')->nullable();
            $table->foreign('id_stok_opname')->references('id')->on('stok_opname_barang')->onDelete('cascade');

            $table->unsignedBigInteger('id_barang')->nullable();
            $table->foreign('id_barang')->references('id')->on('barang')->onDelete('cascade');

            $table->integer('stok_aplikasi')->unsigned()->nullable();
            $table->integer('stok_fisik')->unsigned()->nullable();
            $table->integer('selisih')->nullable();

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
        Schema::dropIfExists('stok_opname_barang_detail');
    }
}
