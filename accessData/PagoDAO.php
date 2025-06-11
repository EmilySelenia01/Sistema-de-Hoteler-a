<?php
require_once _DIR_ . '/../misc/Conexion.php';
require_once _DIR_ . '/../models/Pago.php';

class PagoDAO {

    private $pdo;

    public function __construct() {
        $this->pdo = Conexion::conectar();
    }

    public function obtenerDatos() {
        $stmt = $this->pdo->query("SELECT * FROM pago");

        $result = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new Pago(
                $row['idPago'],
                $row['idReservacion'],
                $row['monto'],
                $row['metodoPago'],
                $row['fechaPago']
            );
        }

        return $result;
    }

    public function obtenerPorId($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM u484426513_ms225.pago WHERE idPago = ?;");
        $stmt->execute([$id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Pago(
            $row['idPago'],
            $row['idReservacion'],
            $row['monto'],
            $row['metodoPago'],
            $row['fechaPago']
        );
    }

    public function insertar(Pago $objeto) {
        $sql = "INSERT INTO u484426513_ms225.pago(idReservacion, monto, metodoPago, fechaPago) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $objeto->idReservacion,
            $objeto->monto,
            $objeto->metodoPago,
            $objeto->fechaPago
        ]);
    }
}

?>