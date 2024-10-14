<?php
require_once 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    
    // Check if the email exists in the database
    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Generate a unique token
        $token = bin2hex(random_bytes(32));
        
        // Set token expiration time (e.g., 1 hour from now)
        $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));
        
        // Store the token in the database
        $sql = "UPDATE usuarios SET reset_token = ?, reset_token_expires = ? WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $token, $expiry, $email);
        $stmt->execute();
        
        // Send email with reset link
        $reset_link = "http://localhost/Compusof/view/usuario/usuarioCorreo/reset_password.php?token=" . $token;
        $to = $email;
        $subject = "Recuperación de contraseña - Compusof";
        $message = "Haga clic en el siguiente enlace para restablecer su contraseña: " . $reset_link;
        $headers = "From: noreply@compusof.mx";
        
        if(mail($to, $subject, $message, $headers)) {
            echo "Se ha enviado un enlace de recuperación a su correo electrónico.";
        } else {
            echo "Hubo un problema al enviar el correo. Por favor, intente nuevamente.";
        }
    } else {
        echo "No se encontró ninguna cuenta con ese correo electrónico.";
    }
    
    $stmt->close();
}

$conn->close();
?>