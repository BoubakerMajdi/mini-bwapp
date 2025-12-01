<?php
session_start();
include "../includes/db.php";

// Fetch all comments
$sql = "SELECT * FROM comments ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Stored XSS - Mini bWAPP</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<h2>Stored XSS</h2>

<?php if (!isset($_SESSION['username'])): ?>
    <p>You must <a href="../login.php">login</a> first.</p>
<?php else: ?>

<!-- Comment form -->
<form action="add_comment.php" method="POST">
    <label>Add a comment:</label><br>
    <textarea name="comment" required></textarea><br><br>
    <button type="submit">Submit Comment</button>
</form>

<br><hr><br>

<h3>Comments:</h3>

<?php
$security = $_SESSION['security'];

while ($row = mysqli_fetch_assoc($result)) {

    $comment = $row['comment'];

    switch ($security) {

        case 0: // LOW: raw output
            echo "<p><b>{$row['username']}:</b> $comment</p>";
            break;

        case 1: // MEDIUM: strip script on display too
            $safe_comment = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', '', $comment);
            echo "<p><b>{$row['username']}:</b> $safe_comment</p>";
            break;

        case 2: // HIGH: full escaping
            $safe_comment = htmlspecialchars($comment, ENT_QUOTES, 'UTF-8');
            echo "<p><b>{$row['username']}:</b> $safe_comment</p>";
            break;
    }
}
?>

<?php endif; ?>

</body>
</html>