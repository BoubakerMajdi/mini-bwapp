<?php
require_once "session.php";
require_once "db.php";

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}

$username = $_SESSION['username'];

$query = "SELECT role FROM users WHERE username='$username'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

$_SESSION['role'] = $user['role'];
