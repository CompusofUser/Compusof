<?php
require_once __DIR__ . "/BaseController.php";
require_once __DIR__ . "/../model/Usuarios.php";

class UsuariosController extends BaseController {
    private $usuariosModel;

    public function __construct() {
        parent::__construct();
        $this->usuariosModel = new Usuarios();
    }

    public function registrarUsuario($nombre, $apellidos, $correo, $numeroTelefono, $password, $fechaNac, $genero) {
        return $this->usuariosModel->insertarUsuario($nombre, $apellidos, $correo, $numeroTelefono, $password, $fechaNac, $genero);
    }

    public function iniciarSesion($email, $password) {
        return $this->usuariosModel->inicioSesion($email, $password);
    }

    public function solicitarRecuperacionContrasena($email) {
        return $this->usuariosModel->solicitarRecuperacion($email);
    }

    public function restablecerContrasena($token, $newPassword) {
        return $this->usuariosModel->restablecerPassword($token, $newPassword);
    }
}