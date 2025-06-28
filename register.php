<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Registration</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Segoe UI', sans-serif;
    }

    .register-container {
      max-width: 450px;
      background: white;
      margin: 60px auto;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    h2 {
      text-align: center;
      margin-bottom: 30px;
      font-weight: 700;
      color: #000;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
      border-radius: 8px;
      border: 1px solid #ccc;
      padding: 12px;
    }

    button[type="submit"] {
      width: 100%;
      padding: 12px;
      font-weight: 600;
      border-radius: 8px;
      background-color: #000;
      color: white;
      border: none;
      transition: background-color 0.3s ease;
    }

    button[type="submit"]:hover {
      background-color: #333;
    }

    .form-text {
      font-size: 0.9rem;
      color: #6c757d;
    }
  </style>
</head>
<body>

  <div class="register-container">
    <form method="POST" action="">
      <h2><i class="fas fa-user-plus me-2"></i>Register</h2>
      <div class="mb-3">
        <input type="text" name="username" class="form-control" placeholder="Username" required>
      </div>
      <div class="mb-3">
        <input type="email" name="email" class="form-control" placeholder="Email" required>
      </div>
      <div class="mb-3">
        <input type="password" name="password" class="form-control" placeholder="Password" required>
      </div>
      <button type="submit">Register</button>
      <p class="form-text mt-3 text-center">Already have an account? <a href="login.php">Login here</a></p>
    </form>
  </div>

</body>
</html>
