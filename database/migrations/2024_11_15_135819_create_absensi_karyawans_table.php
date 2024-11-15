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
        Schema::create('tbl_absensi_karyawan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fkid_user')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->date('tanggal_absen');
            $table->time('masuk_pagi')->nullable();
            $table->time('keluar_siang')->nullable();
            $table->time('masuk_siang')->nullable();
            $table->time('keluar_sore')->nullable();
            $table->enum('masuk_pagi_status', ['tepat_waktu', 'terlambat', 'tidak_hadir', 'sakit', 'belum_absen'])->default('belum_absen');
            $table->enum('keluar_siang_status', ['tepat_waktu', 'terlambat', 'tidak_hadir', 'sakit', 'belum_absen'])->default('belum_absen');
            $table->enum('masuk_siang_status', ['tepat_waktu', 'terlambat', 'tidak_hadir', 'sakit', 'belum_absen'])->default('belum_absen');
            $table->enum('keluar_sore_status', ['tepat_waktu', 'terlambat', 'tidak_hadir', 'sakit', 'belum_absen'])->default('belum_absen');
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('tbl_absensi_karyawan');
    }
};
