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
// Display all comments (VULNERABLE: no sanitization)
while ($row = mysqli_fetch_assoc($result)):
?>
    <div style="border:1px solid #ccc; padding:10px; margin:10px 0;">
        <strong><?php echo $row['username']; ?></strong> said:<br><br>
        <?php echo $row['comment']; ?>   <!-- XSS vulnerability -->
        <br><small><?php echo $row['date_added']; ?></small>
    </div>
<?php endwhile; ?>

<a href="../index.php">Back to Home</a>

<?php endif; ?>

</body>
</html>
