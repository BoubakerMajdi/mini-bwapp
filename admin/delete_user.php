<?php
require_once "../includes/session.php";
require_once "../includes/db.php";

// Strong admin check - no bypass even on low security
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    die("<h2 style='color:#f00;'>ACCESS DENIED<br>Admin only!</h2>
         <a href='../index.php'><button>Back</button></a>");
}

if (!isset($_GET['user'])) {
    die("No user specified.");
}

$user_to_delete = $_GET['user'];

// Optional: prevent self-delete
if ($user_to_delete === $_SESSION['username']) {
    die("Cannot delete yourself!");
}

$sql = "DELETE FROM users WHERE username = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $user_to_delete);
mysqli_stmt_execute($stmt);

echo "<div style='text-align:center; padding:40px;'>";
echo "<h3 style='color:#0f0;'>User '$user_to_delete' has been deleted.</h3>";
echo "<a href='admin_panel.php'><button>Back to Admin Panel</button></a>";
echo "</div>";
?>