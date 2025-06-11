<?php
require_once _DIR_ . '/../misc/Conexion.php';
require_once _DIR_ . '/../models/Paquete.php';

class PaqueteDAO {

    private $pdo;

    public function __construct() {
        $this->pdo = Conexion::conectar();
    }

    public function obtenerDatos() {
        $stmt = $this->pdo->query("SELECT * FROM paquete");

        $result = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new Paquete(
                $row['idPaquete'],
                $row['nombre'],
                $row['descripcion'],
                $row['precio']
            );
        }

        return $result;
    }

    public function obtenerPorId($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM u484426513_ms225.paquete WHERE idPaquete = ?;");
        $stmt->execute([$id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Paquete(
            $row['idPaquete'],
            $row['nombre'],
            $row['descripcion'],
            $row['precio']
        );
    }

    public function insertar(Paquete $objeto) {
        $sql = "INSERT INTO u484426513_ms225.paquete(nombre, descripcion, precio) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $objeto->nombre,
            $objeto->descripcion,
            $objeto->precio
        ]);
    }
}

?>