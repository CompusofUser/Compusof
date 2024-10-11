<?php
// auth.php
session_start();

$isLogin = true; // Por defecto, mostrar el formulario de login
$message = '';

function validateEmail($email) {
    return preg_match('/@compusof\.mx$/', $email);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['toggle'])) {
        $isLogin = $_POST['toggle'] !== 'login';
    } else {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($email) || empty($password)) {
            $message = "Por favor, complete todos los campos.";
        } elseif (!validateEmail($email)) {
            $message = "Por favor, use una dirección de correo electrónico @compusof.mx";
        } else {
            // lógica de autenticación o registro real
            $message = $isLogin ? "Intento de login con email válido" : "Intento de registro con email válido";
            // aquí se manejaría la autenticación/registro
        }
    }
}
?>

