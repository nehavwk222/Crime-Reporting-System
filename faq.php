<?php
include 'config.php';

$sql = "SELECT * FROM faqs";
$stmt = $conn->prepare($sql);
$stmt->execute();
$faqs = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>FAQs - Crime Reporting System</title>

  <!-- Bootstrap & FontAwesome -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"/>
  <!-- AOS (for animations) -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet"/>

  <style>
    body {
      background-color: #fff;
      font-family: 'Segoe UI', sans-serif;
      color: #000;
      margin: 0;
    }

    .navbar {
      background-color: #000;
    }

    .navbar-brand,
    .nav-link {
      color: #fff !important;
      font-weight: 500;
    }

    .nav-link.active,
    .nav-link:hover {
      text-decoration: underline;
    }

    .faq-section {
      background: #fff;
      border-radius: 12px;
      padding: 40px;
      max-width: 900px;
      margin: 60px auto;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    h2 {
      font-weight: 700;
      color: #000;
      margin-bottom: 30px;
      text-align: center;
    }

    .accordion-button {
      background-color: #f9f9f9;
      font-weight: 600;
      transition: all 0.3s ease;
      border-radius: 8px;
      color: #000;
    }

    .accordion-button:not(.collapsed) {
      background-color: #000;
      color: #fff;
    }

    .accordion-body {
      background-color: #fff;
      color: #000;
      border-radius: 0 0 8px 8px;
      padding: 20px;
    }

    footer {
      background-color: #000;
      color: #fff;
      padding: 20px 0;
      text-align: center;
      margin-top: 60px;
    }

    @media (max-width: 576px) {
      .faq-section {
        padding: 25px 20px;
        margin: 30px 15px;
      }
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container">
    <a class="navbar-brand" href="index.php"><i class="fas fa-shield-alt me-2"></i>Crime Reporting System</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse ms-auto" id="navbarNav">
      <div class="navbar-nav ms-auto">
        <a class="nav-link" href="index.php">Home</a>
        <a class="nav-link" href="report.php">Report</a>
        <a class="nav-link active" href="faq.php">FAQ</a>
        <a class="nav-link" href="contact.php">Contact</a>
        <a class="nav-link btn btn-outline-light btn-sm ms-2" href="login.php">Login</a>
      </div>
    </div>
  </div>
</nav>

<!-- FAQ Section -->
<section class="faq-section" role="region" aria-labelledby="faqTitle">
  <h2 id="faqTitle"><i class="fas fa-question-circle me-2"></i>Frequently Asked Questions</h2>
  <div class="accordion" id="faqAccordion">
    <?php foreach ($faqs as $index => $faq): ?>
      <div class="accordion-item mb-3" data-aos="fade-up" data-aos-delay="<?= $index * 100 ?>">
        <h2 class="accordion-header" id="heading<?= $index ?>">
          <button class="accordion-button <?= $index > 0 ? 'collapsed' : '' ?>" type="button"
            data-bs-toggle="collapse" data-bs-target="#collapse<?= $index ?>"
            aria-expanded="<?= $index === 0 ? 'true' : 'false' ?>"
            aria-controls="collapse<?= $index ?>">
            <?= htmlspecialchars($faq['question']) ?>
          </button>
        </h2>
        <div id="collapse<?= $index ?>" class="accordion-collapse collapse <?= $index === 0 ? 'show' : '' ?>"
          aria-labelledby="heading<?= $index ?>" data-bs-parent="#faqAccordion">
          <div class="accordion-body">
            <?= nl2br(htmlspecialchars($faq['answer'])) ?>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<!-- Footer -->
<footer>
  <div class="container">
    <small>© 2025 Online Crime Reporting System | All rights reserved.</small>
  </div>
</footer>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>AOS.init();</script>
</body>
</html>
