<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanKonsumsi extends Model
{
    use HasFactory;
    protected $table = 'laporan_konsumsi';
    protected $fillable = ['tanggal', 'shift', 'jumlah_validasi_dapur', 'jumlah_scan', 'sisa_makanan'];
}