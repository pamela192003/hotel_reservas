<?php
require_once "../library/conexion.php";

class TokensApiModel
{

    private $conexion;
    function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->connect();
    }
    public function listarTokensByClient($id_client){
        $respuesta = array();
        $sql = $this->conexion->query("SELECT * FROM tokens_api WHERE id_client_api = '$id_client'");
        while ($objeto = $sql->fetch_object()) {
            array_push($respuesta, $objeto);
        }
        return $respuesta;
    }
 public function contarTokensByClient($id_client){
    $sql = $this->conexion->query("SELECT COUNT(*) AS total FROM tokens_api WHERE id_client_api = '$id_client'");
    $resultado = $sql->fetch_object();
    return $resultado->total;
}

     public function generarTokenParaCliente($id_cliente) {
        // Validar que el id_cliente sea un entero positivo
        if (!is_numeric($id_cliente) || $id_cliente <= 0) {
            return false;
        }
        $fecha_actual = date("Ymd");
        // Generar token seguro
        $token = bin2hex(random_bytes(32)); // 64 caracteres hex

        $token_final = $token.'-'.$fecha_actual.'-'.$id_cliente;

        // Preparar la consulta
        $sql = $this->conexion->prepare("INSERT INTO tokens_api (id_client_api, token) VALUES (?, ?)");

        if (!$sql) {
            error_log("Error en la preparación de la consulta: " . $this->conexion->error);
            return false;
        }

        // Vincular parámetros: 'i' = integer, 's' = string
        $sql->bind_param("is", $id_cliente, $token_final);

        // Ejecutar
        if ($sql->execute()) {
            $sql->close();
            return true;
        } else {
            error_log("Error al ejecutar la inserción del token: " . $sql->error);
            $sql->close();
            return false;
        }
    }



        public function cambiarEstado($id_token,$estado){
        if($estado == 0){
            $sql = $this->conexion->query("UPDATE tokens_api SET estado = 1 WHERE id='$id_token'");
        }else if($estado == 1){
            $sql = $this->conexion->query("UPDATE tokens_api SET estado = 0 WHERE id='$id_token'");
        }
        return $sql;
    }


}
