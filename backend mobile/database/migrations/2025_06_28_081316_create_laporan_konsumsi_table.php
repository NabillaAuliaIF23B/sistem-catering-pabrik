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
        Schema::create('laporan_konsumsi', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->enum('shift', ['shift_1', 'shift_2', 'shift_3']);
            $table->integer('jumlah_validasi_dapur');
            $table->integer('jumlah_scan')->default(0);
            $table->integer('sisa_makanan')->nullable();
            $table->timestamps();

            $table->unique(['tanggal', 'shift']); // agar tiap tanggal & shift hanya 1 entri
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laporan_konsumsi');
    }
};
