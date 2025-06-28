<?php
include 'config.php';

$sql = "SELECT * FROM contact_info LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->execute();
$contact = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Contact Us</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
  <!-- Custom Styles -->
  <style>
    body {
      background-color: #f9fafb;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      color: #333;
    }
    .contact-card {
      background: #ffffff;
      border-radius: 15px;
      padding: 50px 40px;
      box-shadow: 0 10px 30px rgba(201, 166, 107, 0.15);
      max-width: 600px;
      margin: auto;
      transition: box-shadow 0.3s ease;
    }
    .contact-card:hover {
      box-shadow: 0 15px 40px rgba(201, 166, 107, 0.25);
    }
    h2 {
      font-family: 'Montserrat', sans-serif;
      font-weight: 900;
      color: #4b4f7b;
      font-size: 2.8rem;
      margin-bottom: 1rem;
    }
    p.text-muted {
      font-size: 1.1rem;
      margin-bottom: 2rem;
      color: #6c757d;
    }
    p strong {
      font-weight: 600;
      font-size: 1.15rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
      color: #2c3e50;
    }
    a.contact-link {
      color: #c9a66b;
      font-weight: 600;
      text-decoration: none;
      font-size: 1.2rem;
      transition: color 0.3s ease;
    }
    a.contact-link:hover {
      color: #4b4f7b;
      text-decoration: underline;
    }
    footer {
      background: #1a1f38;
      color: #cfc6b8;
      padding: 25px 0;
      text-align: center;
      font-family: 'Roboto', sans-serif;
      font-size: 0.95rem;
      letter-spacing: 0.05em;
      user-select: none;
      border-top: 1px solid #4b4f7b;
      margin-top: 4rem;
    }
    .fa-envelope, .fa-phone {
      color: #c9a66b;
      font-size: 1.3rem;
    }
    @media (max-width: 576px) {
      .contact-card {
        padding: 30px 20px;
      }
      h2 {
        font-size: 2rem;
      }
      p strong, a.contact-link {
        font-size: 1rem;
      }
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
      <a class="navbar-brand" href="index.php"><i class="fas fa-shield-alt me-2"></i>Crime Reporting System</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse ms-auto" id="navbarNav">
        <div class="navbar-nav ms-auto">
          <a class="nav-link" href="index.php">Home</a>
          <a class="nav-link" href="report.php">Report</a>
          <a class="nav-link" href="faq.php">FAQ</a>
          <a class="nav-link active" href="contact.php">Contact</a>
          <a class="nav-link btn btn-outline-light btn-sm ms-2" href="login.php">Login</a>
        </div>
      </div>
    </div>
  </nav>

  <!-- Contact Section -->
  <section class="py-5">
    <div class="container">
      <div class="contact-card" role="region" aria-labelledby="contactTitle">
        <h2 id="contactTitle" class="text-center"><i class="fas fa-envelope me-2"></i>Contact Us</h2>
        <p class="text-center text-muted">If you need to speak to someone directly, please use the following contact information:</p>
        <hr>
        <p>
          <strong><i class="fas fa-envelope"></i>Email:</strong>
          <a href="mailto:<?php echo htmlspecialchars($contact['email']); ?>" class="contact-link" aria-label="Email address"><?php echo htmlspecialchars($contact['email']); ?></a>
        </p>
        <p>
          <strong><i class="fas fa-phone"></i>Phone:</strong>
          <a href="tel:<?php echo htmlspecialchars($contact['phone']); ?>" class="contact-link" aria-label="Phone number"><?php echo htmlspecialchars($contact['phone']); ?></a>
        </p>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer>
    <div class="container">
      <small>© 2025 Online Crime Reporting System | All rights reserved.</small>
    </div>
  </footer>

  <!-- Bootstrap Script -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
