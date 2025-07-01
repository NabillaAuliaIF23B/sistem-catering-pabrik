<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login - PT Catering Days</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <style>
    * {
      box-sizing: border-box;
    }
    
.content-wrapper {
  flex: 1;
  display: flex;
  justify-content: center;
  align-items: flex-start;
  padding: 20px;
  margin-top: -30px; /* Ini bikin form naik sedikit ke kotak biru */
}


@media (min-width: 577px) {
  .content-wrapper {
    margin-top: -30px;
  }
}

    body, html {
      margin: 0;
      padding: 0;
      height: 100%;
      font-family: 'Poppins', sans-serif;
      background-color: #e0dfe6;
      display: flex;
      flex-direction: column;
    }

    #header {
      background-color: #3880ff;
      border-radius: 0 0 20px 20px;
      color: #fff;
      padding: 40px 20px 60px;
      text-align: center;
    }

    #logo {
      width: 70px;
      height: 70px;
      background-color: #fff;
      border-radius: 10px;
      margin: 0 auto 15px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    #logo img {
      width: 70%;
    }

    .pt {
      font-size: 22px;
      margin-bottom: 4px;
      font-weight: 600;
    }

    h1 {
      font-size: 20px;
      margin: 0;
      font-weight: 500;
    }



    .login-card {
      background-color: #fff;
      padding: 25px 20px;
      border-radius: 20px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 400px;
    }

    .btn-primary {
      background-color: #3880ff;
      border: none;
    }

    .btn-primary:hover {
      background-color: #296ad8;
    }

    @media (max-width: 576px) {
      #header {
        padding: 30px 10px 40px;
      }

      #logo {
        width: 60px;
        height: 60px;
      }

      .pt {
        font-size: 20px;
      }

      h1 {
        font-size: 18px;
      }

      .login-card {
        padding: 20px 15px;
      }
    }
  </style>
</head>
<body>

  <div id="header">
    <div id="logo">
      <img src="<?php echo e(asset('assets/logo.png')); ?>" alt="Logo">
    </div>
    <h1 class="pt">PT Catering Days</h1>
    <h1>Sign In</h1>
  </div>

  <div class="content-wrapper">
    <div class="login-card">
      <?php if(session('error')): ?>
        <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
      <?php endif; ?>
      <form method="POST" action="<?php echo e(route('login')); ?>">
        <?php echo csrf_field(); ?>
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Login</button>
      </form>
    </div>
  </div>

</body>
</html>
<?php /**PATH /home/kelompo7/catering.kelompok47.my.id/resources/views/auth/login.blade.php ENDPATH**/ ?>