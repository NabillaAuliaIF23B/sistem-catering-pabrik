<?php

namespace App\Http\Controllers;
use App\Models\LaporanKonsumsi;
use Illuminate\Http\Request;

class LaporanKonsumsiInputController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'shift' => 'required|in:shift_1,shift_2,shift_3',
            'jumlah_validasi_dapur' => 'required|integer|min:0',
            'jumlah_scan' => 'required|integer|min:0',
            'sisa_makanan' => 'required|integer|min:0',
        ]);

        $laporan = LaporanKonsumsi::updateOrCreate(
            ['tanggal' => $request->tanggal, 'shift' => $request->shift],
            [
                'jumlah_validasi_dapur' => $request->jumlah_validasi_dapur,
                'jumlah_scan' => $request->jumlah_scan,
                'sisa_makanan' => $request->sisa_makanan,
            ]
        );

        return response()->json(['message' => 'Data berhasil disimpan', 'data' => $laporan], 200);
    }
}
