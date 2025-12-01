<?php
require_once "../includes/session.php";
require_once "../includes/db.php";

//  VULNERABLE CODE
// This admin page does NOT verify that the user is an ADMIN.
// Any logged-in user can access it = Privilege Escalation

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}

$username = $_SESSION['username'];

echo "<h1>Welcome to the Admin Panel</h1>";
echo "<p>You are logged in as: <strong>$username</strong></p>";

echo "<p style='color:red;font-weight:bold;'>WARNING: This page is vulnerable. Any logged-in user can access it!</p>";

echo "<br><a href='../index.php'><button>Back to Home</button></a>";
?>
