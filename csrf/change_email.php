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
    <title>Change Email (CSRF Vulnerable)</title>
</head>
<body>

<h2>Change Your Email</h2>

<?php
if (isset($_GET['success'])) {
    echo "<p style='color: green; font-weight: bold;'>Email successfully updated!</p>";
    echo "<a href='../index.php'><button>Back to Home</button></a><br><br>";
}
?>

<form action="process_email.php" method="POST">
    <label>New Email:</label>
    <input type="email" name="new_email" required>
    <br><br>
    <button type="submit">Change Email</button>
</form>

</body>
</html>
