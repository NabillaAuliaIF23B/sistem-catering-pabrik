<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('absensi_makan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_karyawan');
            $table->dateTime('waktu');
            $table->enum('status', ['sudah', 'belum']);
            $table->timestamps();

            $table->engine = 'InnoDB'; // pastikan InnoDB

            // Foreign key constraint
            $table->foreign('id_karyawan')
                  ->references('id_karyawan')
                  ->on('karyawan')
                  ->onDelete('cascade');

            $table->foreign('id_jadwal_shift')
                  ->references('id')
                  ->on('jadwal_shift')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('absensi_makan');
    }
};
