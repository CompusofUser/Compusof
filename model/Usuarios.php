<?php
require_once "Conexion.php";
class Usuarios extends Conexion{
    private $strNombre,$strApellidos;
    private $strCorreo,$numeroTelefono;
    private $password;
    private $fechaNac,$genero;
    private $conexion;
    public function __construct(){
      $this->conexion = new Conexion();
      $this->conexion = $this->conexion->connect();
    }
    public function insertarUsuario($nombre,$apellidos,$correo, $numeroTelefono,$password,$fechaNac,$genero){
        $this->strNombre=$nombre;
        $this->strApellidos=$apellidos;
        $this->strCorreo=$correo;
        $this->numeroTelefono=$numeroTelefono;
        $this->password=password_hash($password,PASSWORD_BCRYPT);
        $this->fechaNac=$fechaNac;
        $this->genero=$genero;

        $sql = "insert into usuarios(nombre,apellidos,email,numeroTelefono,password,fechaNac,genero) values(?,?,?,?,?,?,?)";
        $insert = $this->conexion->prepare($sql);

        $arrData = array($this->strNombre,$this->strApellidos,$this->strCorreo,$this->numeroTelefono,$this->password,$this->fechaNac,$this->genero);
        $resInsert = $insert->execute($arrData);
    }
    public function inicioSesion($email, $password) {
      $sql = "SELECT * FROM usuarios WHERE email = :email";
      $select = $this->conexion->prepare($sql);
      $select->execute(array("email" => $email));
      
      $resultado = $select->fetch(PDO::FETCH_ASSOC);
      
      if ($resultado && password_verify($password, $resultado['password'])) {
          session_start();
          $_SESSION["email"] = $email;
          echo "Inicio de sesión exitoso. Hola " . htmlspecialchars($email);
      } else {
          echo "Email o contraseña incorrectos";
      }
  }
}