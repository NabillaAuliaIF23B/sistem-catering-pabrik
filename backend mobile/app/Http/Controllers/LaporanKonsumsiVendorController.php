<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanKonsumsi;
use Barryvdh\DomPDF\Facade\Pdf;

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

        if ($tipe === 'minggu') {
            $data = LaporanKonsumsi::whereBetween('tanggal', [
                now()->startOfWeek(), now()->endOfWeek()
            ])->get();
        } elseif ($tipe === 'bulan') {
            $data = LaporanKonsumsi::whereMonth('tanggal', now()->month)
                ->whereYear('tanggal', now()->year)->get();
        }

        return view('laporan.konsumsi', compact('data', 'tipe'));
    }

    public function unduhPDF(Request $request)
    {
        $tipe = $request->query('tipe');

        if ($tipe === 'minggu') {
            $data = LaporanKonsumsi::whereBetween('tanggal', [
                now()->startOfWeek(), now()->endOfWeek()
            ])->get();
        } elseif ($tipe === 'bulan') {
            $data = LaporanKonsumsi::whereMonth('tanggal', now()->month)
                ->whereYear('tanggal', now()->year)->get();
        } else {
            $data = LaporanKonsumsi::all();
        }

        $pdf = Pdf::loadView('laporan.konsumsi_pdf', compact('data', 'tipe'));
        return $pdf->download('laporan_konsumsi_'.$tipe.'_'.now()->format('Ymd').'.pdf');
    }
}
