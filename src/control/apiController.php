<?php
session_start();
require_once('../model/admin-sesionModel.php');
require_once('../model/admin-apiModel.php');
require_once('../model/adminModel.php');

$tipo = $_GET['tipo'];

//instanciar la clase categoria model
$objSesion = new SessionModel();
$objApi = new ApiModel();
$objAdmin = new AdminModel();

$token = $_POST['token'];

if($tipo == "listarReservas"){
        $arrReservas = $objApi->listarReservas();
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

                $usuario = $objApi->buscarUsuarioById($arrReservas[$i]->id_usuario);
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
    echo json_encode($arr_Respuesta);
}

?>