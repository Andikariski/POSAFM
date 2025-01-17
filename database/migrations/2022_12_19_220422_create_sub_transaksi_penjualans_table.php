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
        Schema::create('tbl_sub_transaksi_penjualan', function (Blueprint $table) {
            $table->id('id_temp_transaksi_penjualan');
            $table->string('fkid_faktur')->index()->nullable();
            $table->string('fkid_barcode_produk')->nullable();
            $table->string('nama_produk')->nullable();
            $table->double('harga_satuan',10,0);
            $table->integer('jumlah_produk');
            $table->double('sub_total',10,0);
            $table->double('profit',10,0);
            $table->date('tanggal');
            $table->timestamps();
            // $table->foreign('fkid_barcode_produk')->references('barcode_produk')->on('tbl_produk')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_transaksi_penjualans');
    }
};
