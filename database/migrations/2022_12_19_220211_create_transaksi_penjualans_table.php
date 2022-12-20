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
        Schema::create('tbl_transaksi_penjualan', function (Blueprint $table) {
            // $table->id('id_transaksi_penjualan');
            $table->string('faktur')->primary();
            $table->unsignedBigInteger('fkid_pelanggan')->index();
            $table->unsignedBigInteger('fkid_user')->index();
            $table->double('total_pembayaran',10,0);
            $table->double('uang_terbayar',10,0);
            $table->date('tanggal');
            $table->timestamps();
            $table->foreign('fkid_pelanggan')->references('id_pelanggan')->on('tbl_pelanggan')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('fkid_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi_penjualans');
    }
};
