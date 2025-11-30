<?php
require_once "../includes/session.php";
require_once "../includes/db.php";
require_once "../includes/auth_admin.php";

$security = $_SESSION['security'] ?? 'low';

// LOW → no protection
if ($security == 'low') {
    // no checks
}
// MEDIUM/HIGH → require admin
else {
    if ($_SESSION['role'] !== 'admin') {
        die("Access denied: admin only!");
    }
}

$user_to_delete = $_GET['user'];

mysqli_query($conn, "DELETE FROM users WHERE username='$user_to_delete'");

echo "User '$user_to_delete' deleted!<br><br>";
echo "<a href='admin_panel.php'><button>Back to Admin</button></a>";
?>
