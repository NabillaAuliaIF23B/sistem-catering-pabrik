<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifikasiPesanan extends Model
{
    use HasFactory;

    protected $table = 'verifikasi_pesanan';

    protected $fillable = [
        'pesanan_id',
        'verifikator_id',
        'status',
        'catatan',
        'waktu_verifikasi',
    ];

    // Relasi ke pesanan makanan
    public function pesanan()
    {
        return $this->belongsTo(PesananMakanan::class, 'pesanan_id');
    }

    // Relasi ke karyawan sebagai verifikator
    public function verifikator()
    {
        return $this->belongsTo(Karyawan::class, 'verifikator_id', 'id_karyawan');
    }
}
