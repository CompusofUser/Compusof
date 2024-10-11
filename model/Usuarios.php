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
}