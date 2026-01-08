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
<hr style="border-color:#0f0; margin:60px 0;">

<div class="mitigation-box">
    <h3 style="color:#0f0; text-shadow:0 0 15px #0f0; margin-bottom:20px;">
        [ VULNERABILITY EXPLANATION & MITIGATION ]
    </h3>

    <div class="vuln-item" style="background:rgba(30,0,0,0.5);">
        <strong style="color:#f00;">VULNERABILITY:</strong>
        <p style="margin:15px 0;">
            <!-- REPLACE WITH SPECIFIC VULN EXPLANATION -->
            The comment display is vulnerable to XSS attacks because it directly outputs user-provided data without proper sanitization or escaping.
            <h4 style="color:#f00;">How XSS Works:</h4>
            <ul>
                <li>An attacker submits a comment containing malicious JavaScript code.</li>
                <li>When other users view the comments, the malicious script executes in their browsers.</li>
                <li>This can lead to session hijacking, defacement, or redirection to malicious sites.</li>
            </ul>

        </p>
    </div>

    <div class="vuln-item" style="background:rgba(0,30,0,0.5); border-color:#0f0;">
        <strong style="color:#0f0;">HOW TO FIX (SECURE CODE):</strong>
        <pre style="background:#000; padding:20px; border-radius:8px; overflow-x:auto; margin:15px 0; color:#0f0; font-size:1.3rem;">
            // Securely output the comment to prevent XSS
            $name = htmlspecialchars($row['username'], ENT_QUOTES, 'UTF-8');
            $comment = htmlspecialchars($row['comment'], ENT_QUOTES, 'UTF-8');
        </pre>
        <p style="margin-top:10px; font-size:1.3rem;">
            This protection works on <strong>High</strong> security level.
        </p>
    </div>

    <p style="text-align:center; margin-top:30px; color:#0ff;">
        Knowledge is the ultimate defense.
    </p>
</div>
</body>
</html>