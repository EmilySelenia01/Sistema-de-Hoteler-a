<?php
require_once __DIR__ .'/../misc/Conexion.php';
require_once __DIR__ .'/../model/ServicioExtraH.php';

class ServicioExtraDAO {

    private $pdo;

    public function __construct() {
        $this->pdo = Conexion::conectar();
    }

    public function obtenerDatos() {
        $stmt = $this->pdo->query("SELECT * FROM servicioeExtrah");

        $result = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new ServicioExtraH(
                $row['idServicio'],
                $row['nombre'],
                $row['descripcion']
            );
        }

        return $result;
    }

    public function obtenerPorId($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM u484426513_ms225.servicioExtrah WHERE idServicio = ?;");
        $stmt->execute([$id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new ServicioExtraH(
            $row['idServicio'],
            $row['nombre'],
            $row['descripcion']
        );
    }

    public function insertar(ServicioExtraH $objeto) {
        $sql = "INSERT INTO u484426513_ms225.servicioExtrah(nombre, descripcion) VALUES (?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $objeto->nombre,
            $objeto->descripcion
        ]);
    }
}

?>