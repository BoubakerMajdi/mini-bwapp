<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Mini bWAPP</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h1>Welcome to Mini-bWAPP</h1>

<?php if (isset($_SESSION['username'])): ?>
    <p>You are logged in as <strong><?php echo $_SESSION['username']; ?></strong></p>
    <a href="logout.php">Logout</a><br><br>

    <h3>Vulnerabilities</h3>
    <ul>
        <li><a href="comments/comments.php">Stored XSS</a></li>
        <li><a href="upload/upload.php">File Upload</a></li>
        <li><a href="admin/admin.php">CSRF Vulnerable Admin</a></li>
    </ul>

<?php else: ?>
    <p><a href="login.php">Login</a></p>
<?php endif; ?>

</body>
</html>
