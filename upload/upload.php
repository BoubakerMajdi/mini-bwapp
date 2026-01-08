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
<hr style="border-color:#0f0; margin:60px 0;">

<div class="mitigation-box">
    <h3 style="color:#0f0; text-shadow:0 0 15px #0f0; margin-bottom:20px;">
        [ VULNERABILITY EXPLANATION & MITIGATION ]
    </h3>

    <div class="vuln-item" style="background:rgba(30,0,0,0.5);">
        <strong style="color:#f00;">VULNERABILITY:</strong>
        <p style="margin:15px 0;">
            Unrestricted File Upload allows attackers to upload malicious files (e.g., web shells) to the server, leading to potential remote code execution and server compromise.
            <h4 style="color:#f00;">How File Upload Works:</h4>
            When a user uploads a file, the server typically saves it to a designated directory. If there are no restrictions on file types or content, an attacker can upload a script (e.g., PHP file) that can be executed on the server.
        </p>
    </div>

    <div class="vuln-item" style="background:rgba(0,30,0,0.5); border-color:#0f0;">
        <strong style="color:#0f0;">HOW TO FIX (SECURE CODE):</strong>
        <pre style="background:#000; padding:20px; border-radius:8px; overflow-x:auto; margin:15px 0; color:#0f0; font-size:1.3rem;">
        if (isset($_FILES['file'])) {
            $allowed_types = ['image/jpeg', 'image/png', 'application/pdf'];
            $file_type = $_FILES['file']['type'];
            
            if (in_array($file_type, $allowed_types)) {
                $upload_dir = 'uploads/';
                $upload_file = $upload_dir . basename($_FILES['file']['name']);
                
                if (move_uploaded_file($_FILES['file']['tmp_name'], $upload_file)) {
                    echo "File is valid, and was successfully uploaded.";
                } else {
                    echo "Possible file upload attack!";
                }
            } else {
                echo "Error: Invalid file type.";
            }
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
