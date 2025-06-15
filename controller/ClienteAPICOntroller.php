<?php

require_once __DIR__.'/../accessData/ClientesDAO.php';


class ClientesApiController{


    private $dao;

    public function __construct(){
        $this->dao = new ClientesDAO();
    }

    public function manejarRequest(){
        $metodo = $_SERVER['REQUEST_METHOD'];

        //POST, GET, PUT DELETE
        switch ($metodo) 
        {
            case 'GET':
                # code...
                    $response = $this->dao->obtenerDatos();
                    echo json_encode($response);
                break;

            case 'POST':
                # code...
                    $datos = json_decode(file_get_contents("php://input"), true);

                                    
                    $idCliente = $datos['idCliente'];
                    $nombre = $datos['nombre'];
                    $correo = $datos['correo'];

                    $objeto = new ClientesH(null, $idCliente, $nombre, $correo);

                    $this->dao->insertar($objeto);


                    echo json_encode(["mensaje" => "Datos almacenados"]);

                break;   
            case 'PUT'  
            break;
            case'DElETE'
            break;
        }
    }


}

?>