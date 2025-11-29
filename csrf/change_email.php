<?php
require_once "../includes/session.php";
require_once "../includes/db.php";

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Change Email (CSRF Vulnerable)</title>
</head>
<body>
    <h2>Change Your Email</h2>

    <form action="process_email.php" method="POST">
        <label>New Email:</label>
        <input type="email" name="new_email" required>
        <br><br>
        <button type="submit">Change Email</button>
    </form>

</body>
</html>
