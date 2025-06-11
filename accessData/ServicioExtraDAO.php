<?php
require_once _DIR_ . '/../misc/Conexion.php';
require_once _DIR_ . '/../models/ServicioExtra.php';

class ServicioExtraDAO {

    private $pdo;

    public function __construct() {
        $this->pdo = Conexion::conectar();
    }

    public function obtenerDatos() {
        $stmt = $this->pdo->query("SELECT * FROM servicio_extra");

        $result = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new ServicioExtra(
                $row['idServicio'],
                $row['nombre'],
                $row['descripcion']
            );
        }

        return $result;
    }

    public function obtenerPorId($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM u484426513_ms225.servicio_extra WHERE idServicio = ?;");
        $stmt->execute([$id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new ServicioExtra(
            $row['idServicio'],
            $row['nombre'],
            $row['descripcion']
        );
    }

    public function insertar(ServicioExtra $objeto) {
        $sql = "INSERT INTO u484426513_ms225.servicio_extra(nombre, descripcion) VALUES (?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $objeto->nombre,
            $objeto->descripcion
        ]);
    }
}

?>