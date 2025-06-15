<?php

require_once __DIR__.'/../misc/Conexion.php';
require_once __DIR__.'/../model/ConsumoH.php';

class ConsumoDAO {

    private $pdo;

    public function __construct() {
        $this->pdo = Conexion::conectar();
    }

    public function obtenerDatos() {
        $stmt = $this->pdo->query("SELECT * FROM consumoh");

        $result = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new ConsumoH(
                $row['idConsumo'],
                $row['idReservacion'],
                $row['idServicio'],
                $row['cantidad'],
                $row['fecha']
            );
        }

        return $result;
    }

    public function obtenerPorId($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM u484426513_ms225.consumoh WHERE idConsumo = ?;");
        $stmt->execute([$id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new ConsumoH(
            $row['idConsumo'],
            $row['idReservacion'],
            $row['idServicio'],
            $row['cantidad'],
            $row['fecha']
        );
    }

    public function insertar(ConsumoH $objeto) {
        $sql = "INSERT INTO u484426513_ms225.consumoh(idReservacion, idServicio, cantidad, fecha) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $objeto->idReservacion,
            $objeto->idServicio,
            $objeto->cantidad,
            $objeto->fecha
        ]);
    }
     public function eliminar($id) {
    $sql = "DELETE FROM u484426513_ms225.consumoh WHERE idConsumo = ?";
    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute([$id]);
    }
    public function modificar(ConsumoH $objeto) {
    $sql = "UPDATE u484426513_ms225.consumoh 
            SET idReservacion = ?, idServicio = ?, cantidad = ?, fecha = ?
            WHERE idConsumo = ?";
    
    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute([
        $objeto->idReservacion,
        $objeto->idServicio,
        $objeto->cantidad,
        $objeto->fecha,
        $objeto->idConsumo // este es el ID del registro que se actualiza
    ]);
    }


}

?>