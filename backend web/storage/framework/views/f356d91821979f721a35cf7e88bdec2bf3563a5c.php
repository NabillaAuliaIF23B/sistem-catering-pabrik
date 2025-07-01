<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login - PT Catering Days</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <style>
    body {
      background-color: #e0dfe6;
      font-family: 'Poppins', sans-serif;
    }
    #header {
      background-color: #3880ff;
      border-radius: 0 0 20px 20px;
      color: #fff;
      padding: 80px 20px 100px;
      text-align: center;
      margin-bottom: 10px; 
    }
    #logo {
      width: 70px;
      height: 70px;
      background-color: #fff;
      border-radius: 10px;
      margin: 0 auto -30px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 20px; 
      
    }
    #logo img {
      width: 70%;
    }
    .pt {
      font-size: 25px;
      margin-bottom: 4px;
    }
    .login-card {
      max-width: 400px;
      margin: 0 auto;
      margin-top: -60px;
      background-color: #fff;
      padding: 20px;
      border-radius: 20px;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    .btn-primary {
      background-color: #3880ff;
      border: none;
    }
    h1 {
        font-family: poppins;
        size: 12px;

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

</body>
</html>
<?php /**PATH D:\kuliah\Semester 4\Final Project\Catering_Service_Pabrik\laravel\resources\views/auth/login.blade.php ENDPATH**/ ?>