<?php
require_once __DIR__ . "/UsuariosController.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controller = new UsuariosController();
    
    $token = $_POST['token'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    
    if ($new_password !== $confirm_password) {
        die("Las contraseñas no coinciden.");
    }
    
    $resultado = $controller->restablecerContrasena($token, $new_password);
    echo $resultado;
}