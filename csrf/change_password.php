<?php
require_once "../includes/session.php";
require_once "../includes/db.php";

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Change Password (CSRF Vulnerable)</title>
</head>
<body>

<h2>Change Your Password</h2>

<form action="process_password.php" method="POST">
    <label>New Password:</label>
    <input type="password" name="new_password" required>
    <br><br>

    <button type="submit">Update Password</button>
</form>

</body>
</html>
