<?php
session_start();
require_once('../model/admin-sesionModel.php');
require_once('../model/admin-reservas.php');
require_once('../model/admin-usuarioModel.php');
require_once('../model/adminModel.php');

$tipo = $_GET['tipo'];

//instanciar la clase categoria model
$objSesion = new SessionModel();
$objReservas = new ReservaModel();
$objUsuario = new UsuarioModel();
$objAdmin = new AdminModel();

//variables de sesion
$id_sesion = $_REQUEST['sesion'];
$token = $_REQUEST['token'];

if ($tipo == "registrarReserva") {
    $arr_Respuesta = array('status' => false, 'mensaje' => 'Error_Sesion');
    if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {
        if ($_POST) {
            $usuario = $_SESSION['sesion_usuario']; //   $_POST['usuario'];  <- deberia ser nombre del cliente osea un varchar en la BD
            $habitacion = $_POST['habitacion'];
            $hotel = $_POST['hotel'];
            $fecha_inicio = $_POST['fechaInicio'];
            $fecha_fin = $_POST['fechaFin'];
            $monto = $_POST['monto'];

            if ($usuario == "" || $habitacion == "" || $hotel == "" || $fecha_inicio == "" ||$fecha_fin == "" || $monto == "") {
                $arr_Respuesta = array('status' => false, 'mensaje' => 'Error, campos vacíos');
            } else {
             $id_reserva = $objReservas->registrarReserva($usuario, $habitacion, $hotel, $fecha_inicio, $fecha_fin,$monto);
             if ($id_reserva > 0) {
                 $arr_Respuesta = array('status' => true, 'mensaje' => 'Registro Exitoso');
             } else {
                 $arr_Respuesta = array('status' => false, 'mensaje' => 'Error al registrar reserva');
             }

            }
        }
    }
    echo json_encode($arr_Respuesta);
}

if($tipo == "listarReservas"){
    $arr_Respuesta = array('status' => false, 'mensaje' => 'Error_Sesion');
    if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {
        $arrReservas = $objReservas->listarReservas();
        if($arrReservas){
            for ($i=0; $i < count($arrReservas); $i++) {
                switch ($arrReservas[$i]->estado) {
                    case 'pendiente':
                    $arrReservas[$i]->status = '<span class="badge bg-warning text-dark">Pendiente</span>';
                        break;
                    case 'confirmada':
                    $arrReservas[$i]->status = '<span class="badge bg-success">Confirmada</span>';
                        break;
                    case 'cancelada':
                    $arrReservas[$i]->status = '<span class="badge bg-danger">Cancelada</span>';
                        break;    
                    case 'finalizada':
                    $arrReservas[$i]->status = '<span class="badge bg-secondary">Finalizada</span>';
                    break;
                }

                $usuario = $objUsuario->buscarUsuarioById($arrReservas[$i]->id_usuario);
                $arrReservas[$i]->username = $usuario->nombre;

                $opciones = '<button class="btn btn-sm btn-outline-warning" title="Editar" onclick="listarReserva('.$arrReservas[$i]->id_reserva.');" data-bs-toggle="modal" data-bs-target="#modalActualizarReserva">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger" title="Eliminar">
                                    <i class="bi bi-trash"></i>
                                </button>';
                $arrReservas[$i]->options = $opciones;
            }
           $arr_Respuesta['status'] = true;           
           $arr_Respuesta['mensaje'] = 'exit';           
           $arr_Respuesta['contenido'] = $arrReservas;           
        }else{
             $arr_Respuesta = array('status' => false, 'mensaje' => 'error de sistema');
        }
    }
    echo json_encode($arr_Respuesta);
}

if($tipo == "obtenerReserva"){
     $arr_Respuesta = array('status' => false, 'mensaje' => 'Error_Sesion');
    if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {
        $idReserva = $_POST['id'];
        $arrReserva = $objReservas->buscarReservaById($idReserva);
        if($arrReserva){
           $arr_Respuesta = array('status' => true, 'mensaje' => 'exito' ,'contenido'=> $arrUsuario);
        }else{
            $arr_Respuesta = array('status' => false, 'mensaje' => 'error consulta');
        }
    }
  echo json_encode($arr_Respuesta);
}
if($tipo == "actualizar"){
     $arr_Respuesta = array('status' => false, 'mensaje' => 'Error_Sesion');
    if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {
      $iduser =   $_POST['data'];
      $nombre =   $_POST['nombre-n'];
      $apellido = $_POST['apellido-n'];
      $usuario =  $_POST['usuario-n'];
      $telefono = $_POST['telefono-n'];
      $rol =      $_POST['rol-n'];
      $estado =   $_POST['estado-n'];

      if($iduser == ''|| $nombre == ''|| $apellido == ''|| $usuario == ''|| $telefono == ''|| $rol == ''|| $estado == ''){
           $arr_Respuesta = array('status' => false, 'mensaje' => 'datos invalidos'); 
      }else{
       $actualizar = $objUsuario->actualizarUsuario($iduser,$nombre,$apellido,$usuario,$telefono,$rol,$estado);
       if($actualizar){
       $arr_Respuesta = array('status' => true, 'mensaje' => 'actualizado');
       }else{
        $arr_Respuesta = array('status' => false, 'mensaje' => 'error consult');
       }
      }
    }
    echo json_encode($arr_Respuesta);
}

?>