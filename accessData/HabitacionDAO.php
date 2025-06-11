<?php

require_once _DIR_ . '/../misc/Conexion.php';
require_once _DIR_ . '/../models/Habitacion.php';

class HabitacionDAO {

    private $pdo;

    public function __construct() {
        $this->pdo = Conexion::conectar();
    }

    public function obtenerDatos() {
        $stmt = $this->pdo->query("SELECT * FROM habitacion");

        $result = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new Habitacion(
                $row['idHabitacion'],
                $row['numero'],
                $row['idTipo'],
                $row['precio']
            );
        }

        return $result;
    }

    public function obtenerPorId($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM u484426513_ms225.habitacion WHERE idHabitacion = ?;");
        $stmt->execute([$id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Habitacion(
            $row['idHabitacion'],
            $row['numero'],
            $row['idTipo'],
            $row['precio']
        );
    }

    public function insertar(Habitacion $objeto) {
        $sql = "INSERT INTO u484426513_ms225.habitacion(numero, idTipo, precio) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $objeto->numero,
            $objeto->idTipo,
            $objeto->precio
        ]);
    }
}

?>