<?php
include 'config.php';
$sql = "SELECT * FROM home_content LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->execute();
$home = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Crime Reporting System</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
  <!-- AOS Animations -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet" />

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Roboto&display=swap" rel="stylesheet" />

  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background-color: #faf9f6;
      color: #333;
      scroll-behavior: smooth;
      overflow-x: hidden;
    }

    /* Navbar */
    .navbar {
      background: linear-gradient(90deg, #1a1f3b 0%, #4b4f7b 100%);
      box-shadow: 0 4px 12px rgba(26, 31, 59, 0.7);
      font-family: 'Montserrat', sans-serif;
      font-weight: 700;
    }
    .navbar-brand, .nav-link {
      color: #e6d9b8 !important; /* soft gold */
      transition: color 0.3s ease;
    }
    .nav-link:hover, .nav-link.active {
      color: #c9a66b !important;
      text-shadow: 0 0 8px #c9a66b;
    }
    .btn-outline-light {
      border-color: #c9a66b;
      color: #c9a66b;
      font-weight: 600;
      transition: all 0.3s ease;
    }
    .btn-outline-light:hover {
      background-color: #c9a66b;
      color: #1a1f3b;
      border-color: #c9a66b;
      box-shadow: 0 0 15px #c9a66b;
      transform: scale(1.05);
    }

    /* Hero Section */
    .hero {
      background: url('banner.jpg') no-repeat center center/cover;
      position: relative;
      color: #f4f1ea;
      padding: 140px 20px 120px;
      text-align: center;
      overflow: hidden;
      border-radius: 0 0 80px 80px;
    }
    .hero::before {
      content: "";
      position: absolute;
      inset: 0;
      background: linear-gradient(135deg, rgba(26,31,59,0.85), rgba(75,79,123,0.85));
      z-index: 0;
      border-radius: 0 0 80px 80px;
    }
    .hero .content {
      position: relative;
      z-index: 1;
      max-width: 900px;
      margin: 0 auto;
    }
    .hero h1 {
      font-family: 'Montserrat', sans-serif;
      font-weight: 900;
      font-size: 3.5rem;
      text-shadow: 0 0 12px rgba(0, 0, 0, 0.7);
      margin-bottom: 1rem;
      line-height: 1.1;
      color: #f4f1ea;
    }
    .hero p.lead {
      font-size: 1.3rem;
      font-weight: 500;
      margin-bottom: 2rem;
      text-shadow: 0 0 8px rgba(0, 0, 0, 0.5);
      color: #e6d9b8;
    }
    .btn-action {
      border-radius: 50px;
      font-weight: 700;
      padding: 14px 32px;
      box-shadow: 0 6px 20px rgba(201, 166, 107, 0.3);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      font-size: 1.1rem;
      color: #1a1f3b;
    }
    .btn-action:hover {
      transform: scale(1.1);
      box-shadow: 0 10px 30px rgba(201, 166, 107, 0.7);
    }
    .btn-light.text-primary {
      background: #f8f5f0;
      border: none;
      color: #4b4f7b !important;
    }
    .btn-warning {
      background: #c9a66b;
      border: none;
      color: #1a1f3b;
      font-weight: 700;
    }

    /* What You Can Do Section */
    section.py-5.bg-white {
      padding-top: 6rem !important;
      padding-bottom: 6rem !important;
      background: #f8f7f1;
    }
    h2.text-center {
      font-family: 'Montserrat', sans-serif;
      font-weight: 900;
      color: #4b4f7b;
      font-size: 2.75rem;
      margin-bottom: 3rem;
      text-shadow: 0 0 8px rgba(75, 79, 123, 0.4);
    }
    .action-box {
      border-radius: 16px;
      padding: 35px 25px;
      background: #fffdfa;
      box-shadow: 0 12px 30px rgba(201, 166, 107, 0.1);
      transition: transform 0.4s ease, box-shadow 0.4s ease;
      cursor: default;
      height: 100%;
    }
    .action-box:hover {
      transform: translateY(-10px) scale(1.05);
      box-shadow: 0 25px 40px rgba(201, 166, 107, 0.25);
    }
    .action-box i {
      font-size: 3.2rem;
      margin-bottom: 15px;
      color: #c9a66b;
      transition: color 0.3s ease;
    }
    .action-box:hover i {
      color: #4b4f7b;
    }
    .action-box h5 {
      font-family: 'Montserrat', sans-serif;
      font-weight: 700;
      font-size: 1.4rem;
      margin-bottom: 12px;
      color: #3a3a3a;
    }
    .action-box p {
      font-size: 1rem;
      color: #555;
      line-height: 1.5;
    }

    /* Awareness Section */
    section.py-5.bg-light {
      background: #f2f1eb;
      padding-top: 5rem !important;
      padding-bottom: 5rem !important;
    }
    section.py-5.bg-light h3.text-center {
      font-family: 'Montserrat', sans-serif;
      font-weight: 800;
      font-size: 2.4rem;
      margin-bottom: 3rem;
      color: #4b4f7b;
      text-shadow: 0 0 8px rgba(75, 79, 123, 0.3);
    }
    .card {
      border-radius: 18px;
      overflow: hidden;
      box-shadow: 0 12px 35px rgba(201, 166, 107, 0.15);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      cursor: pointer;
      background: #fffdfa;
    }
    .card:hover {
      transform: translateY(-10px);
      box-shadow: 0 25px 45px rgba(201, 166, 107, 0.3);
    }
    .card-img-top {
      height: 220px;
      object-fit: cover;
      transition: transform 0.5s ease;
    }
    .card:hover .card-img-top {
      transform: scale(1.1);
    }
    .card-body p {
      font-size: 1rem;
      color: #444;
      font-weight: 500;
      padding: 1rem 1.5rem 2rem;
    }

    /* Footer */
    footer {
      background-color: #1a1f38;
      color: #cfc6b8;
      text-align: center;
      padding: 25px 0;
      font-weight: 400;
      font-size: 0.9rem;
      letter-spacing: 0.05em;
      border-top: 1px solid #4b4f7b;
      user-select: none;
      font-family: 'Roboto', sans-serif;
    }

    /* Responsive adjustments */
    @media (max-width: 767px) {
      .hero h1 {
        font-size: 2.3rem;
      }
      .action-box i {
        font-size: 2.5rem;
      }
      h2.text-center {
        font-size: 2.2rem;
      }
      section.py-5.bg-light h3.text-center {
        font-size: 2rem;
      }
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="#"><i class="fas fa-shield-alt me-2"></i>Crime Reporting System</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <div class="navbar-nav">
        <a class="nav-link active" href="index.php">Home</a>
        <a class="nav-link" href="report.php">Report</a>
        <a class="nav-link" href="faq.php">FAQ</a>
        <a class="nav-link" href="contact.php">Contact</a>
        <a class="nav-link btn btn-outline-light btn-sm ms-3" href="login.php">Login</a>
      </div>
    </div>
  </div>
</nav>

<!-- Hero Section -->
<section class="hero">
  <div class="container content" data-aos="fade-up" data-aos-duration="1200" data-aos-easing="ease-in-out">
    <h1><?php echo htmlspecialchars($home['welcome_message']); ?></h1>
    <p class="lead"><?php echo htmlspecialchars($home['description']); ?></p>
    <div class="d-flex justify-content-center gap-4 flex-wrap mt-4" data-aos="zoom-in" data-aos-delay="400">
      <a href="report.php" class="btn btn-light text-primary btn-action px-5"><i class="fas fa-edit me-2"></i>Report a Crime</a>
      <a href="login.php" class="btn btn-outline-light btn-action px-5"><i class="fas fa-user-shield me-2"></i>Admin Login</a>
      <!-- Track Case button removed as requested -->
    </div>
  </div>
</section>

<!-- What You Can Do -->
<section class="py-5 bg-white">
  <div class="container">
    <h2 class="text-center" data-aos="fade-up">What You Can Do</h2>
    <div class="row g-4">
      <div class="col-md-4" data-aos="fade-up" data-aos-delay="150">
        <div class="action-box text-center shadow-sm h-100">
          <i class="fas fa-file-alt"></i>
          <h5>File Crime Report</h5>
          <p>Securely report crimes online with full details and evidence attachments.</p>
        </div>
      </div>
      <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
        <div class="action-box text-center shadow-sm h-100">
          <i class="fas fa-clock"></i>
          <h5>Get Quick Response</h5>
          <p>Your reports are reviewed quickly by officials and forwarded accordingly.</p>
        </div>
      </div>
      <div class="col-md-4" data-aos="fade-up" data-aos-delay="450">
        <div class="action-box text-center shadow-sm h-100">
          <i class="fas fa-lock"></i>
          <h5>Privacy & Transparency</h5>
          <p>Your data is confidential and handled with strict security standards.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Awareness Section -->
<section class="py-5 bg-light">
  <div class="container">
    <h3 class="text-center" data-aos="fade-right">Crime Awareness & Community Safety</h3>
    <div class="row g-4 mt-4">
      <div class="col-md-4" data-aos="flip-left" data-aos-delay="150">
        <div class="card h-100 shadow-sm">
          <img src="prevent.JFIF" class="card-img-top" alt="Crime Prevention" />
          <div class="card-body">
            <p>Always stay alert in public places and report unusual behavior quickly.</p>
          </div>
        </div>
      </div>
    <div class="col-md-4" data-aos="flip-up" data-aos-delay="300">
  <div class="card h-100 shadow-sm">
    <img src="SUPPORT.jfif" class="card-img-top" alt="Police Support" />
    <div class="card-body">
      <p>Our cyber and local crime branches are ready to assist you 24x7.</p>
          </div>
        </div>
      </div>
<div class="col-md-4" data-aos="flip-left" data-aos-delay="150">
  <div class="card h-100 shadow-sm">
    <img src="custom.jfif" class="card-img-top" alt="Crime Prevention" />
    <div class="card-body">
      <p>Always stay alert in public places and report unusual behavior quickly.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Footer -->
<footer>
  <div class="container">
    <small>© 2025 Online Crime Reporting System | Designed by Neha Vishwakarma</small>
  </div>
</footer>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
  AOS.init({
    once: true,
    duration: 1000,
    easing: 'ease-in-out',
  });
</script>
</body>
</html>
