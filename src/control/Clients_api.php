<?php
session_start();
require_once('../model/admin-sesionModel.php');
require_once('../model/admin-clients_api.php');
require_once('../model/admin-tokens_api.php');
require_once('../model/adminModel.php');

$tipo = $_GET['tipo'];

//instanciar la clase categoria model
$objSesion = new SessionModel();
$objClient = new ClientApiModel();
$objTokens = new TokensApiModel();
$objAdmin = new AdminModel();

//variables de sesion
$id_sesion = $_REQUEST['sesion'];
$token = $_REQUEST['token'];

if ($tipo == "registrarCliente") {
    $arr_Respuesta = array('status' => false, 'mensaje' => 'Error_Sesion');
    if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {
        if ($_POST) {
            $ruc = (int)($_POST['ruc']); 
            $razon = $_POST['empresaCliente'];
            $telefono = $_POST['telefonoCliente'];
            $correo = $_POST['emailCliente'];

            if ($ruc == ""||strlen($ruc) !== 11 || $razon == "" || $telefono == "" || $correo == "") {
                $arr_Respuesta = array('status' => false, 'mensaje' => 'Error, informacion incorrecta');
            } else {
             $id_cliente = $objClient->RegistrarClienteApi($ruc, $razon, $telefono, $correo);
             if ($id_cliente > 0) {
                 $arr_Respuesta = array('status' => true, 'mensaje' => 'Registro Exitoso');
             } else {
                 $arr_Respuesta = array('status' => false, 'mensaje' => 'Error al registrar reserva');
             }

            }
        }
    }
    echo json_encode($arr_Respuesta);
}

if($tipo == "listarClientesApi"){
    $arr_Respuesta = array('status' => false, 'mensaje' => 'Error_Sesion');
    if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {
        $arrClientesApi = $objClient->listarClientesApi();
        if($arrClientesApi){
            for ($i=0; $i < count($arrClientesApi); $i++) {

                $arrClientesApi[$i]->countTokens = $objTokens->contarTokensByClient($arrClientesApi[$i]->id);

                $arrClientesApi[$i]->status = $arrClientesApi[$i]->estado == 1? '<span class="badge bg-success">Activo</span>':'<span class="badge bg-warning text-dark">Inactivo</span>';

                $opciones = '<button class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#modalGestionTokens" title="Gestionar Tokens" onclick="listarTokensCliente('.$arrClientesApi[$i]->id.')">
                                    <i class="bi bi-key"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-warning" title="Editar" data-bs-toggle="modal" data-bs-target="#modalEditarCliente" onclick="listarCliente('.$arrClientesApi[$i]->id.');">
                                    <i class="bi bi-pencil"></i>
                                </button>';
                $arrClientesApi[$i]->options = $opciones;
            }
           $arr_Respuesta['status'] = true;           
           $arr_Respuesta['mensaje'] = 'exit';           
           $arr_Respuesta['contenido'] = $arrClientesApi;           
        }else{
             $arr_Respuesta = array('status' => false, 'mensaje' => 'error de sistema');
        }
    }
    echo json_encode($arr_Respuesta);
}

if($tipo == "obtenerCliente"){
     $arr_Respuesta = array('status' => false, 'mensaje' => 'Error_Sesion');
    if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {
        $id_cliente = $_POST['id'];
        $arr_cliente = $objClient->buscarClienteById($id_cliente);
        if($arr_cliente){
           $arr_Respuesta = array('status' => true, 'mensaje' => 'exito' ,'contenido'=> $arr_cliente);
        }else{
            $arr_Respuesta = array('status' => false, 'mensaje' => 'error consulta');
        }
    }
  echo json_encode($arr_Respuesta);
}
if($tipo == "actualizarCliente"){
     $arr_Respuesta = array('status' => false, 'mensaje' => 'Error_Sesion');
    if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {
      $id_cliente =   $_POST['data'];
      $ruc =   $_POST['ruc-n'];
      $razon = $_POST['empresaCliente-n'];
      $telefono =  $_POST['telefonoCliente-n'];
      $correo = $_POST['emailCliente-n'];
      $estado =      $_POST['estadoCliente-n'];

      if($id_cliente == ''|| $ruc == ''|| $razon == ''|| $telefono == ''|| $correo == ''|| $estado == ''){
           $arr_Respuesta = array('status' => false, 'mensaje' => 'datos invalidos'); 
      }else{
       $actualizar = $objClient->actualizarClienteApi($id_cliente,$ruc,$razon,$telefono,$correo,$estado);
       if($actualizar){
       $arr_Respuesta = array('status' => true, 'mensaje' => 'actualizado');
       }else{
        $arr_Respuesta = array('status' => false, 'mensaje' => 'error consult');
       }
      }
    }
    echo json_encode($arr_Respuesta);
}

