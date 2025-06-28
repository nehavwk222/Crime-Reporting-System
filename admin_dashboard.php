<?php
session_start();
include 'config.php';

// Restrict access to admins only
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Fetch statistics
$total_reports_stmt = $conn->query("SELECT COUNT(*) as total FROM reports");
$total_reports = $total_reports_stmt->fetch()['total'];

$pending_reports_stmt = $conn->query("SELECT COUNT(*) as pending FROM reports WHERE status = 'pending'");
$pending_reports = $pending_reports_stmt->fetch()['pending'];

$users_stmt = $conn->query("SELECT COUNT(*) as users FROM users");
$total_users = $users_stmt->fetch()['users'];

$faqs_stmt = $conn->query("SELECT COUNT(*) as faqs FROM faqs");
$total_faqs = $faqs_stmt->fetch()['faqs'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Admin Dashboard</h1>
    </header>

    <nav>
        <a href="index.php">Home</a>
        <a href="report.php">Report a Crime</a>
        <a href="faq.php">FAQ</a>
        <a href="contact.php">Contact Us</a>
        <a href="logout.php">Logout</a>
    </nav>

    <div class="container">
        <h2>Welcome, Admin!</h2>
        <div class="dashboard-stats">
            <div class="stat-card">
                <h3>Total Reports</h3>
                <p><?php echo $total_reports; ?></p>
            </div>
            <div class="stat-card">
                <h3>Pending Reports</h3>
                <p><?php echo $pending_reports; ?></p>
            </div>
            <div class="stat-card">
                <h3>Total Users</h3>
                <p><?php echo $total_users; ?></p>
            </div>
            <div class="stat-card">
                <h3>Total FAQs</h3>
                <p><?php echo $total_faqs; ?></p>
            </div>
        </div>

        <div class="dashboard-actions">
            <h3>Quick Actions</h3>
            <div class="action-buttons">
                <a href="admin.php#home" class="action-btn">Manage Home Content</a>
                <a href="admin.php#reports" class="action-btn">Manage Reports</a>
                <a href="admin.php#faqs" class="action-btn">Manage FAQs</a>
                <a href="admin.php#contact" class="action-btn">Manage Contact Info</a>
            </div>
        </div>

        <!-- Recent Reports Preview -->
        <section>
            <h3>Recent Reports</h3>
            <?php
            $recent_stmt = $conn->query("SELECT r.*, u.username FROM reports r LEFT JOIN users u ON r.user_id = u.id ORDER BY r.created_at DESC LIMIT 5");
            $recent_reports = $recent_stmt->fetchAll();
            ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Crime Type</th>
                        <th>Username</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recent_reports as $report): ?>
                    <tr>
                        <td><?php echo $report['id']; ?></td>
                        <td><?php echo htmlspecialchars($report['crime_type']); ?></td>
                        <td><?php echo htmlspecialchars($report['username'] ?? 'Anonymous'); ?></td>
                        <td><?php echo $report['status']; ?></td>
                        <td><?php echo $report['created_at']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </div>

    <footer>
        <p>© 2025 Online Crime Reporting System | All rights reserved.</p>
    </footer>
</body>
</html>