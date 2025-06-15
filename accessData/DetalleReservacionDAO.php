<?php
require_once __DIR__.'/../misc/Conexion.php';
require_once __DIR__.'/../model/DetalleReservacionH.php';

class DetalleReservacionDAO {

    private $pdo;

    public function __construct() {
        $this->pdo = Conexion::conectar();
    }

    public function obtenerDatos() {
        $stmt = $this->pdo->query("SELECT * FROM detalleReservacionh");

        $result = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new DetalleReservacionH(
                $row['idDetalle'],
                $row['idReservacion'],
                $row['idHabitacion']
            );
        }

        return $result;
    }

    public function obtenerPorId($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM u484426513_ms225.detalleReservacionh WHERE idDetalle = ?;");
        $stmt->execute([$id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new DetalleReservacionH(
            $row['idDetalle'],
            $row['idReservacion'],
            $row['idHabitacion']
        );
    }

    public function insertar(DetalleReservacionH $objeto) {
        $sql = "INSERT INTO u484426513_ms225.detalleReservacionH(idReservacion, idHabitacion) VALUES (?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $objeto->idReservacion,
            $objeto->idHabitacion
        ]);
    }
    public function eliminar($id) {
    $sql = "DELETE FROM u484426513_ms225.detalleReservacionh WHERE idDetalle = ?";
    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute([$id]);
}

public function modificar(DetalleReservacionH $objeto) {
    $sql = "UPDATE u484426513_ms225.detalleReservacionh 
            SET idReservacion = ?, idHabitacion = ?
            WHERE idDetalle = ?";
    
    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute([
        $objeto->idReservacion,
        $objeto->idHabitacion,
        $objeto->idDetalle
    ]);
}
}

?>