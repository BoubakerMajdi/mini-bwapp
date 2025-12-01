<?php
require_once "../includes/session.php";
require_once "../includes/db.php";

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}

$comment = $_POST['comment'];
$security = $_SESSION['security'];

// Apply security level
switch ($security) {

    case 0: // LOW (vulnerable)
        // DO NOTHING
        break;

    case 1: // MEDIUM (remove <script> only)
        $comment = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', '', $comment);
        break;

    case 2: // HIGH (strong escaping)
        $comment = htmlspecialchars($comment, ENT_QUOTES, 'UTF-8');
        break;
}

$username = $_SESSION['username'];

$query = "INSERT INTO comments (username, comment, created_at)
          VALUES ('$username', '$comment', NOW())";

mysqli_query($conn, $query);

header("Location: comments.php?success=1");
exit;
?>
