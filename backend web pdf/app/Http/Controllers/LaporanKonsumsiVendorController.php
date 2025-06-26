<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanKonsumsi;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;


class LaporanKonsumsiVendorController extends Controller
{
    public function index()
    {
        $data = LaporanKonsumsi::orderBy('tanggal', 'desc')->get();
        return view('laporan.konsumsi', compact('data'));
    }

    public function filter(Request $request)
{
    $tipe = $request->tipe;
    $data = [];

    if ($tipe === 'minggu' && $request->tanggal_minggu) {
        $tanggal = Carbon::parse($request->tanggal_minggu)->startOfWeek(); // Senin minggu itu
        $data = LaporanKonsumsi::whereBetween('tanggal', [
            $tanggal, $tanggal->copy()->endOfWeek() // Minggu
        ])->get();
    } elseif ($tipe === 'bulan' && $request->bulan_manual) {
        [$year, $month] = explode('-', $request->bulan_manual);
        $data = LaporanKonsumsi::whereYear('tanggal', $year)
            ->whereMonth('tanggal', $month)->get();
    }

    return view('laporan.konsumsi', compact('data', 'tipe'));
}

    public function unduhPDF(Request $request)
{
    $tipe = $request->query('tipe');
    $data = [];

    if ($tipe === 'minggu' && $request->query('tanggal_minggu')) {
        $tanggal = Carbon::parse($request->query('tanggal_minggu'))->startOfWeek();
        $data = LaporanKonsumsi::whereBetween('tanggal', [
            $tanggal, $tanggal->copy()->endOfWeek()
        ])->get();
    } elseif ($tipe === 'bulan' && $request->query('bulan_manual')) {
        [$year, $month] = explode('-', $request->query('bulan_manual'));
        $data = LaporanKonsumsi::whereYear('tanggal', $year)
            ->whereMonth('tanggal', $month)->get();
    }

    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('laporan.konsumsi_pdf', compact('data', 'tipe'));
    return $pdf->download('laporan_konsumsi_' . $tipe . '_' . now()->format('Ymd') . '.pdf');
}

}
