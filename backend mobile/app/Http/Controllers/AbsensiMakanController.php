<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\AbsensiMakan;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class AbsensiMakanController extends Controller
{
    public function getTotalSudahHariIni()
    {
        $tanggalHariIni = Carbon::today()->toDateString();

        $totalSudah = AbsensiMakan::where('status', 'sudah')
                        ->whereDate('tanggal', $tanggalHariIni)
                        ->count();

        return response()->json([
            'tanggal' => $tanggalHariIni,
            'total_sudah' => $totalSudah
        ]);
    }

    public function getAbsensiSudahByUser()
    {
        $user = Auth::user(); // dapatkan user dari token login

        $data = AbsensiMakan::where('id_karyawan', $user->id_karyawan)
                    ->where('status', 'sudah')
                    ->orderBy('tanggal', 'desc')
                    ->get();

        return response()->json($data);
    }
}
