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
        Schema::create('tbl_produk', function (Blueprint $table) {
            // $table->id('id_produk');
            $table->string('barcode_produk',100)->primary();
            $table->string('nama_produk')->nullable();
            $table->bigInteger('stok_produk')->nullable();
            $table->double('harga_beli_produk',10,0);
            $table->double('harga_jual_produk',10,0);
            $table->unsignedBigInteger('fkid_jenis_produk')->index();
            $table->unsignedBigInteger('fkid_tempat_produk')->index();
            $table->timestamps();
            $table->foreign('fkid_jenis_produk')->references('id_jenis_produk')->on('tbl_jenis_produk');
            $table->foreign('fkid_tempat_produk')->references('id_tempat_produk')->on('tbl_tempat_produk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produks');
    }
};
