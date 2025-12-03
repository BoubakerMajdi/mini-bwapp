<?php

// Set default security level if not set
if (!isset($_SESSION['security_level'])) {
    $_SESSION['security_level'] = 'low'; // default = vulnerable
}

// Function to get current security level
function get_security_level() {
    return $_SESSION['security_level'] ?? 'low';
}

// Main sanitization function - changes behavior based on security level
function sanitize_input($data) {
    $level = get_security_level();

    // Trim whitespace
    $data = trim($data);

    if ($level === 'low') {
        // LOW = NO PROTECTION → full XSS possible
        return $data;
    } 
    elseif ($level === 'medium') {
        // MEDIUM = weak filter (real-world mistake): only removes <script>
        $data = str_replace('<script', '', $data);
        $data = str_replace('</script>', '', $data);
        $data = str_replace('SCRIPT', '', $data); // case insensitive attempt
        return $data;
    } 
    elseif ($level === 'high') {
        // HIGH = proper escaping
        return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    }

    return $data;
}
?>