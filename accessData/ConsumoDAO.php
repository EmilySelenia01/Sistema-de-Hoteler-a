<?php

require_once _DIR_ . '/../misc/Conexion.php';
require_once _DIR_ . '/../models/Consumo.php';

class ConsumoDAO {

    private $pdo;

    public function __construct() {
        $this->pdo = Conexion::conectar();
    }

    public function obtenerDatos() {
        $stmt = $this->pdo->query("SELECT * FROM consumo");

        $result = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new Consumo(
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
        $stmt = $this->pdo->prepare("SELECT * FROM u484426513_ms225.consumo WHERE idConsumo = ?;");
        $stmt->execute([$id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Consumo(
            $row['idConsumo'],
            $row['idReservacion'],
            $row['idServicio'],
            $row['cantidad'],
            $row['fecha']
        );
    }

    public function insertar(Consumo $objeto) {
        $sql = "INSERT INTO u484426513_ms225.consumo(idReservacion, idServicio, cantidad, fecha) VALUES (?, ?, ?, ?)";
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