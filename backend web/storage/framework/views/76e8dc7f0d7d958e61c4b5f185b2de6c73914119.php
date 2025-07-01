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


    <title>Absensi Karyawan</title>
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
            <h3><i class="ri-group-line icon"></i>Data Absensi Makan</h3> <hr>
            <div class="row">
            <div class="container-fluid">
            
        </div>
        
        <div class="container">

    
    <form method="GET" action="<?php echo e(route('absensi.makan')); ?>" class="mb-4 row g-2">
    <div class="col-md-3">
        <label for="tanggal" class="form-label">Tanggal:</label>
        <input type="date" id="tanggal" name="tanggal" value="<?php echo e($tanggal); ?>" class="form-control" />
    </div>

    <div class="col-md-3">
        <label for="shift" class="form-label">Shift:</label>
        <select name="shift" id="shift" class="form-control">
            <option value="">Semua</option>
            <option value="shift_1" <?php echo e(request('shift') == 'shift_1' ? 'selected' : ''); ?>>Shift 1</option>
            <option value="shift_2" <?php echo e(request('shift') == 'shift_2' ? 'selected' : ''); ?>>Shift 2</option>
            <option value="shift_3" <?php echo e(request('shift') == 'shift_3' ? 'selected' : ''); ?>>Shift 3</option>

        </select>
    </div>

    <div class="col-md-3">
        <label for="status" class="form-label">Status:</label>
        <select name="status" id="status" class="form-control">
            <option value="">Semua</option>
            <option value="sudah" <?php echo e(request('status') == 'sudah' ? 'selected' : ''); ?>>Sudah</option>
            <option value="belum" <?php echo e(request('status') == 'belum' ? 'selected' : ''); ?>>Belum</option>
        </select>
    </div>

    <div class="col-md-3 d-flex align-items-end">
        <button type="submit" class="btn btn-primary w-100">Filter</button>
    </div>
</form>


<!--
    <form method="GET" action="<?php echo e(route('absensi.makan')); ?>" class="mb-4">
        <label for="tanggal">Pilih Tanggal:</label>
        <input type="date" id="tanggal" name="tanggal" value="<?php echo e($tanggal); ?>" class="form-control" style="max-width: 250px; display: inline-block;" />

        <label for="status" class="ms-3">Status:</label>
        <select name="status" id="status" class="form-control" style="max-width: 150px; display: inline-block;">
            <option value="">Semua</option>
            <option value="sudah" <?php echo e(request('status') == 'sudah' ? 'selected' : ''); ?>>Sudah</option>
            <option value="belum" <?php echo e(request('status') == 'belum' ? 'selected' : ''); ?>>Belum</option>
        </select>

        <button type="submit" class="btn btn-primary ms-2">Filter</button>
    </form>
-->
    <?php if($absensis->count()): ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Karyawan</th>
                <th>Waktu</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $absensis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $absen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($absen->karyawan->nama ?? 'Tidak ditemukan'); ?></td>
                <td><?php echo e(\Carbon\Carbon::parse($absen->waktu)->format('d-m-Y H:i')); ?></td>
                <td>
                    <?php if($absen->status == 'sudah'): ?>
                        <span class="badge bg-success">Sudah</span>
                    <?php else: ?>
                        <span class="badge bg-danger">Belum</span>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <?php else: ?>
    <div class="alert alert-warning">
    Tidak ada data absensi makan untuk tanggal <strong><?php echo e(\Carbon\Carbon::parse($tanggal)->format('d-m-Y')); ?></strong>
    <?php if(request('status')): ?>
        dan status <strong><?php echo e(ucfirst(request('status'))); ?></strong>
    <?php endif; ?>
    <?php if(request('shift')): ?>
        pada <strong><?php echo e(strtoupper(str_replace('_', ' ', request('shift')))); ?></strong>.
    <?php endif; ?>
</div>

    <!--
    <div class="alert alert-warning">
        Tidak ada data absensi makan untuk tanggal <strong><?php echo e(\Carbon\Carbon::parse($tanggal)->format('d-m-Y')); ?></strong>
        <?php if(request('status')): ?>
            dan status <strong><?php echo e(ucfirst(request('status'))); ?></strong>.
        <?php endif; ?>
    </div>-->
    <?php endif; ?>
</div>


        <!--
        <div class="container">
            <h3>Data Absensi Makan</h3>
        
            <form method="GET" action="<?php echo e(route('absensi.makan')); ?>" class="mb-4">
                <label for="tanggal">Pilih Tanggal:</label>
                <input type="date" id="tanggal" name="tanggal" value="<?php echo e($tanggal); ?>" class="form-control" style="max-width: 250px; display: inline-block;" />
                <button type="submit" class="btn btn-primary">Filter</button>
            </form>
        
            <?php if($absensis->count()): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama Karyawan</th>
                        <th>Waktu</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $absensis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $absen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($absen->karyawan->nama ?? 'Tidak ditemukan'); ?></td>
                        <td><?php echo e(\Carbon\Carbon::parse($absen->waktu)->format('d-m-Y H:i')); ?></td>
                        <td>
                            <?php if($absen->status == 'sudah'): ?>
                                <span class="badge bg-success">Sudah</span>
                            <?php else: ?>
                                <span class="badge bg-danger">Belum</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <?php else: ?>
                <div class="alert alert-warning">
            Tidak ada data absensi makan untuk tanggal <strong><?php echo e(\Carbon\Carbon::parse($tanggal)->format('d-m-Y')); ?></strong>.
        </div>
        
            <?php endif; ?>
        </div>
        -->



            
            </div>
        </div>
    </main>
    <!-- Footer -->
    <footer>
        <p>&copy; <?= date("Y"); ?>  Catering Service Pabrik.</p>
    </footer>
    
</body>
</html><?php /**PATH /home/kelompo7/catering.kelompok47.my.id/resources/views/koki/monitoring.blade.php ENDPATH**/ ?>