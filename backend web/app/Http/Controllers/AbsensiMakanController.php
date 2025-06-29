<?php

namespace App\Http\Controllers;


use App\Models\AbsensiMakan;
use App\Models\Karyawan;

use Illuminate\Http\Request;

class AbsensiMakanController extends Controller
{
    
public function index(Request $request)
{
    $tanggal = $request->input('tanggal', now()->toDateString());
    $status = $request->input('status');
    $shift = $request->input('shift');

    $query = AbsensiMakan::with(['karyawan', 'jadwalShift'])
        ->whereDate('waktu', $tanggal);

    if ($status) {
        $query->where('status', $status);
    }

    // ✅ Validasi dan filter shift
    $validShifts = ['shift_1', 'shift_2', 'shift_3'];
    if ($shift && in_array($shift, $validShifts)) {
        $query->whereHas('jadwalShift', function ($q) use ($shift) {
            $q->where('shift', $shift);
        });
    }

    $absensis = $query->get();

    return view('koki.monitoring', compact('absensis', 'tanggal'));
}



public function history(Request $request)
    {
        $user = $request->user(); // user yang sedang login

        $history = AbsensiMakan::with('jadwalShift')
            ->where('id_karyawan', $user->id_karyawan)
            ->where('status', 'sudah')
            ->orderBy('waktu', 'desc')
            ->get();

        return response()->json($history);
    }

}
