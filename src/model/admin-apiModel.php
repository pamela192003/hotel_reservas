<?php
require_once "../library/conexion.php";

class ApiModel
{

    private $conexion;
    function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->connect();
    }
    public function listarReservasPorEstado($estado)
    {
        $respuesta = array();
        $sql = $this->conexion->query("SELECT * FROM reservas WHERE estado='$estado'");
        while ($objeto = $sql->fetch_object()) {
            array_push($respuesta, $objeto);
        }
        return $respuesta;
    }

    public function validarEstadoCliente($id_cliente){
        $sql = $this->conexion->query("SELECT estado FROM client_api WHERE id='$id_cliente'");
        $sql = $sql->fetch_object();
        return $sql->estado;
    }
    public function listarReservas(){
        $respuesta = array();
        $sql = $this->conexion->query("SELECT * FROM reservas");
        while ($objeto = $sql->fetch_object()) {
            array_push($respuesta, $objeto);
        }
        return $respuesta;
    }

  public function buscarUsuarioById($id)
    {
        $sql = $this->conexion->query("SELECT * FROM usuarios WHERE id_usuario='$id'");
        $sql = $sql->fetch_object();
        return $sql;
    }

    public function validarClienteToken($id_cliente , $token){
        $sql = $this->conexion->query("SELECT * FROM tokens_api WHERE id_client_api='$id_cliente' AND token='$token' AND estado=1");
        if($sql->num_rows > 0){
            return true;
        }else{
            return false;
        }
    }

}