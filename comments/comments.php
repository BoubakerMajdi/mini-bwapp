<?php
session_start();
$security_level = $_SESSION["security_level"];
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
while($row = mysqli_fetch_assoc($result)) {

    $comment = $row["comment"];

    switch ($security_level) {

        case "0":   // Low
            // Direct echo → vulnerable to XSS
            echo $comment;
            break;

        case "1":   // Medium
            // mild protection
            echo htmlspecialchars($comment, ENT_QUOTES, 'UTF-8');
            break;

        case "2":   // High
            // full protection
            echo nl2br(htmlspecialchars($comment, ENT_QUOTES, 'UTF-8'));
            break;
    }
}
?>

<?php endif; ?>

</body>
</html>