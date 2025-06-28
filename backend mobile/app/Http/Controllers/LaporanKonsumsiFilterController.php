<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\LaporanKonsumsi;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class LaporanKonsumsiFilterController extends Controller
{
    public function filter(Request $request)
    {
        $request->validate([
            'mode' => 'required|in:bulan,minggu',
            'value' => 'required',
        ]);

        if ($request->mode == 'bulan') {
            $data = LaporanKonsumsi::whereMonth('tanggal', $request->value)
                ->orderBy('tanggal', 'asc')
                ->get();
        } else if ($request->mode == 'minggu') {
            // value format: "2025-06-10" (tanggal acuan dalam minggu)
            $date = Carbon::parse($request->value);
            $startOfWeek = $date->startOfWeek(Carbon::MONDAY)->format('Y-m-d');
            $endOfWeek = $date->endOfWeek(Carbon::SUNDAY)->format('Y-m-d');

            $data = LaporanKonsumsi::whereBetween('tanggal', [$startOfWeek, $endOfWeek])
                ->orderBy('tanggal', 'asc')
                ->get();
        }

        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }
}
