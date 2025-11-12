<?php
// Habilitar CORS
header("Access-Control-Allow-Origin: *"); // o puedes poner un dominio específico
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

// Si la solicitud es de tipo OPTIONS (preflight), responder sin procesar lógica
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

// ... tu código PHP normal aquí ...

require_once('../model/admin-apiModel.php');
$tipo = $_GET['tipo'];
//instanciar la clase categoria model
$objApi = new ApiModel();

$token = trim($_POST['token']) ?? '';

if(empty($token)){
    $arr_Respuesta = array('status' => false, 'mensaje' => 'Acceso no autorizado - token requerido');
    echo json_encode($arr_Respuesta);
    exit;
}
//validar token
$tokenn = explode("-", $token);
if($tokenn[2] == '' || count($tokenn) < 3){
    $arr_Respuesta = array('status' => false, 'mensaje' => 'Acceso no autorizado - token invalido');
    echo json_encode($arr_Respuesta);
    exit;
}

$id_cliente = $tokenn[2];
$estadoCliente = $objApi->validarEstadoCliente($id_cliente);
if($estadoCliente != 1){
    $arr_Respuesta = array('status' => false, 'mensaje' => 'Cliente API inactivo');
    echo json_encode($arr_Respuesta);
    exit;
}

$validarClienteToken = $objApi->validarClienteToken($id_cliente , $token);
if(!$validarClienteToken){
    $arr_Respuesta = array('status' => false, 'mensaje' => 'Acceso no autorizado - token inactivo o invalido');
    echo json_encode($arr_Respuesta);
    exit;
}


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

if($tipo == "listarReservasPorEstado"){
    $estado = trim($_POST['status']) ?? '';
        $arrReservas = $objApi->listarReservasPorEstado($estado);
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