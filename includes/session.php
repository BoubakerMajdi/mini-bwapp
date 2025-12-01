<?php
// Start the session on every page that includes this file
session_start();

if (!isset($_SESSION['security_level'])) {
    $_SESSION['security_level'] = "low"; 
}

// OPTIONAL: Prevent caching so logout works properly
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
?>
