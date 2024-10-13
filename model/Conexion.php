<?php
class Conexion {
    private $conexion;

    public function __construct() {
        try {
           
            $this->conexion = new PDO("mysql:host=127.0.0.1; dbname=Compusof", "root", "");
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);       
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function connect() {
        // Retorna la conexión establecida
        return $this->conexion;
    }
}
