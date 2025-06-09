<?php
class Paquete {
    public $idPaquete;
    public $nombre;
    public $descripcion;
    public $precio;

    public function __construct($idPaquete = null, $nombre = null, $descripcion = null, $precio = null) {
        $this->idPaquete = $idPaquete;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
    }
}

?>