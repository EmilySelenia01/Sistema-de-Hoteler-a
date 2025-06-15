<?php

require_once __DIR__ .'/../misc/Conexion.php';
require_once __DIR__ .'/../model/HabitacionPaqueteH.php';

class HabitacionPaqueteDAO {

    private $pdo;

    public function __construct() {
        $this->pdo = Conexion::conectar();
    }

    public function obtenerDatos() {
        $stmt = $this->pdo->query("SELECT * FROM habitacionPaqueteh");

        $result = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new HabitacionPaqueteH(
                $row['idHabitacion'],
                $row['idPaquete']
            );
        }

        return $result;
    }

    public function obtenerPorId($idHabitacion, $idPaquete) {
        $stmt = $this->pdo->prepare("SELECT * FROM u484426513_ms225.habitacionPaqueteh WHERE idHabitacion = ? AND idPaquete = ?;");
        $stmt->execute([$idHabitacion, $idPaquete]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new HabitacionPaqueteH(
                $row['idHabitacion'],
                $row['idPaquete']
            );
        } else {
            return null;
        }
    }

    public function insertar(HabitacionPaqueteH $objeto) {
        $sql = "INSERT INTO u484426513_ms225.habitacionPaqueteh(idHabitacion, idPaquete) VALUES (?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $objeto->idHabitacion,
            $objeto->idPaquete
        ]);
    }
}

?>