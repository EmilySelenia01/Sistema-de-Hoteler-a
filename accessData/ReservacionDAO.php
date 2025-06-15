<?php

require_once __DIR__ . '/../misc/Conexion.php';
require_once __DIR__ . '/../model/ReservacionH.php';

class ReservacionDAO {

    private $pdo;

    public function __construct() {
        $this->pdo = Conexion::conectar();
    }

    public function obtenerDatos() {
        $stmt = $this->pdo->query("SELECT * FROM reservacionh");

        $result = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new ReservacionH(
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
        $stmt = $this->pdo->prepare("SELECT * FROM u484426513_ms225.reservacionh WHERE idReservacion = ?;");
        $stmt->execute([$id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new ReservacionH(
            $row['idReservacion'],
            $row['idCliente'],
            $row['fechaInicio'],
            $row['fechaFin'],
            $row['estado']
        );
    }

    public function insertar(ReservacionH $objeto) {
        $sql = "INSERT INTO u484426513_ms225.reservacionh(idCliente, fechaInicio, fechaFin, estado) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $objeto->idCliente,
            $objeto->fechaInicio,
            $objeto->fechaFin,
            $objeto->estado
        ]);
    }


        public function eliminar($id) {
    $sql = "DELETE FROM u484426513_ms225.reservacionh WHERE idReservacion = ?";
    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute([$id]);
    }

    public function modificar(ReservacionH $objeto) {
    $sql = "UPDATE u484426513_ms225.reservacionh 
            SET idCliente = ?, fechaInicio = ?, fechaFin = ?, estado = ?
            WHERE idReservacion = ?";
    
    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute([
        $objeto->idCliente,
        $objeto->fechaInicio,
        $objeto->fechaFin,
        $objeto->estado,
        $objeto->idReservacion
    ]);
    }

}

?>