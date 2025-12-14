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
    <link rel="stylesheet" href="../css/style.css">

</head>
<body>

<h2>Change Your Password</h2>

<?php
if (isset($_GET['success'])) {
    echo "<p style='color: green; font-weight: bold;'>Password successfully updated!</p>";
    echo "<a href='../index.php'><button>Back to Home</button></a><br><br>";
}
?>

<form action="process_password.php" method="POST">
    <label>New Password:</label>
    <input type="password" name="new_password" required>
    <br><br>
    <button type="submit">Update Password</button>
</form>
<button class="green" onclick="window.location.href='../index.php'">Back to Home</button>

</body>
</html>
