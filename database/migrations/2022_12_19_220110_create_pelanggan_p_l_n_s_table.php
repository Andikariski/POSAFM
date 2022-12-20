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
        Schema::create('tbl_pelanggan_pln', function (Blueprint $table) {
            $table->id('id_pelanggan_pln');
            $table->string('nomer_pelanggan_pln');
            $table->unsignedBigInteger('fkid_pelanggan')->index();
            $table->timestamps();
            $table->foreign('fkid_pelanggan')
                    ->references('id_pelanggan')
                    ->on('tbl_pelanggan')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pelanggan_p_l_n_s');
    }
};
