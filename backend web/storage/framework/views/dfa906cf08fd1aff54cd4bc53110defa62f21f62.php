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


    <title>Data Karyawan</title>
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
                        <a href="<?php echo e(route('verifikasi.index')); ?>">
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
            <h3><i class="ri-line-chart-line icon"></i>Ubah Status Verifikasi #<?php echo e($verifikasi->id); ?></h3> <hr>
            <div class="row">
            <div class="container-fluid">
            
        </div>
        
        <div class="container">

            
        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        
        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('verifikasi.update', $verifikasi->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" class="form-control" required>
                    <option value="menunggu" <?php echo e($verifikasi->status == 'menunggu' ? 'selected' : ''); ?>>Menunggu</option>
                    <option value="disetujui" <?php echo e($verifikasi->status == 'disetujui' ? 'selected' : ''); ?>>Disetujui</option>
                    <option value="ditolak" <?php echo e($verifikasi->status == 'ditolak' ? 'selected' : ''); ?>>Ditolak</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="catatan" class="form-label">Catatan</label>
                <textarea name="catatan" class="form-control"><?php echo e($verifikasi->catatan); ?></textarea>
            </div>
            
            <div class="mb-3">
                <label for="verifikator" class="form-label">Verifikator</label>
                <input type="text" readonly class="form-control" value="<?php echo e(Auth::user()->nama); ?>">

            </div>


            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="<?php echo e(route('verifikasi.index')); ?>" class="btn btn-secondary">Kembali</a>
        </form>
            
        </div>
    </main>
    <!-- Footer -->
    <footer>
        <p>&copy; <?= date("Y"); ?>  Catering Service Pabrik.</p>
    </footer>
    
</body>
</html><?php /**PATH /home/kelompo7/catering.kelompok47.my.id/resources/views/koki/verifikasiedit.blade.php ENDPATH**/ ?>