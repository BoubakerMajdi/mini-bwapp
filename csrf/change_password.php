<?php
require_once "../includes/session.php";
require_once "../includes/db.php";

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Change Password (CSRF Vulnerable)</title>
    <link rel="stylesheet" href="../css/style.css">

</head>
<body>

<h2>Change Your Password</h2>

<?php
if (isset($_GET['success'])) {
    echo "<p style='color: green; font-weight: bold;'>Password successfully updated!</p>";
    echo "<a href='../index.php'><button>Back to Home</button></a><br><br>";
}
?>

<form action="process_password.php" method="POST">
    <label>New Password:</label>
    <input type="password" name="new_password" required>
    <br><br>
    <button type="submit">Update Password</button>
</form>
<button class="green" onclick="window.location.href='../index.php'">Back to Home</button>
<hr style="border-color:#0f0; margin:60px 0;">

<div class="mitigation-box">
    <h3 style="color:#0f0; text-shadow:0 0 15px #0f0; margin-bottom:20px;">
        [ VULNERABILITY EXPLANATION & MITIGATION ]
    </h3>

    <div class="vuln-item" style="background:rgba(30,0,0,0.5);">
        <strong style="color:#f00;">VULNERABILITY:</strong>
        <p style="margin:15px 0;">
            A CSRF (Cross-Site Request Forgery) vulnerability tricks an authenticated user's browser into sending unintended commands to a web application, exploiting the trust the site has in the user's active session to perform malicious actions like transferring funds or changing settings without their knowledge or consent. Attackers use social engineering, like malicious links in emails, to get victims to click, and the user's browser automatically sends their session cookies, making the request appear legitimate to the server. 
            This "blind attack" can compromise accounts or even entire applications, as seen in attacks against major sites like YouTube and Netflix.
            <h4 style="color:#f00;">How CSRF Works:</h4>
            An attacker crafts a malicious request that mimics a legitimate action on a trusted site. When the victim, who is logged into that site, unknowingly triggers this request (e.g., by clicking a link), their browser includes their session cookies, making the request appear valid. The server processes the request, executing the unwanted action on behalf of the attacker.
        </p>
    </div>

    <div class="vuln-item" style="background:rgba(0,30,0,0.5); border-color:#0f0;">
        <strong style="color:#0f0;">HOW TO FIX (SECURE CODE):</strong>
        <pre style="background:#000; padding:20px; border-radius:8px; overflow-x:auto; margin:15px 0; color:#0f0; font-size:1.3rem;">
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                die("CSRF token mismatch.");
            }
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
