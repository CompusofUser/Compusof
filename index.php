
<?php
require_once '../compusof/view/usuario/auth.php';
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
    <link rel="stylesheet" href="..\compusof\view\css\estilosSesion.css">
    <link rel="shortcut icon" href="..\compusof\view\img\favicon.ico" type="image/x-icon">
    <title>Inicio de Sesion - Compusof</title>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <img src= "..\compusof\view\img\logoCompusof.jpg" alt="Compusof" class="logo">
                <h2>Login</h2>
            </div>
            <div class="card-content">
                <form method="POST" action="..\compusof\controller\usuarioSesion.php">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" pattern="[a-zA-Z0-9._%+-]+@compusof\.mx" placeholder="usuario@compusof.mx" required name="email">
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña:</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="card-footer">
                <a href= "..\compusof\view\usuario\usuarioCorreo\solicitar_recuperacion.html" class="switch-form">¿Olvidaste tu contraseña? </a>
            </div>
                    <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                </form>
            </div>
            <div class="card-footer">
                <a href= "..\compusof\view\usuario\registroCuenta.php" class="switch-form">¿No tienes cuenta? Regístrate</a>
                <div class="microsoft-login">
                    <p>Puedes ingresar con tu cuenta de</p>
                    <img src= "..\compusof\view\img\logoMicrosoft.png" alt="Microsoft" class="microsoft-logo">
                </div>
            </div>
        </div>
    </div>
    <?php if ($message): ?>
        <div class="message"><?php echo $message; ?></div>
    <?php endif; ?>
</body>
</html>