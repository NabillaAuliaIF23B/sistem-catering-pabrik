<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css"
    rel="stylesheet"
/>
    <link rel="stylesheet" href="<?php echo e(asset('css/hrga/edit-user.css')); ?>">
    <script src="<?php echo e(asset('js/dashboard.js')); ?>"></script>
    <title>EDIT PROFILE</title>
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
                <span class="name">Rir Outdoor</span>
                <span class="namee">Karawang </span>
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
            <h3><i class="ri-user-3-line icon"></i>PROFILE</h3><hr>

            <form method="POST" action="<?php echo e(route('user.update', $user->id_karyawan)); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                
                <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <label>Nama :</label>
                <input type="text" name="nama" value="<?php echo e(old('nama', $user->nama)); ?>" required><br><br>

                <label>Username :</label>
                <input type="text" name="username" value="<?php echo e(old('username', $user->username)); ?>" required><br><br>

                <label>Email :</label>
                <input type="email" name="email" value="<?php echo e(old('email', $user->email)); ?>" required><br><br>

                <label>Role :</label>
                <select name="role" required>
                    <option value="karyawan" <?php echo e($user->role == 'karyawan' ? 'selected' : ''); ?>>karyawan</option>
                    <option value="koki" <?php echo e($user->role == 'koki' ? 'selected' : ''); ?>>koki</option>
                    <option value="hrga" <?php echo e($user->role == 'hrga' ? 'selected' : ''); ?>>hrga</option>
                </select><br><br>

                <label>Tanggal Masuk :</label>
                <input type="date" name="tanggal_masuk" value="<?php echo e(old('tanggal_masuk', $user->tanggal_masuk)); ?>" required><br><br>

                <label>Password (kosongkan jika tidak ingin mengubah):</label>
                <input type="password" name="password"><br><br>

                <label>Foto (kosongkan jika tidak ingin mengubah foto):</label><br>
                <?php if($user->foto): ?>
                    <img src="<?php echo e(asset('fotos/' . $user->foto)); ?>" alt="Foto" style="width: 100px; height: auto;"><br><br>
                <?php endif; ?>
                <input type="file" name="foto"><br><br>

                <button type="submit" class="btn btn-outline-primary">Update</button>
                <div class="text-center">
                    <a href="<?php echo e(route('user.index')); ?>" class="btn btn-outline-primary">Kembali ke data Profil</a>
                </div>
            </form>

        </div>
        <br>
    </main>
    <br><br>
    <!-- Footer -->
    <footer>
        <p>&copy; <?= date("Y"); ?> Rir Outdoor.</p>
    </footer>
</body>
</html>
<?php /**PATH /home/kelompo7/catering.kelompok47.my.id/resources/views/hrga/edit-user.blade.php ENDPATH**/ ?>