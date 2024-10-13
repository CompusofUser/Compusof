<?php
require_once '..\model\Usuarios.php';

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validación básica
    if (empty($email) || empty($password)) {
        echo "Por favor, complete todos los campos.";
        exit;
    }

    // Sanitización básica
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    $usuario = new Usuarios();
    $resultado = $usuario->inicioSesion($email, $password);

} else {
    echo "Acceso no autorizado.";
}