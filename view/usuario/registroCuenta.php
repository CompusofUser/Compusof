<?php
require_once 'auth.php';
$isLogin = false;
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['nombre'] ?? '';
    $lastname = $_POST['apellidos'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['password_verified_at'] ?? '';
    $gender = $_POST['genero'] ?? '';
    $birthDate = $_POST['fechaNac'] ?? '';
    $agreeTerms = isset($_POST['agree_terms']);

    if (empty($name) || empty($lastname) || empty($email) || empty($password) || empty($confirmPassword) || empty($gender) || empty($birthDate)) {
        $message = "Por favor, complete todos los campos.";
    } elseif (!validateEmail($email)) {
        $message = "Por favor, use una dirección de correo electrónico @compusof.mx";
    } elseif ($password !== $confirmPassword) {
        $message = "Las contraseñas no coinciden.";
    } elseif (!$agreeTerms) {
        $message = "Debe aceptar los términos de uso y la política de privacidad.";
    } else {
        $message = "Intento de registro con email válido";

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
    <title>Crear cuenta - Compusof</title>

</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <img src= "..\img\logoCompusof.jpg" alt="logoCompusof" class="logo">
                <h2>Crea una cuenta</h2>
            </div>
            <div class="card-content">
                <form method="POST" id="registrationForm" action="/Compusof/Controller/registrar_usuario.php">  
                    <div class="form-row">
                        <div class="form-column">
                            <input type="text" id="nombre" name="nombre" placeholder="Nombre(s)" required>
                        </div>
                        <div class="form-column">
                            <input type="text" id="apellidos" name="apellidos" placeholder="Apellido" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" id="email" name="email" placeholder="correo electrónico@compusof.mx" required>
                    </div>
                    <div class="form-group">
                        <input type="tel" id="numeroTelefono" name="numeroTelefono" placeholder="telefono" required maxlength="10">
                    </div>
                    <div class="form-group">
                        <input type="password" id="password" name="password" placeholder="Contraseña nueva" required maxlength="30">
                        <div class="password-strength"></div>
                    </div>
                    <div class="form-group">
                        <input type="password" id="password_verified_at" name="password_verified_at" placeholder="Confirmar contraseña" required>
                        <div class="password-match"></div>
                    </div>
                    <div class="form-row">
                        <div class="form-column">
                            <label for="birth_date">Fecha de nacimiento</label>
                            <input type="date" id="fechaNac" name="fechaNac" required>
                        </div>
                        <div class="form-column">
                            <label>Género</label>
                            <div class="radio-group">
                                <label class="radio-label">
                                    <input type="radio" name="genero" value="mujer" required> Mujer
                                </label>
                                <label class="radio-label">
                                    <input type="radio" name="genero" value="hombre" required> Hombre
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group checkbox">
                        <input type="checkbox" id="terminos_verified_at" name="terminos_verified_at" required>
                        <label for="agree_terms">Acepto los <a href="https://compusof-mxico.pandape.computrabajo.com/Privacy">Términos de Uso</a> y la <a href="https://compusof-mxico.pandape.computrabajo.com/Privacy">Política de Privacidad</a></label>
                    </div>
                    <button type="submit" class="btn btn-primary">Registrarte</button>
                </form>
            </div>
            <div class="card-footer">
                <a href= "/compusof/index.php" class="switch-form">¿Ya tienes cuenta? Inicia sesión</a>
            </div>
        </div>
    </div>
    <?php if ($message): ?>
        <div class="message"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const password = document.getElementById('password');
            const confirmPassword = document.getElementById('password_verified_at');
            const strengthBar = document.querySelector('.password-strength');
            const matchMessage = document.querySelector('.password-match');

            function checkPasswordStrength(password) {
                let strength = 0;
                if (password.length >= 8) strength++;
                if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength++;
                if (password.match(/\d/)) strength++;
                return strength;
            }

            function updateStrengthBar(strength) {
                strengthBar.className = 'password-strength';
                switch(strength) {
                    case 0:
                        strengthBar.classList.add('strength-weak');
                        break;
                    case 1:
                        strengthBar.classList.add('strength-medium');
                        break;
                    case 2:
                    case 3:
                        strengthBar.classList.add('strength-strong');
                        break;
                }
            }

            function checkPasswordMatch() {
                if (password.value === confirmPassword.value && password.value !== '') {
                    matchMessage.textContent = 'Las contraseñas coinciden';
                    matchMessage.style.color = 'green';
                } else if (confirmPassword.value !== '') {
                    matchMessage.textContent = 'Las contraseñas no coinciden';
                    matchMessage.style.color = 'red';
                } else {
                    matchMessage.textContent = '';
                }
            }

            password.addEventListener('input', function() {
                const strength = checkPasswordStrength(this.value);
                updateStrengthBar(strength);
                checkPasswordMatch();
            });

            confirmPassword.addEventListener('input', checkPasswordMatch);
        });
    </script>
</body>
</html>
