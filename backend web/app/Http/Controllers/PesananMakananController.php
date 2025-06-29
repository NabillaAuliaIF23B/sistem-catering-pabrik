<?php

namespace App\Http\Controllers;
use App\Models\PesananMakanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\VerifikasiPesanan;

class PesananMakananController extends Controller
{
    
    
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'shift' => 'required|in:1,2,3',
            'jumlah_pesanan' => 'required|integer|min:1',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);
    
        // Koordinat kantor
        $kantorLat = -6.200000;
        $kantorLng = 106.816666;
    
        // Hitung jarak
        $jarak = $this->hitungJarakMeter(
            $kantorLat,
            $kantorLng,
            $request->latitude,
            $request->longitude
        );
    
        if ($jarak > 100) {
            return response()->json([
                'message' => 'Akses hanya diizinkan di dalam area perusahaan.'
            ], 403);
        }
    
        // Simpan pesanan
        $pesanan = PesananMakanan::create([
            'tanggal' => $request->tanggal,
            'shift' => $request->shift,
            'jumlah_pesanan' => $request->jumlah_pesanan,
        ]);
    
        return response()->json([
            'message' => 'Pesanan berhasil disimpan',
            'data' => $pesanan
        ]);
    }
    
    private function hitungJarakMeter($lat1, $lon1, $lat2, $lon2)
    {
        $R = 6371000; // radius bumi dalam meter
        $lat1Rad = deg2rad($lat1);
        $lat2Rad = deg2rad($lat2);
        $deltaLat = deg2rad($lat2 - $lat1);
        $deltaLon = deg2rad($lon2 - $lon1);
    
        $a = sin($deltaLat / 2) * sin($deltaLat / 2) +
             cos($lat1Rad) * cos($lat2Rad) *
             sin($deltaLon / 2) * sin($deltaLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        return $R * $c;
    }


    
    public function ringkasanHariIni()
    {
        $today = now()->toDateString();
    
        $data = DB::table('pesanan_makanan')
            ->whereDate('created_at', $today)
            ->selectRaw('SUM(jumlah_pesanan) as total')
            ->first();
    
        $perShift = DB::table('pesanan_makanan')
            ->whereDate('created_at', $today)
            ->select('shift', DB::raw('SUM(jumlah_pesanan) as jumlah'))
            ->groupBy('shift')
            ->get();
    
        return response()->json([
            'tanggal' => $today,
            'total' => $data->total ?? 0,
            'shift' => $perShift
        ]);
    }
    
   

    
    public function index()
{
    $tanggalHariIni = date('Y-m-d');

    // Hitung total per shift
    $totalPerShift = PesananMakanan::where('tanggal', $tanggalHariIni)
        ->selectRaw('shift, SUM(jumlah_pesanan) as total')
        ->groupBy('shift')
        ->pluck('total', 'shift');

    // Hitung jumlah keseluruhan (total semua shift)
    $jumlahKeseluruhan = $totalPerShift->sum();

    return view('koki.index', compact('totalPerShift', 'jumlahKeseluruhan', 'tanggalHariIni'));
}


public function rekapPesanan(Request $request)
{
    $tanggal = $request->input('tanggal');
    $bulan = $request->input('bulan');

    $query = \App\Models\PesananMakanan::query();

    if ($tanggal) {
        $query->whereDate('tanggal', $tanggal);
    } elseif ($bulan) {
        $query->whereMonth('tanggal', $bulan);
    }

    $data = $query->get()->groupBy('tanggal');

    return view('koki.pesananrekap', [
        'data' => $data,
        'tanggal' => $tanggal,
        'bulan' => $bulan,
    ]);
}


    
    
}
