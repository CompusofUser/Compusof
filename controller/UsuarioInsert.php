<?php
 require_once "../model/Usuarios.php";

 $usuario = new Usuarios();
 $nombre = $_POST["nombre"];
 $apellidos = $_POST["apellidos"];
 $email = $_POST["email"];
 $numero = $_POST["numeroTelefono"];
 $password = $_POST["password"];
 $fecha = $_POST["fechaNac"];
 $genero = $_POST["genero"];
 $usuario->insertarUsuario($nombre,$apellidos,$email,$numero,
 $password,$fecha,$genero);
 header("location:../view/usuario/inicioSesion.php");