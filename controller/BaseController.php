<?php
require_once __DIR__ . "/../model/Conexion.php";

class BaseController {
    protected $db;

    public function __construct() {
        $conexion = new Conexion();
        $this->db = $conexion->connect();
    }
}