<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch();
    
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        
        if ($user['role'] === 'admin') {
            header("Location: admin_dashboard.php");
        } else {
            header("Location: dashboard.php");
        }
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login</title>

  <!-- Bootstrap & Font Awesome -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"/>

  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Segoe UI', sans-serif;
    }

    .login-card {
      max-width: 400px;
      margin: 80px auto;
      padding: 30px;
      border-radius: 10px;
      background-color: #ffffff;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }

    footer {
      background-color: #212529;
      color: white;
      padding: 20px 0;
      text-align: center;
      margin-top: 50px;
    }

    .form-label i {
      margin-right: 6px;
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
      <a class="navbar-brand" href="index.php"><i class="fas fa-shield-alt me-2"></i>Crime Reporting System</a>
      <div class="navbar-nav ms-auto">
        <a class="nav-link" href="index.php">Home</a>
        <a class="nav-link" href="report.php">Report</a>
        <a class="nav-link" href="faq.php">FAQ</a>
        <a class="nav-link" href="contact.php">Contact</a>
        <a class="nav-link active" href="login.php">Login</a>
      </div>
    </div>
  </nav>

  <!-- Login Form -->
  <div class="login-card">
    <h3 class="text-center mb-4"><i class="fas fa-user-lock me-2"></i>User Login</h3>
    <form method="POST">
      <div class="mb-3">
        <label for="username" class="form-label"><i class="fas fa-user"></i> Username</label>
        <input type="text" class="form-control" id="username" name="username" required />
      </div>
      <div class="mb-3">
        <label for="password" class="form-label"><i class="fas fa-lock"></i> Password</label>
        <input type="password" class="form-control" id="password" name="password" required />
      </div>
      <?php if (isset($error)): ?>
        <div class="alert alert-danger py-2"><?php echo $error; ?></div>
      <?php endif; ?>
      <div class="d-grid">
        <button type="submit" class="btn btn-primary"><i class="fas fa-sign-in-alt me-1"></i> Login</button>
      </div>
    </form>
    <div class="mt-3 text-center">
      <small>Don't have an account? <a href="register.php">Register here</a></small>
    </div>
  </div>

  <!-- Footer -->
  <footer>
    <div class="container">
      <small>&copy; 2025 Online Crime Reporting System | All rights reserved.</small>
    </div>
  </footer>

  <!-- Bootstrap Script -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
