<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet"/>
    <script src="<?php echo e(asset('js/dashboard.js')); ?>"></script>
    <link rel="stylesheet" href="<?php echo e(asset('css/koki/dashboardkoki.css')); ?>">
    <title>DASHBOARD</title>
</head>

<style> 
.sidebar {
    position: fixed;
    top: 0;
    left: 0;
    height: 100%;
    width: 260px;
    padding: 10px 14px;
    background:var(--sidebar-color) ;
    transition: var(--tran-02);
}

@media (max-width: 768px) {
  .toggle {
    pointer-events: none; /* Ikon tidak bisa diklik */
    opacity: 0.5; /* Opsional: buat ikon terlihat tidak aktif */
  }
}

</style>
<body>
    <!-- Navigasi Sidebar -->
    <nav class="sidebar close">
        <header class="image-text">
            <span class="image">
                <img src="<?php echo e(asset('assets/logo.png')); ?>" alt="Logo">
            </span>
            <div class="text header-text">
                <span class="name">Catering Service</span>
                <span class="namee">Pabrik </span>
            </div>
            <i class="ri-arrow-right-s-line toggle"></i>
        </header>

        <div class="menu-bar">
            <div class="menu">
                <ul class="menu-links">
                     <li class="nav-link">
                        <a href="<?php echo e(route('dashboard.kokii')); ?>">
                            <i class="ri-dashboard-line icon"></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="<?php echo e(route('profile')); ?>">
                            <i class="ri-user-3-line icon"></i>
                            <span class="text nav-text">Profile</span>
                        </a>
                    </li>
                    
                    <li class="nav-link">
                        <a href="<?php echo e(route('absensi.makan')); ?>">
                            <i class="ri-line-chart-line icon"></i>
                            <span class="text nav-text">Monitoring QR</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="<?php echo e(route('scan.qr.form')); ?>">
                            <i class="ri-qr-code-line icon"></i>
                            <span class="text nav-text">Scan QR Makan</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="<?php echo e(route('verifikasi.index')); ?>">
                            <i class="ri-line-chart-line icon"></i>
                            <span class="text nav-text">Verifikasi Pesanan</span>
                        </a>
                    </li>
                    
                    <li class="nav-link">
                        <a href="<?php echo e(route('pesanan.rekap')); ?>">
                            <i class="ri-line-chart-line icon"></i>
                            <span class="text nav-text">Pesanan Makanan</span>
                        </a>
                    </li>

                </ul>
            </div>
            <div class="buttom-content">
                <ul>
                    <li class="nav-link">
                        <a href="<?php echo e(route('logout')); ?>"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="ri-logout-box-line icon"></i>
                            <span class="text nav-text">Logout</span>
                        </a>

                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                            <?php echo csrf_field(); ?>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Konten Utama -->
    <main class="main-content">
        <div class="dashboard">
          <h3><i class="ri-dashboard-line icon"></i> DASHBOARD KOKi</h3><hr>
            
            <div style="display: flex; flex-wrap: wrap; gap: 8px;">
              <!-- Card 1 -->
              <div class="card text-bg-primary" style="width: fit-content; min-width: 250px;">
                
                <div class="card-header">
                  <h5 class="card-title mb-0">Informasi Pesanan</h5>
                    </div>
                    <div class="card-body py-2 px-3">
                      <p class="card-text mb-1">Tanggal: <?php echo e($tanggalHariIni); ?></p>
                      <p class="card-text mb-1">
                        <span style="font-size: 1.6rem; font-weight: bold;"><?php echo e($jumlahKeseluruhan); ?></span> Jumlah
                      </p>
                      <p class="card-text mb-1">Shift 1: <?php echo e($totalPerShift->get('1', 0)); ?></p>
                      <p class="card-text mb-1">Shift 2: <?php echo e($totalPerShift->get('2', 0)); ?></p>
                      <p class="card-text mb-0">Shift 3: <?php echo e($totalPerShift->get('3', 0)); ?></p>
                    </div>
                    <a href="<?php echo e(route('pesanan.rekap')); ?>" class="btn btn-sm btn-light">Lihat Rekap</a>
                </div>

              <!-- Card 2 -->
              
              <div class="card text-bg-primary" style="width: fit-content; min-width: 250px;">
                <div class="card-header">
                  <h5 class="card-title mb-0">Statistik Karyawan</h5>
                </div>
                <div class="card-body py-2 px-3">
                  <p class="card-text mb-1">
                    <span style="font-size: 1.6rem; font-weight: bold;"><?php echo e($jumlahKeseluruhanKaryawan); ?></span> Karyawan
                  </p>
                  <p class="card-text mb-1">Total: <?php echo e($jumlahKeseluruhanKaryawan ?? 0); ?></p>
                  <p class="card-text mb-1">Aktif: <?php echo e($jumlahAktif ?? 0); ?></p>
                  <p class="card-text mb-0">Nonaktif: <?php echo e($jumlahNonAktif ?? 0); ?></p>
                </div>
              </div>

              <!-- Card 3 -->
              
              <div class="card text-bg-primary" style="width: fit-content; min-width: 250px;">
                <div class="card-header">
                  <h5 class="card-title mb-0">Informasi Absensi Makan</h5>
                </div>
                <div class="card-body py-2 px-3">
                  <p class="card-text mb-1">Tanggal: <?php echo e($tanggalHariIni); ?></p>
                  
                  <p><strong>Shift 1</strong> - Sudah Ambil: <?php echo e($totalPerShiftSudah->get('shift_1', 0)); ?>, Belum Ambil: <?php echo e($totalPerShiftBelum->get('shift_1', 0)); ?></p>
                  <p><strong>Shift 2</strong> - Sudah Ambil: <?php echo e($totalPerShiftSudah->get('shift_2', 0)); ?>, Belum Ambil: <?php echo e($totalPerShiftBelum->get('shift_2', 0)); ?></p>
                  <p><strong>Shift 3</strong> - Sudah Ambil: <?php echo e($totalPerShiftSudah->get('shift_3', 0)); ?>, Belum Ambil: <?php echo e($totalPerShiftBelum->get('shift_3', 0)); ?></p>

                  <hr class="my-2">

                  
                  <p class="card-text mb-1"><strong>Total Sudah Ambil:</strong> <?php echo e($totalSudahAmbil); ?></p>
                  <p class="card-text mb-1"><strong>Total Belum Ambil:</strong> <?php echo e($totalBelumAmbil); ?></p>
                  <p class="card-text mb-0"><strong>Total Keseluruhan:</strong> <?php echo e($totalSudahAmbil + $totalBelumAmbil); ?></p>
                </div>
                <a href="<?php echo e(route('absensi.makan')); ?>" class="btn btn-sm btn-light">Lihat Absensi Makan</a>
              </div>

            </div>

        </div>
    </main>
    <br><br>

    <!-- Footer -->
    <footer>
        <p>&copy; <?= date("Y"); ?> Catering Service Pabrik.</p>
    </footer>
</body>
</html>
<?php /**PATH /home/kelompo7/catering.kelompok47.my.id/resources/views/koki/dashboard.blade.php ENDPATH**/ ?>