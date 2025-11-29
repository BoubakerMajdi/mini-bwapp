<!DOCTYPE html>
<html>
<head>
    <title>Login - Mini bWAPP</title>
    <link rel="stylesheet" href="css/style.css">
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

<br>
<a href="index.php">Back to Home</a>

</body>
</html>
