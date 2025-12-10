<?php
require_once "includes/session.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Security Level</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>

<h2>Change Security Level</h2>

<form method="POST">
    <select name="level">
        <option value="low" <?php if ($_SESSION['security_level']=="low") echo "selected"; ?>>Low (vulnerable)</option>
        <option value="medium" <?php if ($_SESSION['security_level']=="medium") echo "selected"; ?>>Medium</option>
        <option value="high" <?php if ($_SESSION['security_level']=="high") echo "selected"; ?>>High (secure)</option>
    </select>
    <button type="submit">Update</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['security_level'] = $_POST['level'];
    echo "<p style='color:green;font-weight:bold;'>Security level changed to: " . $_SESSION['security_level'] . "</p>";
}
?>

<br>
<a href="index.php"><button>Back to Home</button></a>

</body>
</html>
