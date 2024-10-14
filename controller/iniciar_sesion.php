<?php
require_once __DIR__ . "/UsuariosController.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controller = new UsuariosController();
    
    $email = $_POST['email'];
    $password = $_POST['password'];

    $resultado = $controller->iniciarSesion($email, $password);
    echo $resultado;
}