<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PesananMakananController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\LaporanKonsumsiInputController;
use App\Http\Controllers\QrController;

use App\Http\Controllers\AbsensiMakanController;
use App\Http\Controllers\JadwalShiftController;


//login
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [AuthController::class, 'profile']);
});

//nampilin data di dashboard hrga
Route::get('/pesanan-makanan/ringkasan', [PesananMakananController::class, 'ringkasanHariIni']);

// nampilin nama karyawan
Route::get('/users', [UserController::class, 'index']);

//hapus karyawan
Route::delete('/karyawan/{id}', [UserController::class, 'destroy']);

// hrga laporan
Route::get('/laporan-konsumsi/filter', [\App\Http\Controllers\LaporanKonsumsiFilterController::class, 'filter']);

//nampilin data karyawan role karyawan
Route::get('/karyawans', [KaryawanController::class, 'index']);

//buat jadwal shif
Route::post('/buat-jadwal', [JadwalController::class, 'buat']);

//nampilin jadwal shif
Route::get('/jadwal-shift', [JadwalController::class, 'index']);
Route::get('/jadwal-shift', [JadwalController::class, 'getJadwalShift']);

//input jumlah pesanan
Route::post('/pesanan-makanan', [PesananMakananController::class, 'store']);;

//input laporan
Route::post('/laporan-konsumsi', [LaporanKonsumsiInputController::class, 'store']);

//qr
Route::middleware('auth:sanctum')->get('/qr-data', [QrController::class, 'generateQrData']);

//jumlah yg sudah menagmbil makan timestime
Route::get('/total-absen-sudah', [AbsensiMakanController::class, 'getTotalSudahHariIni']);

//untuk nampiln history absensi makan yg status sudah sesuai user yg login
Route::middleware('auth:sanctum')->get('/absensi-sudah', [AbsensiMakanController::class, 'getAbsensiSudahByUser']);

//nampilin jadwal shif 
Route::middleware('auth:sanctum')->get('/jadwal-saya', [JadwalShiftController::class, 'getJadwalSaya']);

//nampilin data pesanan 
Route::get('/pesanan-makanan', [PesananMakananController::class, 'getByTanggal']);

//ganti password
Route::middleware('auth:sanctum')->put('/ganti-password', [AuthController::class, 'gantiPassword']);

//logout 
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);


Route::get('/lokasi-kantor', function () {
    return response()->json([
        //'latitude' => -6.3075656,
        //'longitude' => 107.3019611
        //'latitude' => -6.2933123,
        //'longitude' => 107.3021071
        
        //'latitude' => -6.306306306306,
        //'longitude' => 107.29792217004362
        
        'latitude' => -6.306297306306,
        'longitude' => 107.29792217004362
        
        

    ]);
});
