<?php

require_once __DIR__ . '/../misc/Conexion.php';
require_once __DIR__ .'/../model/HabitacionH.php';

class HabitacionDAO {

    private $pdo;

    public function __construct() {
        $this->pdo = Conexion::conectar();
    }

    public function obtenerDatos() {
        $stmt = $this->pdo->query("SELECT * FROM habitacionh");

        $result = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new HabitacionH(
                $row['idHabitacion'],
                $row['numero'],
                $row['idTipo'],
                $row['precio']
            );
        }

        return $result;
    }

    public function obtenerPorId($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM u484426513_ms225.habitacionh WHERE idHabitacion = ?;");
        $stmt->execute([$id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new HabitacionH(
            $row['idHabitacion'],
            $row['numero'],
            $row['idTipo'],
            $row['precio']
        );
    }

    public function insertar(HabitacionH $objeto) {
        $sql = "INSERT INTO u484426513_ms225.habitacionh(numero, idTipo, precio) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $objeto->numero,
            $objeto->idTipo,
            $objeto->precio
        ]);
    }
}

?>