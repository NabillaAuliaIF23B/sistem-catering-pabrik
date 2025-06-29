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
        Schema::create('verifikasi_pesanan', function (Blueprint $table) {
            $table->id();

            // Relasi ke pesanan_makanan
            $table->unsignedBigInteger('pesanan_id');
            $table->foreign('pesanan_id')->references('id')->on('pesanan_makanan')->onDelete('cascade');

            // Relasi ke karyawan (yang memverifikasi)
            $table->unsignedBigInteger('verifikator_id')->nullable();
            $table->foreign('verifikator_id')->references('id_karyawan')->on('karyawan')->onDelete('set null');

            // Status verifikasi
            $table->enum('status', ['disetujui', 'ditolak'])->default('disetujui');

            // Keterangan atau catatan dari verifikator
            $table->text('catatan')->nullable();

            // Waktu verifikasi
            $table->timestamp('waktu_verifikasi')->nullable();

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
        Schema::dropIfExists('verifikasi_pesanan');
    }
};
