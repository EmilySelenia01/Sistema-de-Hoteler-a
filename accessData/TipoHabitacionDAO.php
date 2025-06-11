<?php

require_once _DIR_ . '/../misc/Conexion.php';
require_once _DIR_ . '/../models/TipoHabitacion.php';

class TipoHabitacionDAO {

    private $pdo;

    public function __construct() {
        $this->pdo = Conexion::conectar();
    }

    public function obtenerDatos() {
        $stmt = $this->pdo->query("SELECT * FROM tipo_habitacion");

        $result = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new TipoHabitacion(
                $row['idTipo'],
                $row['nombre'],
                $row['descripcion']
            );
        }

        return $result;
    }

    public function obtenerPorId($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM u484426513_ms225.tipo_habitacion WHERE idTipo = ?;");
        $stmt->execute([$id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new TipoHabitacion(
            $row['idTipo'],
            $row['nombre'],
            $row['descripcion']
        );
    }

    public function insertar(TipoHabitacion $objeto) {
        $sql = "INSERT INTO u484426513_ms225.tipo_habitacion(nombre, descripcion) VALUES (?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $objeto->nombre,
            $objeto->descripcion
        ]);
    }
}

?>