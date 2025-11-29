<?php
require_once "../includes/session.php";
require_once "../includes/db.php";

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}

$new_email = $_POST['new_email'];

// VERY VULNERABLE QUERY (no validation)
$query = "UPDATE users SET email='$new_email' WHERE username='" . $_SESSION['username'] . "'";

if (mysqli_query($conn, $query)) {
    echo "Email successfully changed to: " . htmlspecialchars($new_email);
} else {
    echo "Error updating email.";
}
?>