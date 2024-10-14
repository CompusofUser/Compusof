<?php
require_once 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['token'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    
    if ($new_password !== $confirm_password) {
        die("Las contraseñas no coinciden.");
    }
    
    // Check if the token is valid and not expired
    $sql = "SELECT * FROM usuarios WHERE reset_token = ? AND reset_token_expires > NOW()";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Update the password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $sql = "UPDATE usuarios SET password = ?, reset_token = NULL, reset_token_expires = NULL WHERE idUsuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $hashed_password, $user['idUsuario']);
        $stmt->execute();
        
        echo "Su contraseña ha sido restablecida con éxito. Puede iniciar sesión con su nueva contraseña.";
    } else {
        echo "El enlace de restablecimiento no es válido o ha expirado.";
    }
    
    $stmt->close();
}

$conn->close();
?>