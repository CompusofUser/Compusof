
<?php
require_once '..\validacion\auth.php';
$isLogin = true;
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        $message = "Por favor, complete todos los campos.";
    } elseif (!validateEmail($email)) {
        $message = "Por favor, use una dirección de correo electrónico @compusof.mx";
    } else {
        $message = "Intento de login con email válido";
        // lógica real de autenticación
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
    <title>Login - Compusof</title>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <img src= "..\img\logoCompusof.jpg" alt="Compusof" class="logo">
                <h2>Login</h2>
            </div>
            <div class="card-content">
                <form method="POST">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" placeholder="usuario@compusof.mx" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña:</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="card-footer">
                <a href= "recuperarCuenta.php" class="switch-form">¿Olvidaste tu contraseña? </a>
            </div>
                    <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                </form>
            </div>
            <div class="card-footer">
                <a href= "registroCuenta.php" class="switch-form">¿No tienes cuenta? Regístrate</a>
                <div class="microsoft-login">
                    <p>Puedes ingresar con tu cuenta de</p>
                    <img src= "..\img\logoMicrosoft.png" alt="Microsoft" class="microsoft-logo">
                </div>
            </div>
        </div>
    </div>
    <?php if ($message): ?>
        <div class="message"><?php echo $message; ?></div>
    <?php endif; ?>
</body>
</html>