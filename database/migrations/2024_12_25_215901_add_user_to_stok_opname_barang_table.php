<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserToStokOpnameBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stok_opname_barang', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('user_id')->nullable()->after('id'); // Menambahkan kolom user_id
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null'); // Menambahkan foreign key
     
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stok_opname_barang', function (Blueprint $table) {
            //
            $table->dropForeign(['user_id']); // Menghapus foreign key
            $table->dropColumn('user_id'); // Menghapus kolom user_id
        });
    }
}
