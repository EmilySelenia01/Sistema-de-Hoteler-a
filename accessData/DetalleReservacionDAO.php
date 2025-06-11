<?php
require_once _DIR_ . '/../misc/Conexion.php';
require_once _DIR_ . '/../models/DetalleReservacion.php';

class DetalleReservacionDAO {

    private $pdo;

    public function __construct() {
        $this->pdo = Conexion::conectar();
    }

    public function obtenerDatos() {
        $stmt = $this->pdo->query("SELECT * FROM detalleReservacion");

        $result = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new DetalleReservacion(
                $row['idDetalle'],
                $row['idReservacion'],
                $row['idHabitacion']
            );
        }

        return $result;
    }

    public function obtenerPorId($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM u484426513_ms225.detalleReservacion WHERE idDetalle = ?;");
        $stmt->execute([$id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new DetalleReservacion(
            $row['idDetalle'],
            $row['idReservacion'],
            $row['idHabitacion']
        );
    }

    public function insertar(DetalleReservacion $objeto) {
        $sql = "INSERT INTO u484426513_ms225.detalleReservacion(idReservacion, idHabitacion) VALUES (?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $objeto->idReservacion,
            $objeto->idHabitacion
        ]);
    }
}

?>