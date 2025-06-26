<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanKonsumsiVendorController;

Route::get('/laporan', [LaporanKonsumsiVendorController::class, 'index']);
Route::post('/laporan/filter', [LaporanKonsumsiVendorController::class, 'filter']);
Route::get('/laporan/pdf', [LaporanKonsumsiVendorController::class, 'unduhPDF']);

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
