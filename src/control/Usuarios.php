<?php
session_start();
require_once('../model/admin-sesionModel.php');
require_once('../model/admin-usuarioModel.php');
require_once('../model/adminModel.php');

$tipo = $_GET['tipo'];

//instanciar la clase categoria model
$objSesion = new SessionModel();
$objUsuario = new UsuarioModel();
$objAdmin = new AdminModel();

//variables de sesion
$id_sesion = $_REQUEST['sesion'];
$token = $_REQUEST['token'];

if ($tipo == "registrar") {
    $arr_Respuesta = array('status' => false, 'mensaje' => 'Error_Sesion');
    if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {
        if ($_POST) {
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $usuario = $_POST['usuario'];
            $telefono = $_POST['telefono'];
            $password = $_POST['contrasena'];
            $rol = $_POST['rol'];

            $passhash = password_hash($password, PASSWORD_DEFAULT);

            if ($nombre == "" || $apellido == "" || $usuario == "" || $telefono == "" ||$password == "" || $rol == "") {
                $arr_Respuesta = array('status' => false, 'mensaje' => 'Error, campos vacíos');
            } else {
                $arr_Usuario = $objUsuario->buscarUsuarioByUsuarioName($usuario);
                if ($arr_Usuario) {
                    $arr_Respuesta = array('status' => false, 'mensaje' => 'Registro Fallido, Usuario ya se encuentra registrado');
                } else {
                    $id_usuario = $objUsuario->registrarUsuario($nombre, $apellido, $usuario, $telefono, $passhash,$rol);
                    if ($id_usuario > 0) {
                        // array con los id de los sistemas al que tendra el acceso con su rol registrado
                        // caso de administrador y director
                        $arr_Respuesta = array('status' => true, 'mensaje' => 'Registro Exitoso');
                    } else {
                        $arr_Respuesta = array('status' => false, 'mensaje' => 'Error al registrar usuario');
                    }
                }
            }
        }
    }
    echo json_encode($arr_Respuesta);
}

if($tipo == "listarUsuarios"){
    $arr_Respuesta = array('status' => false, 'mensaje' => 'Error_Sesion');
    if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {
        $arrUsuarios = $objUsuario->listarUsuarios();
        if($arrUsuarios){
            for ($i=0; $i < count($arrUsuarios); $i++) { 
                $arrUsuarios[$i]->estado = $arrUsuarios[$i]->activo == 1 ? '<span class="badge bg-success">Activo</span>':'<span class="badge bg-danger">Inactivo</span>';
                $arrUsuarios[$i]->rol = $arrUsuarios[$i]->rol == 'cliente'? '<span class="badge bg-secondary">Cliente</span>':'<span class="badge bg-danger">Administrador</span>';
                $opciones = '<button class="btn btn-sm btn-outline-warning" title="Editar" onclick="listarUsuario('.$arrUsuarios[$i]->id_usuario.');" data-bs-toggle="modal" data-bs-target="#modalEditarUsuario">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger" title="Eliminar">
                                    <i class="bi bi-trash"></i>
                                </button>';
                $arrUsuarios[$i]->options = $opciones;
            }
           $arr_Respuesta['status'] = true;           
           $arr_Respuesta['mensaje'] = 'exit';           
           $arr_Respuesta['contenido'] = $arrUsuarios;           
        }else{
             $arr_Respuesta = array('status' => false, 'mensaje' => 'error de sistema');
        }
    }
    echo json_encode($arr_Respuesta);
}
if($tipo == "obtenerUsuario"){
     $arr_Respuesta = array('status' => false, 'mensaje' => 'Error_Sesion');
    if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {
        $iduser = $_POST['id'];
        $arrUsuario = $objUsuario->buscarUsuarioById($iduser);
        if($arrUsuario){
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