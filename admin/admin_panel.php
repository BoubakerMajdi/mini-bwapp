<?php
require_once "../includes/session.php";
require_once "../includes/db.php";
require_once "../includes/auth_admin.php";

$security = $_SESSION['security'] ?? 'low';

// LOW security → NO access control
if ($security == 'low') {
    // no role check
}
// MEDIUM/HIGH security → must be admin
else {
    if ($_SESSION['role'] !== 'admin') {
        die("Access denied: admin only!");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<h2>Admin Panel</h2>

<p>Welcome, <?php echo $_SESSION['username']; ?>!</p>

<a href="delete_user.php?user=testuser">Delete user testuser</a> (example)
<br><br>

<a href="../index.php"><button>Back</button></a>
</body>
</html>
