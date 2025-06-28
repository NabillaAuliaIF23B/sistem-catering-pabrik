<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\JadwalShift;
use Illuminate\Support\Facades\DB;
use App\Models\AbsensiMakan;

class JadwalController extends Controller
{
    public function buat(Request $request)
    {
        $validated = $request->validate([
            'id_karyawan' => 'required|array|min:1',
            'id_karyawan.*' => 'exists:karyawan,id_karyawan',
            'tanggal' => 'required|date',
            'shift' => 'required|in:shift_1,shift_2,shift_3',
        ]);

        foreach ($validated['id_karyawan'] as $id_karyawan) {
            try {
                // Simpan jadwal shift
                $jadwal = JadwalShift::create([
                    'id_karyawan' => $id_karyawan,
                    'tanggal' => $validated['tanggal'],
                    'shift' => $validated['shift'],
                ]);

                // Simpan absensi makan
                AbsensiMakan::create([
                    'id_karyawan' => $id_karyawan,
                    'id_jadwal_shift' => $jadwal->id,
                    'tanggal' => $validated['tanggal'],
                    'shift' => $validated['shift'],
                    'waktu' => $validated['tanggal'] . ' 00:00:00',
                    'status' => 'belum',
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'message' => 'Gagal simpan salah satu data: ' . $e->getMessage()
                ], 500);
            }
        }

        return response()->json(['message' => 'Jadwal shift dan absen berhasil disimpan'], 200);
    }

    public function index()
    {
        try {
            $jadwal = JadwalShift::all();  // Ambil semua jadwal shift dari DB
            return response()->json([
                'success' => true,
                'data' => $jadwal
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal ambil jadwal shift: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getJadwalShift(Request $request)
    {
        $query = DB::table('jadwal_shift')
            ->join('karyawan', 'jadwal_shift.id_karyawan', '=', 'karyawan.id_karyawan')
            ->select('jadwal_shift.*', 'karyawan.nama');

        // Filter berdasarkan tanggal lengkap
        if ($request->filled('tanggal')) {
            try {
                $tanggal = date('Y-m-d', strtotime($request->tanggal));
                $query->whereDate('jadwal_shift.tanggal', $tanggal);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Format tanggal tidak valid (gunakan format YYYY-MM-DD)'
                ], 400);
            }
        }

        // Filter berdasarkan bulan dan tahun
        if ($request->filled('bulan') && $request->filled('tahun')) {
            $query->whereMonth('jadwal_shift.tanggal', $request->bulan)
                ->whereYear('jadwal_shift.tanggal', $request->tahun);
        }

        $jadwals = $query->get();

        return response()->json([
            'status' => 'success',
            'data' => $jadwals
        ]);
    }

}
