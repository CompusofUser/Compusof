<?php
// Input sanitization function
function sanitizeInput($input) {
    return htmlspecialchars(strip_tags(trim($input)), ENT_QUOTES, 'UTF-8');
}

// Phone number validation function
function validatePhone($phone) {
    return preg_match('/^\d{10}$/', $phone);
}



// Hash password
function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

// Verify password
function verifyPassword($password, $hash) {
    return password_verify($password, $hash);
}

// Log authentication actions
function logAuthAction($db, $userId, $action, $ipAddress, $userAgent) {
    $stmt = $db->prepare("INSERT INTO auth_logs (user_id, action, ip_address, user_agent) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $userId, $action, $ipAddress, $userAgent);
    $stmt->execute();
}


?>