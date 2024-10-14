<?php
require_once __DIR__ . "/UsuariosController.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controller = new UsuariosController();
    
    $email = $_POST['email'];

    $resultado = $controller->solicitarRecuperacionContrasena($email);
    echo $resultado;
}