use App\Http\Controllers\KaryawanWebController;
use App\Http\Controllers\PesananMakananController;
use App\Http\Controllers\AbsensiMakanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ScanQRBladeController;
use App\Http\Controllers\AuthWebController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\VerifikasiController;

//tambah karyawan
Route::post('/users/store', [KaryawanWebController::class, 'store'])->name('user.store');

//update user
Route::post('/users/update/{id}', [KaryawanWebController::class, 'update'])->name('user.update');

//nampilin data user
Route::get('/user', [KaryawanWebController::class, 'index'])->name('user.index');
//atau bisa yg ini
//yg ini
Route::get('/users', [KaryawanWebController::class, 'index'])->name('user.index');


//bikin karyawan baru 
Route::get('/users/create', [KaryawanWebController::class, 'create'])->name('user.create');

//edit data karyawan
Route::get('/users/edit/{id}', [KaryawanWebController::class, 'edit'])->name('user.edit');

// Route resource untuk index, create, store, edit, update, destroy
Route::resource('user', KaryawanWebController::class);

// Route khusus untuk toggle status aktif/tidak
Route::patch('user/{id}/toggle-status', [KaryawanWebController::class, 'toggleStatus'])->name('user.toggleStatus');

//Data Pesanan Makanan per Tanggal dan Shift
Route::get('/rekap-pesanan', [PesananMakananController::class, 'rekapPesanan'])->name('pesanan.rekap');

//Data Absensi Makan
Route::get('/absensi-makan', [AbsensiMakanController::class, 'index'])->name('absensi.makan');

//nampilin dasboard koki
Route::get('/dashboard-kokii', [DashboardKokiController::class, 'index'])->name('dashboard.kokii');


//scan nampilin 
Route::get('/scan-qr', [ScanQRBladeController::class, 'form'])->name('scan.qr.form');
//scan qr submit
Route::post('/scan-qr', [ScanQRBladeController::class, 'submit'])->name('scan.qr.submit');

//login
Route::get('/login', [AuthWebController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthWebController::class, 'login']);

//buat ke halaman utama habis login

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

    //logout
    Route::post('/logout', [AuthWebController::class, 'logout'])->name('logout');



//buat ke halaman profile 
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
});

//password
Route::get('/change-password', [PasswordController::class, 'showChangeForm'])->name('password.change');
Route::post('/change-password', [PasswordController::class, 'update'])->name('password.update');

//verifikasi
Route::get('/verifikasi', [VerifikasiController::class, 'index'])->name('verifikasi.index');
Route::get('/verifikasi/{id}/edit', [VerifikasiController::class, 'edit'])->name('verifikasi.edit');
Route::put('/verifikasi/{id}', [VerifikasiController::class, 'update'])->name('verifikasi.update');
