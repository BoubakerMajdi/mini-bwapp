<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}

// Path to uploads folder
$target_dir = "../uploads/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);

// ⚠️ No file type validation
// ⚠️ No size limit
// ⚠️ No protection against PHP upload

if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
    echo "<h3>File uploaded successfully!</h3>";
    echo "<p>Path: <a href='$target_file'>$target_file</a></p>";
} else {
    echo "<h3>File upload failed!</h3>";
}

echo "<br><a href='upload.php'>Back</a>";
?>
