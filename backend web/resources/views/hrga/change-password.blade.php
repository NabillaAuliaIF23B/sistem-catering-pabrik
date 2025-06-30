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
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/hrga/create.css') }}">
    <title>Tambah Karyawan</title>
</head>

<body>
    <nav class="sidebar close">
        <header class="image-text">
            <span class="image">
                <img src="{{ asset('assets/logo.png') }}" alt="Logo">
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
                        <a href="{{ route('dashboard') }}">
                            <i class="ri-dashboard-line icon"></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="{{ route('profile') }}">
                            <i class="ri-user-3-line icon"></i>
                            <span class="text nav-text">Profile</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="{{ route('user.index') }}">
                            <i class="ri-group-line icon"></i>
                            <span class="text nav-text">User</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="buttom-content">
                <ul>
                    <li class="nav-link">
                        <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="ri-logout-box-line icon"></i>
                            <span class="text nav-text">Logout</span>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
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
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
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
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Kembali</a>
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
</html>
