<?php
session_start();
include "includes/db.php";

$username = $_POST['username'];
$password = $_POST['password'];

// SQL Injection Vulnerability on purpose
$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $_SESSION['username'] = $username;
    header("Location: index.php");
} else {
    echo "<h3>Login failed!</h3>";
    echo "<p>Try using SQL Injection 😉</p>";
    echo "<a href='login.php'>Back to Login</a>";
}
?>
