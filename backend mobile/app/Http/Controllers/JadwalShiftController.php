<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\JadwalShift;

class JadwalShiftController extends Controller
{
    public function getJadwalSaya()
    {
        $user = Auth::user(); // ambil user dari token
        $jadwal = JadwalShift::where('id_karyawan', $user->id_karyawan)
                    ->orderBy('tanggal', 'desc')
                    ->get();

        return response()->json($jadwal);
    }

}
