<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_temp_lable_harga', function (Blueprint $table) {
            $table->string('barcode_produk',100)->primary();
            $table->string('nama_produk')->nullable();
            $table->double('harga_jual_produk',10,0);
            $table->string('fkid_jenis_produk');
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
        Schema::dropIfExists('tbl_temp_lable_harga');
    }
};
