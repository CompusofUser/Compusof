<?php
require_once "../model/Usuarios.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $email = $_POST["email"];
    $numero = $_POST["numeroTelefono"];
    $password = $_POST["password"];
    $fecha = $_POST["fechaNac"];
    $genero = $_POST["genero"];
    $usuario = new Usuarios();

    $usuario->insertarUsuario(
        $nombre,
        $apellidos,
        $email,
        $numero,
        $password,
        $fecha,
        $genero
    );

    if ($usuario == true) {
        header("location:\compusof\index.php");
    } else {
    }
}
    