<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AbsensiMakan;
use App\Models\JadwalShift;
use App\Models\Karyawan;

class ScanQRBladeController extends Controller
{
    public function form()
    {
        return view('koki.scan');
    }
    
    public function submit(Request $request)
{
    $id_karyawan = $request->input('id_karyawan');

    if (!$id_karyawan) {
        return back()->with('message', 'ID karyawan tidak valid.');
    }

    $tanggal = date('Y-m-d');
    $jamSekarang = date('H:i:s');

    // Waktu shift manual
    $jamShift = [
        'shift_1' => ['mulai' => '06:00:00', 'selesai' => '13:59:59'],
        'shift_2' => ['mulai' => '14:00:00', 'selesai' => '21:59:59'],
        'shift_3' => ['mulai' => '22:00:00', 'selesai' => '23:59:59'],
        'shift_3_lanjut' => ['mulai' => '00:00:00', 'selesai' => '05:59:59'],
    ];

    // Cari jadwal shift berdasarkan id_karyawan dan tanggal
    $jadwal = JadwalShift::where('id_karyawan', $id_karyawan)
        ->whereDate('tanggal', $tanggal)
        ->first();

    if (!$jadwal) {
        return back()->with('message', "Tidak ada jadwal ditemukan untuk ID $id_karyawan pada tanggal $tanggal.");
    }

    $shift = $jadwal->shift;
    $idJadwal = $jadwal->id;

    // Validasi waktu shift
    $jamValid = false;
    if ($shift == 'shift_1' && $jamSekarang >= $jamShift['shift_1']['mulai'] && $jamSekarang <= $jamShift['shift_1']['selesai']) {
        $jamValid = true;
    } elseif ($shift == 'shift_2' && $jamSekarang >= $jamShift['shift_2']['mulai'] && $jamSekarang <= $jamShift['shift_2']['selesai']) {
        $jamValid = true;
    } elseif ($shift == 'shift_3') {
        if (
            ($jamSekarang >= $jamShift['shift_3']['mulai'] && $jamSekarang <= $jamShift['shift_3']['selesai']) ||
            ($jamSekarang >= $jamShift['shift_3_lanjut']['mulai'] && $jamSekarang <= $jamShift['shift_3_lanjut']['selesai'])
        ) {
            $jamValid = true;
        }
    }

    if (!$jamValid) {
        return back()->with('message', "Waktu scan tidak sesuai shift ($shift). Jam sekarang: $jamSekarang");
    }

    // Cek apakah sudah absen
    $absensi = AbsensiMakan::where('id_karyawan', $id_karyawan)
        ->where('id_jadwal_shift', $idJadwal)
        ->first();

    if ($absensi && $absensi->status === 'sudah') {
        // Sudah absen
        return back()->with('message', "Anda sudah ambil makanan hari ini. (Shift: $shift)");
    }

    // Belum absen → update atau insert
    if ($absensi) {
        $absensi->update([
            'waktu' => now(),
            'status' => 'sudah',
        ]);
    } else {
        AbsensiMakan::create([
            'id_karyawan' => $id_karyawan,
            'id_jadwal_shift' => $idJadwal,
            'waktu' => now(),
            'status' => 'sudah',
        ]);
    }

    return back()->with('message', "Berhasil ambil makanan. (Shift: $shift)");
}

}
