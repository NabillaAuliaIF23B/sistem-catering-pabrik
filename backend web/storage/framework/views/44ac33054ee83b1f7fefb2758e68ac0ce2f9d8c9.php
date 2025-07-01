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
                    <a href="<?php echo e(route('dashboard')); ?>">
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
                    <a href="<?php echo e(route('user.index')); ?>">
                        <i class="ri-group-line icon"></i>
                        <span class="text nav-text">User</span>
                    </a>
                </li>
                
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
            <h3><i class="ri-group-line icon"></i>DATA KARYAWAN</h3> <hr>
            <div class="row">
            <div class="container-fluid">
            
        </div>
        <div style="max-width: 250px;">
            <form method="GET" action="<?php echo e(route('user.index')); ?>" class="d-flex mb-3" role="search">
                <input class="form-control me-2" type="search" name="search" value="<?php echo e($search); ?>" placeholder="Cari user..." aria-label="Search"/>
                <button class="btn btn-outline-primary" type="submit">Search</button>
            </form>
        </div>
        <a href="<?php echo e(route('user.create')); ?>" class="btn btn-success mb-3">+ Buat Akun Baru</a>
        <br>
        <br>
            <table class="table table-bordered">
                <thead>
                    
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Opsi</th>

                </thead>
                <tbody>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        
                        <td><?php echo e($user->nama); ?></td>
                        <td><?php echo e($user->email); ?></td>
                        <td><?php echo e($user->username); ?></td>
                        <td><?php echo e($user->role); ?></td>
                        <td>
                            <a href="<?php echo e(route('user.edit', $user->id_karyawan)); ?>" class="btn btn-outline-primary">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>

                            <form action="<?php echo e(route('user.destroy', $user->id_karyawan)); ?>" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus user ini?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-outline-primary">
                                    <i class="bi bi-trash"></i> Edit
                                </button>
                            </form>

                            <form action="<?php echo e(route('user.toggleStatus', $user->id_karyawan)); ?>" method="POST" style="display:inline-block;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PATCH'); ?>
                                <button type="submit" class="btn btn-sm btn-info">
                                    <?php if($user->status == 'aktif'): ?>
                                        Nonaktifkan
                                    <?php else: ?>
                                        Aktifkan
                                    <?php endif; ?>
                                </button>
                            </form>
                            
                        </td>
                    </tr>  
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
                </tbody>
            </table>

            </div>
        </div>
    </main>
    <!-- Footer -->
    <footer>
        <p>&copy; <?= date("Y"); ?>  Catering Service Pabrik.</p>
    </footer>
    
</body>
</html><?php /**PATH D:\kuliah\Semester 4\Final Project\Catering_Service_Pabrik\laravel\resources\views/hrga/user.blade.php ENDPATH**/ ?>