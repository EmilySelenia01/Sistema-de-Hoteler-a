<?php

require_once _DIR_ . '/../misc/Conexion.php';
require_once _DIR_ . '/../models/MantenimientoHabitacion.php';

class MantenimientoHabitacionDAO {

    private $pdo;

    public function __construct() {
        $this->pdo = Conexion::conectar();
    }

    public function obtenerDatos() {
        $stmt = $this->pdo->query("SELECT * FROM mantenimiento_habitacion");

        $result = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new MantenimientoHabitacion(
                $row['idMantenimiento'],
                $row['idHabitacion'],
                $row['descripcion'],
                $row['fecha']
            );
        }

        return $result;
    }

    public function obtenerPorId($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM u484426513_ms225.mantenimiento_habitacion WHERE idMantenimiento = ?;");
        $stmt->execute([$id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new MantenimientoHabitacion(
            $row['idMantenimiento'],
            $row['idHabitacion'],
            $row['descripcion'],
            $row['fecha']
        );
    }

    public function insertar(MantenimientoHabitacion $objeto) {
        $sql = "INSERT INTO u484426513_ms225.mantenimiento_habitacion(idHabitacion, descripcion, fecha) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $objeto->idHabitacion,
            $objeto->descripcion,
            $objeto->fecha
        ]);
    }
}

?>