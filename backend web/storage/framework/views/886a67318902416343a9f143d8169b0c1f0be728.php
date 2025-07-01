

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css"
    rel="stylesheet"/>
    <script src="<?php echo e(asset('js/dashboard.js')); ?>"></script>
    <link rel="stylesheet" href="<?php echo e(asset('css/hrga/create.css')); ?>">
    <title>Ganti Password</title>
</head>

<body>
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
    
     
    <!-- Main Content -->
    <main class="main-content">
        <div class="dashboard">
        <h3><i class="ri-user-add-line me-2"></i>Ganti Password</h3>
            <hr>

            <div class="row text-white">
                <div class="card mb-4">
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

                    <form method="POST" action="<?php echo e(route('password.update')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="mb-3">
                            <label>Password Lama</label>
                            <input type="password" name="current_password" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Password Baru</label>
                            <input type="password" name="new_password" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Konfirmasi Password Baru</label>
                            <input type="password" name="new_password_confirmation" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-secondary">Kembali</a>
                    </form>      
                
                    
                </div>
            </div>
            
        



        </div>
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; <?= date("Y"); ?> Catering Service Pabrik.</p>
    </footer>
    
</body>
</html><?php /**PATH /home/kelompo7/catering.kelompok47.my.id/resources/views/koki/change-password.blade.php ENDPATH**/ ?>