if($tipo == "obtenerTokensCliente"){
     $arr_Respuesta = array('status' => false, 'mensaje' => 'Error_Sesion');
    if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {
        $id_cliente = $_POST['id'];
        $arrTokens = $objTokens->listarTokensByClient($id_cliente);
        if($arrTokens){
            for ($i=0; $i < count($arrTokens); $i++) {
                $id_token = $arrTokens[$i]->id;
                if($arrTokens[$i]->estado == 1){
                $arrTokens[$i]->estado = '<span class="badge bg-success">Activo</span>';
                $opciones = '<button class="btn btn-sm btn-outline-success" title="Desactivar"  onclick="cambiarEstado('.$id_token.','.(1).')"><i class="bi bi-toggle-on"></i></button>';
                }else if($arrTokens[$i]->estado == 0){
                $arrTokens[$i]->estado = '<span class="badge bg-secondary">Inactivo</span>';
                $opciones = '<button class="btn btn-sm btn-outline-danger" title="Activar" onclick="cambiarEstado('.$id_token.','.(0).')"><i class="bi bi-toggle-on"></i></button>';
                }
            
        
                $arrTokens[$i]->options = $opciones;
            }
         $arr_Respuesta = array('status' => true, 'mensaje' => 'exito' , 'contenido' => $arrTokens);
        }else{
             $arr_Respuesta = array('status' => false, 'mensaje' => 'error sistema');
        }
    }
    echo json_encode($arr_Respuesta);
}

if($tipo == "generarTokenClient"){
    $arr_Respuesta = array('status' => false, 'mensaje' => 'Error_Sesion');
    if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {
        if ($_POST) {
            $id_client = $_POST['data'];
            if (!empty($id_client)) {
                $resultado = $objTokens->generarTokenParaCliente($id_client);
                if ($resultado) {
                    $arr_Respuesta = array('status' => true, 'mensaje' => 'Token generado correctamente');
                } else {
                    $arr_Respuesta = array('status' => false, 'mensaje' => 'Error al generar el token en la base de datos');
                }
            } else {
                $arr_Respuesta = array('status' => false, 'mensaje' => 'ID de cliente no proporcionado');
            }
        } else {
            $arr_Respuesta = array('status' => false, 'mensaje' => 'Método no permitido');
        }
    }
    echo json_encode($arr_Respuesta);
    exit;
}

if($tipo == "cambiarEstadoToken"){
   $arr_Respuesta = array('status' => false, 'mensaje' => 'Error_Sesion');
   if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {
     if($_POST){
        $id_token = $_POST['data'];
        $estado = $_POST['status'];
        if (empty($id_token)||!is_numeric($id_token)) {
           $arr_Respuesta = array('status' => false, 'mensaje' => 'token_invalido');
        }else{
            $actualizarEstado = $objTokens->cambiarEstado($id_token,$estado);
            if($actualizarEstado){
              $arr_Respuesta = array('status' => true, 'mensaje' => 'estado actualizado corrrectamente');
            }else{
               $arr_Respuesta = array('status' => false, 'mensaje' => 'error actualizar estado');
            }
        }
     }else{
        $arr_Respuesta = array('status' => false, 'mensaje' => 'Consulta invalida');
     }
   }
   echo json_encode($arr_Respuesta);
}

?>