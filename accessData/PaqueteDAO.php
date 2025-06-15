<?php
require_once __DIR__.'/../misc/Conexion.php';
require_once __DIR__. '/../model/PaqueteH.php';

class PaqueteDAO {

    private $pdo;

    public function __construct() {
        $this->pdo = Conexion::conectar();
    }

    public function obtenerDatos() {
        $stmt = $this->pdo->query("SELECT * FROM paqueteh");

        $result = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new PaqueteH(
                $row['idPaquete'],
                $row['nombre'],
                $row['descripcion'],
                $row['precio']
            );
        }

        return $result;
    }

    public function obtenerPorId($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM u484426513_ms225.paqueteh WHERE idPaquete = ?;");
        $stmt->execute([$id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new PaqueteH(
            $row['idPaquete'],
            $row['nombre'],
            $row['descripcion'],
            $row['precio']
        );
    }

    public function insertar(PaqueteH $objeto) {
        $sql = "INSERT INTO u484426513_ms225.paqueteh(nombre, descripcion, precio) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $objeto->nombre,
            $objeto->descripcion,
            $objeto->precio
        ]);
    }
}

?>