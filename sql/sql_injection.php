<?php
require_once "../includes/session.php";
require_once "../includes/db.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>SQL Injection</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<h2>SQL Injection Testing</h2>

<form method="GET">
    <label>User ID:</label>
    <input type="text" name="id">
    <button type="submit">Search</button>
</form>

<hr>

<?php
if (isset($_GET['id'])) {

    $id = $_GET['id'];

    switch ($_SESSION['security_level']) {

        case "low":
            // ❌ Completely vulnerable
            $query = "SELECT * FROM users WHERE id = $id";
            break;

        case "medium":
            // ❌ Blocks some characters but still injectable
            $id = str_replace(["'", '"', "--"], "", $id);
            $query = "SELECT * FROM users WHERE id = $id";
            break;

        case "high":
            // ✔ Fully secure prepared statement
            $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            break;
    }

    // Run query differently based on level
    if ($_SESSION['security_level'] != "high") {
        $result = mysqli_query($conn, $query);
    }

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<p><strong>Username:</strong> " . htmlspecialchars($row['username']) . "</p>";
        }
    } else {
        echo "<p>No results found.</p>";
    }
}
?>

</body>
</html>
