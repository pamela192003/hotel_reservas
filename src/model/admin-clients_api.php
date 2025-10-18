<?php
require_once "../library/conexion.php";

class ClientApiModel
{

    private $conexion;
    function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->connect();
    }
    public function listarClientesApi(){
        $respuesta = array();
        $sql = $this->conexion->query("SELECT * FROM client_api");
        while ($objeto = $sql->fetch_object()) {
            array_push($respuesta, $objeto);
        }
        return $respuesta;
    }
    public function RegistrarClienteApi($ruc, $razon_social, $telefono, $correo){
        $sql = $this->conexion->query("INSERT INTO client_api (ruc, razon_social, telefono, correo) VALUES ('$ruc',' $razon_social', '$telefono',' $correo')");
        if ($sql) {
            $sql = $this->conexion->insert_id;
        } else {
            $sql = 0;
        }
        return $sql;
    }
    public function actualizarClienteApi($id_cliente,$ruc,$razon_social,$telefono,$correo,$estado)
    {
        $sql = $this->conexion->query("UPDATE client_api SET ruc='$ruc',razon_social='$razon_social',telefono='$telefono',correo='$correo',estado='$estado' WHERE id='$id_cliente'");
        return $sql;
    }
  public function buscarClienteById($id)
    {
        $sql = $this->conexion->query("SELECT * FROM client_api WHERE id='$id'");
        $sql = $sql->fetch_object();
        return $sql;
    }
}