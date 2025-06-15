<?php

require_once __DIR__.'/../misc/Conexion.php';
require_once __DIR__.'/../model/ConsumoH.php';

class ConsumoDAO {

    private $pdo;

    public function __construct() {
        $this->pdo = Conexion::conectar();
    }

    public function obtenerDatos() {
        $stmt = $this->pdo->query("SELECT * FROM ConsumoH");

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
        $stmt = $this->pdo->prepare("SELECT * FROM u484426513_ms225.ConsumoH WHERE idConsumo = ?;");
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
        $sql = "INSERT INTO u484426513_ms225.ConsumoH(idReservacion, idServicio, cantidad, fecha) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $objeto->idReservacion,
            $objeto->idServicio,
            $objeto->cantidad,
            $objeto->fecha
        ]);
    }
}

?>