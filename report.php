<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : NULL;
    $crime_type = $_POST['crime_type'];
    $crime_date = $_POST['crime_date'];
    $crime_location = $_POST['crime_location'];
    $description = $_POST['description'];
    $suspect_details = $_POST['suspect_details'];
    $victim_name = $_POST['victim_name'];
    $victim_email = $_POST['victim_email'];
    $victim_phone = $_POST['victim_phone'];

    $sql = "INSERT INTO reports (user_id, crime_type, crime_date, crime_location, description, suspect_details, victim_name, victim_email, victim_phone) 
            VALUES (:user_id, :crime_type, :crime_date, :crime_location, :description, :suspect_details, :victim_name, :victim_email, :victim_phone)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        'user_id' => $user_id,
        'crime_type' => $crime_type,
        'crime_date' => $crime_date,
        'crime_location' => $crime_location,
        'description' => $description,
        'suspect_details' => $suspect_details,
        'victim_name' => $victim_name,
        'victim_email' => $victim_email,
        'victim_phone' => $victim_phone
    ]);

    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Report a Crime</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"/>

  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Segoe UI', sans-serif;
    }
    .form-section {
      background: white;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    footer {
      background: #212529;
      color: white;
      padding: 20px 0;
      margin-top: 50px;
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
        <a class="nav-link active" href="report.php">Report</a>
        <a class="nav-link" href="faq.php">FAQ</a>
        <a class="nav-link" href="contact.php">Contact</a>
        <a class="nav-link btn btn-outline-light btn-sm ms-2" href="login.php">Login</a>
      </div>
    </div>
  </nav>

  <!-- Form Section -->
  <section class="py-5">
    <div class="container">
      <div class="form-section">
        <h2 class="mb-4 text-center"><i class="fas fa-edit me-2"></i>Report a Crime</h2>
        <form method="POST">
          <div class="row g-3">
            <div class="col-md-6">
              <label for="crime_type" class="form-label">Crime Type</label>
              <select class="form-select" id="crime_type" name="crime_type" required>
                <option value="">-- Select Crime Type --</option>
                <option>Theft</option>
                <option>Assault</option>
                <option>Cybercrime</option>
                <option>Harassment</option>
                <option>Domestic Violence</option>
                <option>Missing Person</option>
                <option>Fraud</option>
                <option>Other</option>
              </select>
            </div>
            <div class="col-md-6">
              <label for="crime_date" class="form-label">Date of Crime</label>
              <input type="date" class="form-control" id="crime_date" name="crime_date" required>
            </div>
            <div class="col-12">
              <label for="crime_location" class="form-label">Location of Crime</label>
              <input type="text" class="form-control" id="crime_location" name="crime_location" required>
            </div>
            <div class="col-12">
              <label for="description" class="form-label">Crime Description</label>
              <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
            </div>
            <div class="col-12">
              <label for="suspect_details" class="form-label">Suspect Details (Optional)</label>
              <textarea class="form-control" id="suspect_details" name="suspect_details" rows="3"></textarea>
            </div>
            <div class="col-md-4">
              <label for="victim_name" class="form-label">Your Name</label>
              <input type="text" class="form-control" id="victim_name" name="victim_name" required>
            </div>
            <div class="col-md-4">
              <label for="victim_email" class="form-label">Your Email</label>
              <input type="email" class="form-control" id="victim_email" name="victim_email" required>
            </div>
            <div class="col-md-4">
              <label for="victim_phone" class="form-label">Your Phone Number</label>
              <input type="tel" class="form-control" id="victim_phone" name="victim_phone" required>
            </div>
          </div>
          <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary px-5"><i class="fas fa-paper-plane me-2"></i>Submit Report</button>
          </div>
        </form>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="text-center">
    <div class="container">
      <small>&copy; 2025 Online Crime Reporting System | All rights reserved.</small>
    </div>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
