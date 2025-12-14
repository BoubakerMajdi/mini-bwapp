<?php
session_start();

// Load security functions (contains get_security_level() and sanitize_input())
require_once '../includes/security_functions.php';

// Load your real DB connection (mysqli)
require_once '../includes/db.php';   // ← this is your file
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comments - Mini bWAPP</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <div class="container">
        <form action="add_comment.php" method="POST">
            <label>Add a comment:</label><br>
            <textarea name="comment" required></textarea><br><br>
            <button type="submit">Submit Comment</button>
        </form>
        <button class="green" onclick="window.location.href='../index.php'">Back to Home</button>

        <?php
        // Correct query using your real column name: date_added
        $sql = "SELECT * FROM comments ORDER BY date_added DESC";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 0) {
            echo "<p>No comments yet. Be the first!</p>";
        } else {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="comment-box">';
                echo '<strong>' . htmlspecialchars($row['username'], ENT_QUOTES, 'UTF-8') . '</strong> ';
                echo '<small>(' . $row['date_added'] . ')</small>';
                echo '<p>';

                // THIS IS THE LINE THAT MAKES XSS WORK ON LOW
                echo $row['comment'];   // ← raw output (already sanitized on insert by sanitize_input())

                echo '</p>';
                echo '</div>';
            }
        }
        ?>
    </div>

    <?php include '../includes/footer.php'; ?>
</body>
</html>