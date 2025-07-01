<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css"
    rel="stylesheet"
    />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo e(asset('css/hrga/userhrga.css')); ?>">
    <script src="<?php echo e(asset('js/dashboard.js')); ?>"></script>


    <title>Rekap Pesanan Makanan</title>
</head>

<style> 
    @media (max-width: 768px) {
    .toggle {
        pointer-events: none; /* Ikon tidak bisa diklik */
        opacity: 0.5; /* Opsional: buat ikon terlihat tidak aktif */
    }
}
</style>

<body>
    <nav class="sidebar close">
        <header class="image-text">
            <span class="image">
                <img src="<?php echo e(asset('assets/logo.png')); ?>" alt="Logo">
            </span>
            <div class="text header-text">
                <span class="name">Catering Service</span>
                <span class="namee"> Pabrik </span>
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
    
    
    <!-- Main Content -->
    <main class="main-content">
        <div class="dashboard">
            <h3>Data Pesanan Makanan per Tanggal dan Shift</h3> <hr>
            <div class="row">
            <div class="container-fluid">
            
        </div>
        
        <div class="container">
            <form method="GET" action="<?php echo e(route('pesanan.rekap')); ?>" class="row g-3 mb-4">
                <div class="col-md-3">
                    <label for="opsi" class="form-label">Lihat Berdasarkan</label>
                    <select id="opsi" class="form-select" onchange="toggleFilter()" required>
                        <option value="">-- Pilih --</option>
                        <option value="tanggal">Tanggal</option>
                        <option value="bulan">Bulan</option>
                    </select>
                </div>
            
                <div class="col-md-3" id="form-tanggal" style="display: none;">
                    <label for="tanggal" class="form-label">Pilih Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control">
                </div>
            
                <div class="col-md-3" id="form-bulan" style="display: none;">
                    <label for="bulan" class="form-label">Pilih Bulan</label>
                    <select name="bulan" id="bulan" class="form-select">
                        <option value="">-- Pilih Bulan --</option>
                        <?php for($i = 1; $i <= 12; $i++): ?>
                            <option value="<?php echo e($i); ?>" <?php echo e($bulan == $i ? 'selected' : ''); ?>>
                                <?php echo e(DateTime::createFromFormat('!m', $i)->format('F')); ?>

                            </option>
                        <?php endfor; ?>
                    </select>
                </div>
            
                <div class="col-md-3 align-self-end">
                    <button class="btn btn-primary">Tampilkan</button>
                </div>
            </form>

            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Tanggal</th>
                        <th>Shift 1</th>
                        <th>Shift 2</th>
                        <th>Shift 3</th>
                    </tr>
                </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tgl => $pesananPerTanggal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <?php
                                $shifts = [
                                    '1' => $pesananPerTanggal->where('shift', '1')->sum('jumlah_pesanan'),
                                    '2' => $pesananPerTanggal->where('shift', '2')->sum('jumlah_pesanan'),
                                    '3' => $pesananPerTanggal->where('shift', '3')->sum('jumlah_pesanan'),
                                ];
                            ?>
                            <tr>
                                <td><?php echo e(\Carbon\Carbon::parse($tgl)->format('d M Y')); ?></td>
                                <td><?php echo e($shifts['1']); ?></td>
                                <td><?php echo e($shifts['2']); ?></td>
                                <td><?php echo e($shifts['3']); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada data pesanan.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
            </table>
        </div>
    </main>
    <!-- Footer -->
    <footer>
        <p>&copy; <?= date("Y"); ?>  Catering Service Pabrik.</p>
    </footer>

    <script>
function toggleFilter() {
    const opsi = document.getElementById('opsi').value;
    const formTanggal = document.getElementById('form-tanggal');
    const formBulan = document.getElementById('form-bulan');

    if (opsi === 'tanggal') {
        formTanggal.style.display = 'block';
        formBulan.style.display = 'none';
        document.getElementById('bulan').value = '';
    } else if (opsi === 'bulan') {
        formTanggal.style.display = 'none';
        formBulan.style.display = 'block';
        document.getElementById('tanggal').value = '';
    } else {
        formTanggal.style.display = 'none';
        formBulan.style.display = 'none';
    }
}
</script>
    
</body>
</html><?php /**PATH /home/kelompo7/catering.kelompok47.my.id/resources/views/koki/pesananrekap.blade.php ENDPATH**/ ?>