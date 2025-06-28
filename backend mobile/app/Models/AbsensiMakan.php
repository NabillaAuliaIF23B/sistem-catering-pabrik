<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AbsensiMakan extends Model
{
    protected $table = 'absensi_makan';

    protected $fillable = [
        'id_karyawan', 
        'id_jadwal_shift',
        'shift',
        'tanggal',
        'waktu', 
        'status'];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan', 'id_karyawan');
    }
    
    public function jadwalShift()
    {
        return $this->belongsTo(JadwalShift::class, 'id_jadwal_shift', 'id');
    }
}
