<?php

require_once _DIR_.'/../misc/Conexion.php';
require_once _DIR_.'/../models/Cliente.php';

class ClientesDAO {

    private $pdo;

    public function __construct() {
        $this->pdo = Conexion::conectar();
    }

    public function obtenerDatos() {
        $stmt = $this->pdo->query("SELECT * FROM cliente");

        $result = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new Cliente($row['idCliente'], $row['nombre'], $row['correo']);
        }

        return $result;
    }

    public function obtenerPorId($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM u484426513_ms225.cliente WHERE idCliente = ?;");
        $stmt->execute([$id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Cliente($row['idCliente'], $row['nombre'], $row['correo']);
    }

    public function insertar(Cliente $objeto) {
        $sql = "INSERT INTO u484426513_ms225.clientes(nombre, correo) VALUES (?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$objeto->nombre, $objeto->correo]);
    }
}

?>