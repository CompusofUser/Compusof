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


    if ($resultado === true) {
        echo "Inicio de sesión exitoso.";
        //NOta: aqui se colocara el dash cuando este listo
    } else {
       header("location:\compusof\index.php");
       
    }
} else {
    echo "Acceso no autorizado.";
}