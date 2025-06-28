<?php
session_start();
include 'config.php';

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Redirect admin
if ($_SESSION['role'] === 'admin') {
    header("Location: admin_dashboard.php");
    exit();
}

// Fetch user info
$user_id = $_SESSION['user_id'];
$sql = "SELECT username, email FROM users WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->execute(['id' => $user_id]);
$user = $stmt->fetch();

// Fetch user reports
$sql = "SELECT * FROM reports WHERE user_id = :user_id ORDER BY created_at DESC";
$stmt = $conn->prepare($sql);
$stmt->execute(['user_id' => $user_id]);
$reports = $stmt->fetchAll();

// Handle new report
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_report'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $location = $_POST['location'];

    $sql = "INSERT INTO reports (user_id, title, description, location) VALUES (:user_id, :title, :description, :location)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        'user_id' => $user_id,
        'title' => $title,
        'description' => $description,
        'location' => $location
    ]);

    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>User Dashboard</title>

  <!-- Bootstrap & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"/>

  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Segoe UI', sans-serif;
    }

    .card {
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    footer {
      background-color: #212529;
      color: white;
      text-align: center;
      padding: 15px 0;
      margin-top: 50px;
    }

    textarea {
      resize: vertical;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="index.php"><i class="fas fa-shield-alt me-2"></i>Crime Reporting System</a>
    <div class="navbar-nav ms-auto">
      <a class="nav-link active" href="dashboard.php">Dashboard</a>
      <a class="nav-link" href="report.php">Report</a>
      <a class="nav-link" href="logout.php">Logout</a>
    </div>
  </div>
</nav>

<!-- Main Container -->
<div class="container py-5">
  <h2 class="mb-4 text-center"><i class="fas fa-user-circle me-2"></i>Welcome, <?php echo htmlspecialchars($user['username']); ?></h2>

  <!-- Profile Section -->
  <div class="row mb-5">
    <div class="col-md-6">
      <div class="card p-4">
        <h4 class="mb-3"><i class="fas fa-user me-2"></i>Your Profile</h4>
        <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
      </div>
    </div>

    <!-- New Report Form -->
    <div class="col-md-6">
      <div class="card p-4">
        <h4 class="mb-3"><i class="fas fa-edit me-2"></i>Submit New Report</h4>
        <form method="POST">
          <div class="mb-3">
            <input type="text" name="title" class="form-control" placeholder="Report Title" required>
          </div>
          <div class="mb-3">
            <textarea name="description" class="form-control" placeholder="Description" rows="4" required></textarea>
          </div>
          <div class="mb-3">
            <input type="text" name="location" class="form-control" placeholder="Location" required>
          </div>
          <button type="submit" name="submit_report" class="btn btn-primary w-100">
            <i class="fas fa-paper-plane me-1"></i> Submit Report
          </button>
        </form>
      </div>
    </div>
  </div>

  <!-- Report History -->
  <div class="card p-4">
    <h4 class="mb-3"><i class="fas fa-history me-2"></i>Your Reports</h4>
    <?php if (empty($reports)): ?>
      <div class="alert alert-warning">You haven't submitted any reports yet.</div>
    <?php else: ?>
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead class="table-dark">
            <tr>
              <th>ID</th>
              <th>Title</th>
              <th>Location</th>
              <th>Status</th>
              <th>Submitted</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($reports as $report): ?>
              <tr>
                <td><?php echo $report['id']; ?></td>
                <td><?php echo htmlspecialchars($report['title']); ?></td>
                <td><?php echo htmlspecialchars($report['location']); ?></td>
                <td><span class="badge bg-<?php echo $report['status'] === 'closed' ? 'success' : 'warning'; ?>">
                  <?php echo ucfirst($report['status']); ?>
                </span></td>
                <td><?php echo date('d M Y', strtotime($report['created_at'])); ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php endif; ?>
  </div>
</div>

<!-- Footer -->
<footer>
  <div class="container">
    <small>&copy; 2025 Online Crime Reporting System | All rights reserved.</small>
  </div>
</footer>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
