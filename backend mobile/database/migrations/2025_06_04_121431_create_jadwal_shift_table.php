<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_shift', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_karyawan');
            $table->date('tanggal');
            $table->enum('shift', ['shift_1', 'shift_2', 'shift_3']);
            $table->timestamps();

            $table->engine = 'InnoDB'; // pastikan InnoDB

            // Foreign key constraint
            $table->foreign('id_karyawan')
                  ->references('id_karyawan')
                  ->on('karyawan')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_shift');
    }
};
