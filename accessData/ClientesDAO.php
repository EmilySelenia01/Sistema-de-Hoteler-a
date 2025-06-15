<?php

require_once __DIR__ .'/../model/ClienteH.php';
require_once __DIR__ .'/../misc/Conexion.php';

class ClientesDAO {

    private $pdo;

    public function __construct() {
        $this->pdo = Conexion::conectar();
    }

    public function obtenerDatos() {
        $stmt = $this->pdo->query("SELECT * FROM clienteh");

        $result = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new ClienteH($row['idCliente'], $row['nombre'], $row['correo']);
        }

        return $result;
    }

    public function obtenerPorId($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM u484426513_ms225.clienteh WHERE idCliente = ?;");
        $stmt->execute([$id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new ClienteH($row['idCliente'], $row['nombre'], $row['correo']);
    }

    public function insertar(ClienteH $objeto) {
        $sql = "INSERT INTO u484426513_ms225.clienteh(nombre, correo) VALUES (?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$objeto->nombre, $objeto->correo]);
    }
    
    public function eliminar($id) {
        $sql = "DELETE FROM u484426513_ms225.clienteh WHERE idCliente = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
    public function modificar(ClienteH $objeto) {
    $sql = "UPDATE u484426513_ms225.clienteh 
            SET nombre = ?, correo = ?
            WHERE idCliente = ?";

    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute([
        $objeto->nombre,
        $objeto->correo,
        $objeto->idCliente
    ]);

    //

    
}
}

?>