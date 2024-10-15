
<?php
require 'auth.php';
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $newPassword = $_POST['new_password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    if (empty($email) || empty($newPassword) || empty($confirmPassword)) {
        $message = "Por favor, complete todos los campos.";
    } elseif (!validateEmail($email)) {
        $message = "Por favor, use una dirección de correo electrónico @compusof.mx";
    } elseif ($newPassword !== $confirmPassword) {
        $message = "Las contraseñas no coinciden.";
    } elseif (!validatePassword($newPassword)) {
        $message = "La contraseña no cumple con los requisitos de seguridad.";
    } else {
        $message = "Solicitud de recuperación de contraseña enviada para el email: " . $email;
        // Aquí iría la lógica real de recuperación de contraseña
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="..\css\estilosSesion.css">
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
    <title>Recuperar Contraseña - Compusof</title>
    <style>
     
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <img src= "..\img\logoCompusof.jpg" alt="Compusof" class="logo">
                <h2>Recuperar Contraseña</h2>
            </div>
            <div class="card-content">
                <form method="POST" id="passwordForm">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" placeholder="usuario@compusof.mx" required>
                    </div>
                    <div class="form-group">
                        
                        <label for="new_password">Nueva Contraseña:</label>
                        <input type="password" id="new_password" name="new_password" required>
                        <div id="passwordRequirements" class="password-requirements-popup">
                            <p id="req-letter" class="requirement">Al menos una letra</p>
                            <p id="req-capital" class="requirement">Al menos una letra mayúscula</p>
                            <p id="req-number" class="requirement">Al menos un número</p>
                            <p id="req-length" class="requirement">Al menos 8 caracteres</p>
                            <p id="req-space" class="requirement">Sin espacios</p>
                            <p id="req-match" class="requirement">Las contraseñas deben coincidir</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirmar Contraseña:</label>
                        <input type="password" id="confirm_password" name="confirm_password" required>
                    </div>
                    <button type="submit" class="btn btn-primary" id="submitBtn" disabled>Cambiar Contraseña</button>
                </form>
            </div>
            <div class="card-footer">
                <a href= "/compusof/index.php" class="switch-form">Volver al inicio de sesión</a>
            </div>
        </div>
    </div>
    <?php if ($message): ?>
        <div class="message"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>

</body>
</html>