<?php
require_once "Conexion.php";

class Usuarios extends Conexion {
    private $strNombre, $strApellidos;
    private $strCorreo, $numeroTelefono;
    private $password;
    private $fechaNac, $genero;
    private $conexion;

    public function __construct() {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->connect();
    }

    public function insertarUsuario($nombre, $apellidos, $correo, $numeroTelefono, $password, $fechaNac, $genero) {
        $this->strNombre = $nombre;
        $this->strApellidos = $apellidos;
        $this->strCorreo = $correo;
        $this->numeroTelefono = $numeroTelefono;
        $this->password = password_hash($password, PASSWORD_BCRYPT);
        $this->fechaNac = $fechaNac;
        $this->genero = $genero;

        $sql = "INSERT INTO usuarios(nombre, apellidos, email, numeroTelefono, password, fechaNac, genero) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $insert = $this->conexion->prepare($sql);

        $arrData = array($this->strNombre, $this->strApellidos, $this->strCorreo, $this->numeroTelefono, $this->password, $this->fechaNac, $this->genero);
        $resInsert = $insert->execute($arrData);
        return $resInsert;
    }

    public function inicioSesion($email, $password) {
        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $select = $this->conexion->prepare($sql);
        $select->execute(array("email" => $email));
        
        $resultado = $select->fetch(PDO::FETCH_ASSOC);
        
        if ($resultado && password_verify($password, $resultado['password'])) {
            session_start();
            $_SESSION["email"] = $email;
            return "Inicio de sesión exitoso. Hola " . htmlspecialchars($email);
        } else {
            return "Email o contraseña incorrectos";
        }
    }

    public function solicitarRecuperacion($email) {
        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $select = $this->conexion->prepare($sql);
        $select->execute(array("email" => $email));
        
        $resultado = $select->fetch(PDO::FETCH_ASSOC);
        
        if ($resultado) {
            $token = bin2hex(random_bytes(32));
            $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));
            
            $updateSql = "UPDATE usuarios SET reset_token = :token, reset_token_expires = :expiry WHERE email = :email";
            $update = $this->conexion->prepare($updateSql);
            $update->execute(array(
                "token" => $token,
                "expiry" => $expiry,
                "email" => $email
            ));
            
            $reset_link = "http://localhost/Compusof/view/usuario/reset_password.php?token=" . $token;
            $to = $email;
            $subject = "Recuperación de contraseña - Compusof";
            $message = "Haga clic en el siguiente enlace para restablecer su contraseña: " . $reset_link;
            $headers = "From: noreply@compusof.mx";
            
            if(mail($to, $subject, $message, $headers)) {
                return "Se ha enviado un enlace de recuperación a su correo electrónico.";
            } else {
                return "Hubo un problema al enviar el correo. Por favor, intente nuevamente.";
            }
        } else {
            return "No se encontró ninguna cuenta con ese correo electrónico.";
        }
    }

    public function restablecerPassword($token, $newPassword) {
        $sql = "SELECT * FROM usuarios WHERE reset_token = :token AND reset_token_expires > NOW()";
        $select = $this->conexion->prepare($sql);
        $select->execute(array("token" => $token));
        
        $resultado = $select->fetch(PDO::FETCH_ASSOC);
        
        if ($resultado) {
            $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
            
            $updateSql = "UPDATE usuarios SET password = :password, reset_token = NULL, reset_token_expires = NULL WHERE idUsuario = :id";
            $update = $this->conexion->prepare($updateSql);
            $update->execute(array(
                "password" => $hashedPassword,
                "id" => $resultado['idUsuario']
            ));
            
            header('location:\Compusof\view\usuario\sesion.php');
        } else {
            return "El enlace de restablecimiento no es válido o ha expirado.";
        }
    }
}