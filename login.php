<?php
require_once "includes/db.php";
require_once "includes/session.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['username'] = $username; // IMPORTANT
        header("Location: index.php");
        exit;
    } else {
        echo "Invalid login!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - Mini bWAPP</title>
    <link rel="stylesheet" href="./css/style.css">

</head>
<body>

<h2>Login</h2>

<form action="login_process.php" method="POST">
    <label>Username:</label><br>
    <input type="text" name="username" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Login</button>
</form>

</body>
</html>
