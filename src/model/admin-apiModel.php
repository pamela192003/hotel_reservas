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

    public function listarReservas(){
        $respuesta = array();
        $sql = $this->conexion->query("SELECT * FROM reservas");
        while ($objeto = $sql->fetch_object()) {
            array_push($respuesta, $objeto);
        }
        return $respuesta;
    }
    public function registrarUsuario($nombre, $apellido, $usuario, $telefono, $passhash,$rol){
        $sql = $this->conexion->query("INSERT INTO usuarios (nombre, apellido, usuario, telefono, password, rol) VALUES ('$nombre',' $apellido', '$usuario',' $telefono', '$passhash','$rol')");
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













    public function actualizarPassword($id, $password)
    {
        $sql = $this->conexion->query("UPDATE usuarios SET password ='$password' WHERE id='$id'");
        return $sql;
    }
    public function updateResetPassword($id, $token, $estado) {
        $sql = $this->conexion->query("UPDATE usuarios SET token_password ='$token' , reset_password ='$estado' WHERE id='$id'");
        return $sql;
    }
    public function buscarUsuarioByDni($dni)
    {
        $sql = $this->conexion->query("SELECT * FROM usuarios WHERE dni='$dni'");
        $sql = $sql->fetch_object();
        return $sql;
    }

    
    public function buscarUsuarioByNomAp($nomap)
    {
        $sql = $this->conexion->query("SELECT * FROM usuarios WHERE nombres_apellidos='$nomap'");
        $sql = $sql->fetch_object();
        return $sql;
    }
    public function buscarUsuarioByApellidosNombres_like($dato)
    {
        $sql = $this->conexion->query("SELECT * FROM usuarios WHERE nombres_apellidos LIKE '%$dato%'");
        $sql = $sql->fetch_object();
        return $sql;
    }
    public function buscarUsuariosOrdenados()
    {
        $arrRespuesta = array();
        $sql = $this->conexion->query("SELECT * FROM usuarios WHERE estado='1' ORDER BY nombres_apellidos ASC ");
        while ($objeto = $sql->fetch_object()) {
            array_push($arrRespuesta, $objeto);
        }
        return $arrRespuesta;
    }
 



}