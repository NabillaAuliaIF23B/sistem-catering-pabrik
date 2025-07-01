<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet"/>
    
    <link rel="stylesheet" href="<?php echo e(asset('css/hrga/profilehrga.css')); ?>">
    <script src="<?php echo e(asset('js/dashboard.js')); ?>"></script>
    <title>PROFILE</title>
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

    <!-- Konten Utama -->
    <main class="main-content">
        <div class="dashboard">
            <h3><i class="ri-user-3-line icon"></i> PROFILE</h3><hr>
            <div class="container profile-container">
                <div class="profile-container">
                    <div class="profile-info">
                        <p><strong>Nama:</strong> <?php echo e($user->nama); ?></p>
                        <p class="email-text"><strong>Email:</strong> <?php echo e($user->email); ?></p>
                        <p><strong>Role:</strong> <?php echo e($user->role); ?></p>
                    </div>
                    <div class="profile-image">
                        <img src="<?php echo e(asset('fotos/' . $user->foto)); ?>" alt="Gambar Profil" class="img-fluid rounded-circle">

                    </div>
                </div>
            </div>
            <a href="editprofile.php" class="btn btn-outline-primary">Edit Profile</a>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; <?= date("Y"); ?> Rir Outdoor.</p>
    </footer>
</body>
</html>
<?php /**PATH D:\kuliah\Semester 4\Final Project\Catering_Service_Pabrik\laravel\resources\views/hrga/profile.blade.php ENDPATH**/ ?>