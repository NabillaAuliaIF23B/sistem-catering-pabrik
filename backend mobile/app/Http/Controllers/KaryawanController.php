<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;

class KaryawanController extends Controller
{
    public function index()
    {
        // Hanya ambil yang role = 'karyawan'
        return response()->json(Karyawan::where('role', 'karyawan')->get());
    }
}
