<?php
require_once "../includes/session.php";
require_once "../includes/db.php";

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}

$security_level = $_SESSION["security_level"];

// Get user input
$comment = mysqli_real_escape_string($conn, $_POST['comment']);


// Apply security level logic
switch ($security_level) {
    case "0":  // Low
        // NO PROTECTION
        $comment = $comment;
        break;

    case "1":  // Medium
        // Basic sanitization
        $comment = htmlspecialchars($comment, ENT_QUOTES, 'UTF-8');
        break;

    case "2":  // High
        // Strong sanitization
        $comment = strip_tags($comment);
        $comment = htmlspecialchars($comment, ENT_QUOTES, 'UTF-8');
        break;
}


$username = $_SESSION['username'];

$query = "INSERT INTO comments (username, comment, date_added)
          VALUES ('$username', '$comment', NOW())";

mysqli_query($conn, $query);

header("Location: comments.php?success=1");
exit;
?>
