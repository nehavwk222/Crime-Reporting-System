<?php
session_start();
include 'config.php';

// Restrict access to admins only
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Fetch data
$home_stmt = $conn->query("SELECT * FROM home_content LIMIT 1");
$home = $home_stmt->fetch();

$reports_stmt = $conn->query("SELECT r.*, u.username FROM reports r LEFT JOIN users u ON r.user_id = u.id");
$reports = $reports_stmt->fetchAll();

$faqs_stmt = $conn->query("SELECT * FROM faqs");
$faqs = $faqs_stmt->fetchAll();

$contact_stmt = $conn->query("SELECT * FROM contact_info LIMIT 1");
$contact = $contact_stmt->fetch();

// Handle updates
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['update_home'])) {
        $welcome = $_POST['welcome_message'];
        $description = $_POST['description'];
        $sql = "UPDATE home_content SET welcome_message = :welcome, description = :description WHERE id = 1";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['welcome' => $welcome, 'description' => $description]);
    } elseif (isset($_POST['add_faq'])) {
        $question = $_POST['question'];
        $answer = $_POST['answer'];
        $sql = "INSERT INTO faqs (question, answer) VALUES (:question, :answer)";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['question' => $question, 'answer' => $answer]);
    } elseif (isset($_POST['update_contact'])) {
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $sql = "UPDATE contact_info SET email = :email, phone = :phone WHERE id = 1";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['email' => $email, 'phone' => $phone]);
    }
    header("Location: admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Management</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Admin Management</h1>
    </header>

    <nav>
        <a href="admin_dashboard.php">Dashboard</a>
        <a href="index.php">Home</a>
        <a href="report.php">Report a Crime</a>
        <a href="faq.php">FAQ</a>
        <a href="contact.php">Contact Us</a>
        <a href="logout.php">Logout</a>
    </nav>

    <div class="container">
        <section id="home">
            <h2>Manage Home Content</h2>
            <form method="POST" class="form-container">
                <label>Welcome Message:</label>
                <input type="text" name="welcome_message" value="<?php echo htmlspecialchars($home['welcome_message']); ?>" required>
                <label>Description:</label>
                <textarea name="description" required><?php echo htmlspecialchars($home['description']); ?></textarea>
                <input type="submit" name="update_home" value="Update">
            </form>
        </section>

        <section id="reports">
            <h2>Manage Reports</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Crime Type</th>
                        <th>Username</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reports as $report): ?>
                    <tr>
                        <td><?php echo $report['id']; ?></td>
                        <td><?php echo htmlspecialchars($report['crime_type']); ?></td>
                        <td><?php echo htmlspecialchars($report['username'] ?? 'Anonymous'); ?></td>
                        <td><?php echo $report['status']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>

        <section id="faqs">
            <h2>Manage FAQs</h2>
            <form method="POST" class="form-container">
                <label>Question:</label>
                <input type="text" name="question" required>
                <label>Answer:</label>
                <textarea name="answer" required></textarea>
                <input type="submit" name="add_faq" value="Add FAQ">
            </form>
            <ul>
                <?php foreach ($faqs as $faq): ?>
                    <li><strong><?php echo htmlspecialchars($faq['question']); ?></strong><br><?php echo htmlspecialchars($faq['answer']); ?></li>
                <?php endforeach; ?>
            </ul>
        </section>

        <section id="contact">
            <h2>Manage Contact Info</h2>
            <form method="POST" class="form-container">
                <label>Email:</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($contact['email']); ?>" required>
                <label>Phone:</label>
                <input type="text" name="phone" value="<?php echo htmlspecialchars($contact['phone']); ?>" required>
                <input type="submit" name="update_contact" value="Update">
            </form>
        </section>
    </div>

    <footer>
        <p>© 2025 Online Crime Reporting System | All rights reserved.</p>
    </footer>
    <script src="script.js"></script>
</body>
</html>