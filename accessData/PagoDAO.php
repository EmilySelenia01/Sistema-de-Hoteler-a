<?php
require_once __DIR__ . '/../misc/Conexion.php';
require_once __DIR__ . '/../model/PagoH.php';

class PagoDAO {

    private $pdo;

    public function __construct() {
        $this->pdo = Conexion::conectar();
    }

    public function obtenerDatos() {
        $stmt = $this->pdo->query("SELECT * FROM pagoh");

        $result = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new PagoH(
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
        $stmt = $this->pdo->prepare("SELECT * FROM u484426513_ms225.pagoh WHERE idPago = ?;");
        $stmt->execute([$id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new PagoH(
            $row['idPago'],
            $row['idReservacion'],
            $row['monto'],
            $row['metodoPago'],
            $row['fechaPago']
        );
    }

    public function insertar(PagoH $objeto) {
        $sql = "INSERT INTO u484426513_ms225.pagoh(idReservacion, monto, metodoPago, fechaPago) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $objeto->idReservacion,
            $objeto->monto,
            $objeto->metodoPago,
            $objeto->fechaPago
        ]);
    }

    //
    public function eliminar($id) {
    $sql = "DELETE FROM u484426513_ms225.pagoh WHERE idPago = ?";
    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute([$id]);
    }

    public function modificar(PagoH $objeto) {
    $sql = "UPDATE u484426513_ms225.pagoh 
            SET idReservacion = ?, monto = ?, metodoPago = ?, fechaPago = ?
            WHERE idPago = ?";
    
    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute([
        $objeto->idReservacion,
        $objeto->monto,
        $objeto->metodoPago,
        $objeto->fechaPago,
        $objeto->idPago
    ]);
    }



}

?>