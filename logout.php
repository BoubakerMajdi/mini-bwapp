<?php
session_start();

// Destroy ALL session data
session_unset();
session_destroy();
session_write_close();
setcookie(session_name(), '', 0, '/'); // Delete session cookie
session_regenerate_id(true); // Extra safety
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logged Out - Mini-bWAPP</title>
    <link rel="stylesheet" href="./css/style.css">
    <style>
        .logout-screen {
            position: fixed;
            inset: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: #000;
            animation: logout-fade 3s forwards;
        }
        .logout-screen h1 {
            font-size: 6rem;
            color: #f00;
            text-shadow: 0 0 40px #f00;
            animation: glitch-2 2s infinite;
        }
        .logout-screen p {
            margin-top: 40px;
            font-size: 2.5rem;
            color: #0f0;
            text-shadow: 0 0 20px #0f0;
        }
        .logout-screen a {
            margin-top: 60px;
            padding: 20px 60px;
            background: #000;
            color: #0f0;
            border: 3px solid #0f0;
            font-size: 2rem;
            text-decoration: none;
            box-shadow: 0 0 30px #0f0;
            transition: all 0.5s;
        }
        .logout-screen a:hover {
            background: #0f0;
            color: #000;
            box-shadow: 0 0 60px #0f0;
            transform: scale(1.1);
        }

        @keyframes logout-fade {
            0%   { opacity: 0; }
            20%  { opacity: 1; }
            80%  { opacity: 1; }
            100% { opacity: 0; }
        }
        @keyframes glitch-2 {
            0%,100% { text-shadow: 5px 5px #0ff, -5px -5px #f00; }
            50%     { text-shadow: -5px 5px #0ff, 5px -5px #f00; }
        }

        /* Auto redirect after 4 seconds */
    </style>
</head>
<body>

<div class="logout-screen">
    <h1>ACCESS TERMINATED</h1>
    <p>Session destroyed successfully.</p>
    <a href="index.php">RETURN TO MAINFRAME</a>
</div>

<script>
// Auto redirect after animation (4 seconds)
setTimeout(() => {
    window.location.href = 'index.php';
}, 4000);
</script>

</body>
</html>