<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class PesananMakanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan_makanan';

    protected $fillable = [
        'tanggal',
        'shift',
        'jumlah_pesanan',
    ];
}
