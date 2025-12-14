<?php
require_once "../includes/session.php";
require_once "../includes/db.php";
require_once "../includes/auth_admin.php";

// Force admin role check on ALL security levels
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    die("<h2 style='color:#f00;text-align:center;'>ACCESS DENIED<br>Admin privileges required</h2>
         <a href='../index.php'><button>Back to Home</button></a>");
}

$security = $_SESSION['security'] ?? 'low';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="container">
    <h2>ADMIN PANEL</h2>
    <p>Welcome, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong> (Administrator)</p>

    <div class="vuln-list">
        <div class="vuln-item">
            <a href="delete_user.php?user=testuser">Delete user 'testuser'</a>
        </div>
        <div class="vuln-item">
            <a href="manage_comments.php">Manage Comments</a>
        </div>
        <!-- Add more admin actions here -->
    </div>

    <br>
    <button class="green" onclick="window.location.href='../index.php'">Back to Home</button>
</div>

</body>
</html>