<?php

require_once _DIR_ . '/../misc/Conexion.php';
require_once _DIR_ . '/../models/HabitacionPaquete.php';

class HabitacionPaqueteDAO {

    private $pdo;

    public function __construct() {
        $this->pdo = Conexion::conectar();
    }

    public function obtenerDatos() {
        $stmt = $this->pdo->query("SELECT * FROM habitacion_paquete");

        $result = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new HabitacionPaquete(
                $row['idHabitacion'],
                $row['idPaquete']
            );
        }

        return $result;
    }

    public function obtenerPorId($idHabitacion, $idPaquete) {
        $stmt = $this->pdo->prepare("SELECT * FROM u484426513_ms225.habitacion_paquete WHERE idHabitacion = ? AND idPaquete = ?;");
        $stmt->execute([$idHabitacion, $idPaquete]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new HabitacionPaquete(
                $row['idHabitacion'],
                $row['idPaquete']
            );
        } else {
            return null;
        }
    }

    public function insertar(HabitacionPaquete $objeto) {
        $sql = "INSERT INTO u484426513_ms225.habitacion_paquete(idHabitacion, idPaquete) VALUES (?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $objeto->idHabitacion,
            $objeto->idPaquete
        ]);
    }
}

?>