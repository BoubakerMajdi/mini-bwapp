<?php
require_once "../includes/session.php";
require_once "../includes/db.php";

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}

$new_password = $_POST['new_password'];

$query = "UPDATE users SET password='$new_password' WHERE username='" . $_SESSION['username'] . "'";

if (mysqli_query($conn, $query)) {
    header("Location: change_password.php?success=1");
    exit;
} else {
    echo "Error updating password.";
}
?>
