<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PesananMakanan;
use App\Models\Karyawan;
use App\Models\AbsensiMakan;
use Illuminate\Support\Carbon;

class DashboardKokiController extends Controller
{
    public function index()
    {
        $tanggalHariIni = Carbon::now()->toDateString();

        // ==========================
        // Total Pesanan per Shift
        // ==========================
        $pesananData = PesananMakanan::where('tanggal', $tanggalHariIni)
            ->selectRaw('shift, SUM(jumlah_pesanan) as total')
            ->groupBy('shift')
            ->pluck('total', 'shift');

        // Pastikan shift_1, shift_2, shift_3 tetap tersedia
        $totalPerShift = collect([
            'shift_1' => $pesananData->get('shift_1', 0),
            'shift_2' => $pesananData->get('shift_2', 0),
            'shift_3' => $pesananData->get('shift_3', 0),
        ]);

        $jumlahKeseluruhan = $totalPerShift->sum();

        // ==========================
        // Statistik Karyawan
        // ==========================
        $jumlahKeseluruhanKaryawan = Karyawan::count();
        $jumlahAktif = Karyawan::where('status', 'aktif')->count();
        $jumlahNonAktif = Karyawan::where('status', 'nonaktif')->count();

        // ==========================
        // Absensi Makan Hari Ini
        // ==========================
        $absensiHariIni = AbsensiMakan::with('jadwalShift')
            ->whereDate('tanggal', $tanggalHariIni)
            ->get();

        $sudahAmbil = $absensiHariIni->where('status', 'sudah');
        $belumAmbil = $absensiHariIni->where('status', 'belum');

        // Total per shift yang sudah ambil
        $totalPerShiftSudah = $sudahAmbil->groupBy(function ($item) {
            return optional($item->jadwalShift)->shift ?? 'unknown';
        })->map->count();

        // Total per shift yang belum ambil
        $totalPerShiftBelum = $belumAmbil->groupBy(function ($item) {
            return optional($item->jadwalShift)->shift ?? 'unknown';
        })->map->count();

        // Pastikan semua shift_1, shift_2, shift_3 selalu ada
        $defaultShifts = collect([
            'shift_1' => 0,
            'shift_2' => 0,
            'shift_3' => 0,
        ]);

        $totalPerShiftSudah = $defaultShifts->merge($totalPerShiftSudah);
        $totalPerShiftBelum = $defaultShifts->merge($totalPerShiftBelum);

        // ==========================
        // Total keseluruhan absensi
        // ==========================
        $totalSudahAmbil = $sudahAmbil->count();
        $totalBelumAmbil = $belumAmbil->count();

        return view('koki.dashboard', [
            'tanggalHariIni' => $tanggalHariIni,
            'totalPerShift' => $totalPerShift,
            'jumlahKeseluruhan' => $jumlahKeseluruhan,

            'jumlahKeseluruhanKaryawan' => $jumlahKeseluruhanKaryawan,
            'jumlahAktif' => $jumlahAktif,
            'jumlahNonAktif' => $jumlahNonAktif,

            'totalPerShiftSudah' => $totalPerShiftSudah,
            'totalPerShiftBelum' => $totalPerShiftBelum,
            'totalSudahAmbil' => $totalSudahAmbil,
            'totalBelumAmbil' => $totalBelumAmbil,
        ]);
    }
}

