<?php
require_once __DIR__ . "/UsuariosController.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controller = new UsuariosController();
    
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $correo = $_POST['email'];
    $numeroTelefono = $_POST['numeroTelefono'];
    $password = $_POST['password'];
    $fechaNac = $_POST['fechaNac'];
    $genero = $_POST['genero'];

    $resultado = $controller->registrarUsuario($nombre, $apellidos, $correo, $numeroTelefono,
     $password, $fechaNac, $genero);

    if ($resultado) {
        echo "Usuario registrado con éxito";
    } else {
        echo "Error al registrar el usuario";
    }
}