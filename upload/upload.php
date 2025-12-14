<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Unrestricted File Upload - Mini bWAPP</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<h2>Unrestricted File Upload</h2>

<?php if (!isset($_SESSION['username'])): ?>
    <p>You must <a href="../login.php">login</a> first.</p>
<?php else: ?>

<form action="upload_process.php" method="POST" enctype="multipart/form-data">
    <label>Select a file:</label><br><br>
    <input type="file" name="file"><br><br>
    <button type="submit">Upload</button>
</form>

<button class="green" onclick="window.location.href='../index.php'">Back to Home</button>

<?php endif; ?>

</body>
</html>
