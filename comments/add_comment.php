<?php
session_start();
include "../includes/db.php";

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}

$username = $_SESSION['username'];
$comment = addslashes($_POST['comment']);   // ⚠️ No sanitization = Stored XSS
$date     = date("Y-m-d H:i:s");

$sql = "INSERT INTO comments (username, comment, date_added)
        VALUES ('$username', '$comment', '$date')";

mysqli_query($conn, $sql);

header("Location: comments.php");
?>
