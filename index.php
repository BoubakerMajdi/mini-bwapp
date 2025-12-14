<?php
require_once "includes/session.php";
require_once "includes/db.php";

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];
$is_admin = ($_SESSION['role'] ?? '') === 'admin';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Mini bWAPP</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">
    <h1>Welcome to Mini-bWAPP</h1>

    <div class="user-info">
        <p>You are logged in as <strong><?php echo htmlspecialchars($username); ?></strong></p>
        
        <?php if ($is_admin): ?>
            <a href="admin_panel.php" class="logout-btn" style="background:#8b00ff; border-color:#8b00ff; box-shadow:0 0 30px #8b00ff;">
                [ ADMIN PANEL ]
            </a>
        <?php endif; ?>

        <a href="logout.php" class="logout-btn">[ LOGOUT ]</a>
    </div>

    <h3>Vulnerabilities</h3>
    <ul class="vuln-list">
        <li class="vuln-item"><a href="sql/sql_injection.php">SQL Injection</a></li>
        <li class="vuln-item"><a href="comments/comments.php">Stored XSS</a></li>
        <li class="vuln-item"><a href="upload/upload.php">File Upload</a></li>
        <li class="vuln-item"><a href="csrf/change_email.php">CSRF Mail Vulnerable</a></li>
        <li class="vuln-item"><a href="csrf/change_password.php">CSRF Password Vulnerable</a></li>
        <li class="vuln-item"><a href="security_level.php">Change Security Level</a></li>
    </ul>

    <?php if ($is_admin): ?>
        <p style="color:#8b00ff; text-shadow:0 0 15px #8b00ff; margin-top:40px;">
            Elite admin access detected. Use power wisely.
        </p>
    <?php endif; ?>
</div>

</body>
</html>