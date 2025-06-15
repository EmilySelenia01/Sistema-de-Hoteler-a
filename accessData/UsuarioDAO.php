<?php

require_once __DIR__ .'/../misc/Conexion.php';
require_once __DIR__ . '/../model/UsuarioH.php';

class UsuarioDAO {

    private $pdo;

    public function __construct() {
        $this->pdo = Conexion::conectar();
    }

    public function obtenerDatos() {
        $stmt = $this->pdo->query("SELECT * FROM usuarioh");

        $result = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new UsuarioH(
                $row['idUsuario'],
                $row['nombreUsuario'],
                $row['claveHash'],
                $row['rol'],
                $row['estado']
            );
        }

        return $result;
    }

    public function obtenerPorId($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM u484426513_ms225.usuarioh WHERE idUsuario = ?;");
        $stmt->execute([$id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new UsuarioH(
            $row['idUsuario'],
            $row['nombreUsuario'],
            $row['claveHash'],
            $row['rol'],
            $row['estado']
        );
    }

    public function insertar(Usuario $objeto) {
        $sql = "INSERT INTO u484426513_ms225.usuarioh(nombreUsuario, claveHash, rol, estado) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $objeto->nombreUsuario,
            $objeto->claveHash,
            $objeto->rol,
            $objeto->estado
        ]);
    }
}

?>