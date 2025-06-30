

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
        <h3><i class="ri-user-add-line me-2"></i>TAMBAH KARYAWAN</h3>
            <hr>

            <div class="row text-white">
                <div class="card mb-4">
                                
                
                    <form method="POST" action="{{ route('user.store') }} "enctype="multipart/form-data">
                        @csrf
                        <label for="nama">Nama : </label>
                        <input type="text" id="nama" name="nama" class="form-control" required placeholder="input nama" title="Nama lengkap" autocomplete="name">

                        <label for="username">Username : </label>
                        <input type="text" id="username" name="username" class="form-control" required placeholder="input username" title="Username" autocomplete="username">

                        <label for="email">Email : </label>
                        <input type="email" id="email" name="email" class="form-control" required placeholder="input email" title="Alamat email" autocomplete="email">

                        <label for="email">Password : </label>
                        <input type="password" id="password" name="password" class="form-control" required placeholder="input password" title="password" autocomplete="password">


                        <label for="role">Role : </label>
                        <select id="role" name="role" required >
                            <option value="karyawan">Karyawan</option>
                            <option value="koki">Koki</option>
                            <option value="hrga">HRGA</option>
                            
                        </select><br><br>


                        <label for="tanggal_masuk">Tanggal Masuk : </label>
                        <input type="date" id="tanggal_masuk"  name="tanggal_masuk" class="form-control" title="Tanggal mulai bekerja" autocomplete="on">

                        <label for="foto">Foto : </label>
                        <input type="file" id="foto" name="foto" class="form-control" accept="image/*" required>

                        
                        
                        <input type="submit" value="simpan" name="submit" class="btn btn-outline-primary">
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
