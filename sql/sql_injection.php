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
<button class="green" onclick="window.location.href='../index.php'">Back to Home</button>
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
<hr style="border-color:#0f0; margin:60px 0;">

<div class="mitigation-box">
    <h3 style="color:#0f0; text-shadow:0 0 15px #0f0; margin-bottom:20px;">
        [ VULNERABILITY EXPLANATION & MITIGATION ]
    </h3>

    <div class="vuln-item" style="background:rgba(30,0,0,0.5);">
        <strong style="color:#f00;">VULNERABILITY:</strong>
        <p style="margin:15px 0;">
            SQL injection (SQLi) is a code injection technique where malicious SQL statements are inserted into an application's entry fields to manipulate its backend database. This vulnerability occurs when an application incorporates untrusted user input directly into a database query without proper validation or sanitization, allowing the input to be executed as code. 
        <h4 style="color:#f00;">How SQL Injection Works:</h4>
        The core vulnerability lies in the failure to strictly separate application logic (code) from user-provided data. When user input is directly embedded into SQL queries, attackers can craft inputs that alter the intended SQL command structure. For example, an attacker might input a value like <code>' OR '1'='1</code> into a login form, which could transform a query intended to authenticate a user into one that always returns true, thereby bypassing authentication checks.
        <h4 style="color:#f00;">Potential Impacts of SQL Injection:</h4>
        SQL injection can lead to severe consequences, including unauthorized data access, data modification or deletion, and even complete system compromise. Attackers may exploit SQLi vulnerabilities to extract sensitive information such as usernames, passwords, and personal data, or to escalate their privileges within the application. In some cases, SQL injection can be used to execute arbitrary commands on the underlying server, leading to a full breach of the system.
        </p>
    </div>

    <div class="vuln-item" style="background:rgba(0,30,0,0.5); border-color:#0f0;">
        <strong style="color:#0f0;">HOW TO FIX (SECURE CODE):</strong>
        <pre style="background:#000; padding:20px; border-radius:8px; overflow-x:auto; margin:15px 0; color:#0f0; font-size:1.3rem;">
            
            $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
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
