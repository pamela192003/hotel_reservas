<?php
require_once "../library/conexion.php";

class ReservaModel
{

    private $conexion;
    function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->connect();
    }
    public function listarReservas(){
        $respuesta = array();
        $sql = $this->conexion->query("SELECT * FROM reservas");
        while ($objeto = $sql->fetch_object()) {
            array_push($respuesta, $objeto);
        }
        return $respuesta;
    }
    public function registrarReserva($usuario, $habitacion, $hotel, $fecha_inicio, $fecha_fin,$monto){
        $sql = $this->conexion->query("INSERT INTO reservas (id_usuario, id_habitacion, id_hotel, fecha_inicio, fecha_fin, monto_total) VALUES ('$usuario',' $habitacion', '$hotel',' $fecha_inicio', '$fecha_fin','$monto')");
        if ($sql) {
            $sql = $this->conexion->insert_id;
        } else {
            $sql = 0;
        }
        return $sql;
    }
    public function actualizarUsuario($iduser,$nombre,$apellido,$usuario,$telefono,$rol,$estado)
    {
        $sql = $this->conexion->query("UPDATE usuarios SET nombre='$nombre',apellido='$apellido',usuario='$usuario',telefono='$telefono',rol='$rol',activo ='$estado' WHERE id_usuario='$iduser'");
        return $sql;
    }
  public function buscarUsuarioById($id)
    {
        $sql = $this->conexion->query("SELECT * FROM usuarios WHERE id_usuario='$id'");
        $sql = $sql->fetch_object();
        return $sql;
    }
      public function buscarUsuarioByUsuarioName($usuario)
    {
        $sql = $this->conexion->query("SELECT * FROM usuarios WHERE usuario='$usuario'");
        $sql = $sql->fetch_object();
        return $sql;
    }
}