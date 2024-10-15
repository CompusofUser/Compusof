<?php


$message = '';
$messageClass = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    
    $ip = $_SERVER["REMOTE_ADDR"];
    $captcha = $_POST['g-recaptcha-response'];
    $secretKey = '6LeMZ2EqAAAAAK2TMJn_a1MTMu1pLiRKpe33_aeo';
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secretKey}&response={$captcha}&remoteip={$ip}");
    $atributos = json_decode($response, true);

    $errors = [];

    if (empty($new_password) || empty($confirm_password)) {
        $errors[] = "Por favor, complete todos los campos.";
    }
    if ($new_password !== $confirm_password) {
        $errors[] = "Las contraseñas no coinciden.";
    }
    if (empty($atributos) || !$atributos['success']) {
        $errors[] = 'Verifica el captcha';
    }

    if (empty($errors)) {
        // Here you would typically update the user's password in the database
        // For this example, we'll just show a success message
        $message = "Cambio de contraseña correcto.";
        $messageClass = "alert-success";
        // Redirect to dashboard after successful password change
        // header("Location: dashboard.php");
        // exit;
    } else {
        $message = implode("<br>", $errors);
        $messageClass = "alert-danger";
    }
}



?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña - Compusof</title>
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/estilosSesion.css">
<<<<<<< HEAD
    <style>
        .password-requirements-popup {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 4px;
            z-index: 1000;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }
        .password-requirements-popup div {
            margin-bottom: 5px;
            color: #dc3545;
        }
        .password-requirements-popup div.met {
            color: #28a745;
        }
        .password-input-container {
            position: relative;
        }
        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            user-select: none;
        }
    </style>
=======
    <script src="..\js\validar_password.js"></script>
>>>>>>> add7af0fc4df0d2d19b9d3f69d6104036ec8e0c4
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <img src="../img/logoCompusof.jpg" alt="Compusof" class="logo">
                <h2>Restablecer Contraseña</h2>
            </div>
            <div class="card-content">
<<<<<<< HEAD
                <form method="POST" action="\Compusof\controller\procesar_reset.php" id="resetPasswordForm">
=======
                <form method="POST" action="\Compusof\controller\procesar_reset.php" onsubmit="validatePasswords(event)">
>>>>>>> add7af0fc4df0d2d19b9d3f69d6104036ec8e0c4
                    <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
                    <div class="form-group password-input-container">
                        <label for="new_password">Nueva Contraseña:</label>
                        <input type="password" id="new_password" name="new_password" required>
                        <span class="password-toggle" onclick="togglePassword('new_password')">👁️</span>
                    </div>
                    <div class="form-group password-input-container">
                        <label for="confirm_password">Confirmar Contraseña:</label>
                        <input type="password" id="confirm_password" name="confirm_password" required>
                        <span class="password-toggle" onclick="togglePassword('confirm_password')">👁️</span>
                    </div>


                    <div class="form-group">
                        <div class="g-recaptcha" data-sitekey="6LeMZ2EqAAAAAMETCm1sxZUhRWHGuCp_rUeSaOBP"></div>
                    </div>

                    <button type="submit" class="btn btn-primary">Restablecer Contraseña</button>
                </form>
            </div>
        </div>
    </div>
    <div id="passwordRequirementsPopup" class="password-requirements-popup"></div>
    <script src="../js/password_validator.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            initializePasswordRequirements('new_password', 'confirm_password', 'passwordRequirementsPopup');
        });
    </script>
</body>
</html>
