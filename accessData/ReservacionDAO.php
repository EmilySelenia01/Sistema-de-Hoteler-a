<?php

require_once _DIR_ . '/../misc/Conexion.php';
require_once _DIR_ . '/../models/Reservacion.php';

class ReservacionDAO {

    private $pdo;

    public function __construct() {
        $this->pdo = Conexion::conectar();
    }

    public function obtenerDatos() {
        $stmt = $this->pdo->query("SELECT * FROM reservacion");

        $result = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new Reservacion(
                $row['idReservacion'],
                $row['idCliente'],
                $row['fechaInicio'],
                $row['fechaFin'],
                $row['estado']
            );
        }

        return $result;
    }

    public function obtenerPorId($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM u484426513_ms225.reservacion WHERE idReservacion = ?;");
        $stmt->execute([$id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Reservacion(
            $row['idReservacion'],
            $row['idCliente'],
            $row['fechaInicio'],
            $row['fechaFin'],
            $row['estado']
        );
    }

    public function insertar(Reservacion $objeto) {
        $sql = "INSERT INTO u484426513_ms225.reservacion(idCliente, fechaInicio, fechaFin, estado) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $objeto->idCliente,
            $objeto->fechaInicio,
            $objeto->fechaFin,
            $objeto->estado
        ]);
    }
}

?>