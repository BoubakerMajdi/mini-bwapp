<?php
session_start();
if (isset($_POST['security'])) {
    $_SESSION['security'] = $_POST['security'];
}

// Set default security level
if (!isset($_SESSION['security'])) {
    $_SESSION['security'] = 0; // LOW
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Mini bWAPP</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>

<h1>Welcome to Mini-bWAPP</h1>

<?php if (isset($_SESSION['username'])): ?>
    <div class="user-info">
        <p>You are logged in as <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong></p>
        
        <!-- BEAUTIFUL STYLED LOGOUT BUTTON -->
        <a href="logout.php" class="logout-btn">
            [ LOGOUT ]
        </a>
    </div>

    <h3>Vulnerabilities</h3>
    <ul class='vuln-list'>
        <li class="vuln-item"><a href="sql/sql_injection.php">SQL Injection</a></li>
        <li class="vuln-item"><a href="comments/comments.php">Stored XSS</a></li>
        <li class="vuln-item"><a href="upload/upload.php">File Upload</a></li>
        <li class="vuln-item"><a href="csrf/change_email.php">CSRF Mail Vulnerable</a></li>
        <li class="vuln-item"><a href="csrf/change_password.php">CSRF Password Vulnerable</a></li>
        <li class="vuln-item"><a href="security_level.php">Change Security Level</a></li>
    </ul>
<?php else: ?>
    <p><a href="login.php" class="login-link">[ LOGIN ]</a></p>
<?php endif; ?>

</body>
</html>