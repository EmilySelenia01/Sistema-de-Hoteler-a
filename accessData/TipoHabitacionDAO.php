<?php

require_once __DIR__ .'/../misc/Conexion.php';
require_once __DIR__ . '/../model/TipoHabitacionH.php';

class TipoHabitacionDAO {

    private $pdo;

    public function __construct() {
        $this->pdo = Conexion::conectar();
    }

    public function obtenerDatos() {
        $stmt = $this->pdo->query("SELECT * FROM tipoHabitacionh");

        $result = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new TipoHabitacionH(
                $row['idTipo'],
                $row['nombre'],
                $row['descripcion']
            );
        }

        return $result;
    }

    public function obtenerPorId($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM u484426513_ms225.tipoHabitacionh WHERE idTipo = ?;");
        $stmt->execute([$id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new TipoHabitacionH(
            $row['idTipo'],
            $row['nombre'],
            $row['descripcion']
        );
    }

    public function insertar(TipoHabitacionH $objeto) {
        $sql = "INSERT INTO u484426513_ms225.tipoHabitacionh(nombre, descripcion) VALUES (?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $objeto->nombre,
            $objeto->descripcion
        ]);
    }

    public function eliminar($id) {
    $sql = "DELETE FROM u484426513_ms225.tipoHabitacionh WHERE idTipo = ?";
    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute([$id]);
}

public function modificar(TipoHabitacionH $objeto) {
    $sql = "UPDATE u484426513_ms225.tipoHabitacionh 
            SET nombre = ?, descripcion = ?
            WHERE idTipo = ?";
    
    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute([
        $objeto->nombre,
        $objeto->descripcion,
        $objeto->idTipo
    ]);
}

}

?>