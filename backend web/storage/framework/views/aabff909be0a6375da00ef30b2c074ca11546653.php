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

    <link rel="stylesheet" href="<?php echo e(asset('css/koki/verifikasi.css')); ?>">
    <script src="<?php echo e(asset('js/dashboard.js')); ?>"></script>


    <title>Verifikasi Pesanan</title>
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
            <h3><i class="ri-line-chart-line icon "></i>Verifikasi Pesanan</h3> <hr>
            <div class="row">
            <div class="container-fluid">
            
        </div>
        
        <div class="container">

    
             <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>ID Pesanan</th>
            <th >Tanggal</th>
            <th>Shift</th>
            <th>Jumlah</th>
            <th>Status</th>
            <th>Catatan</th>
            <th>Waktu Verifikasi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $verifikasi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($v->id); ?></td>
                <td><?php echo e($v->pesanan_id); ?></td>
                <td><?php echo e($v->pesanan->tanggal ?? '-'); ?></td>
                <td><?php echo e($v->pesanan->shift ?? '-'); ?></td>
                <td><?php echo e($v->pesanan->jumlah_pesanan ?? '-'); ?></td>
                <td><?php echo e(ucfirst($v->status)); ?></td>
                <td><?php echo e($v->catatan ?? '-'); ?></td>
                <td><?php echo e($v->waktu_verifikasi ?? '-'); ?></td>
                <td>
                    <a href="<?php echo e(route('verifikasi.edit', $v->id)); ?>" class="btn btn-warning btn-sm">Ubah Status</a>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

        </div>
    </main>
    <br> <br>
    <!-- Footer -->
    <footer>
        <p>&copy; <?= date("Y"); ?>  Catering Service Pabrik.</p>
    </footer>
    
</body>
</html><?php /**PATH /home/kelompo7/catering.kelompok47.my.id/resources/views/koki/verifikasi.blade.php ENDPATH**/ ?>