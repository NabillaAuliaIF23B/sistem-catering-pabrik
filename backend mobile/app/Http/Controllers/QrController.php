<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class QrController extends Controller
{
    public function generateQrData(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $timestamp = now()->format('YmdHis'); // Format: 20250617153045
        $random = Str::random(8); // Tambahan pengaman
        $token = $request->bearerToken(); // Ambil token dari header Authorization

        // Gabungkan data
        $data = [
            'id_karyawan' => $user->id_karyawan,
            'token' => $token,
            'timestamp' => $timestamp,
            'rand' => $random
        ];

        return response()->json([
            'data' => $data
        ]);
    }
}
