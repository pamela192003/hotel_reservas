<?php
require_once __DIR__."/../../library/BaseController.php";
require_once __DIR__."/../model/Usuario.php";
require_once __DIR__."/../../library/Csrf.php";

class UsuariosController extends BaseController {

    public function index() {
        $usuarios = Usuario::getAll();
        $this->view('usuarios/index', compact('usuarios'));
    }

    public function crear() {
        if ($this->isPost()) {
            $this->verify_csrf();
            $nombre = trim($_POST['nombre'] ?? '');
            $apellido = trim($_POST['apellido'] ?? '');
            $usuario = trim($_POST['usuario'] ?? '');
            $telefono = trim($_POST['telefono'] ?? '');
            $password = trim($_POST['password'] ?? '');
            $rol = trim($_POST['rol'] ?? 'cliente');

            if (Usuario::create($nombre, $apellido, $usuario, $telefono, $password, $rol)) {
                $this->redirect('usuarios');
            } else {
                $error = "Error al crear el usuario.";
                $this->view('usuarios/crear', compact('error'));
            }
        } else {
            $this->view('usuarios/crear');
        }
    }
    public function editar($id) {
    if ($this->isPost()) {
        $this->verify_csrf();
        $nombre = trim($_POST['nombre'] ?? '');
        $apellido = trim($_POST['apellido'] ?? '');
        $usuario = trim($_POST['usuario'] ?? '');
        $telefono = trim($_POST['telefono'] ?? '');
        $rol = trim($_POST['rol'] ?? 'cliente');

        if (Usuario::update($id, $nombre, $apellido, $usuario, $telefono, $rol)) {
            $this->redirect('usuarios');
        } else {
            $error = "Error al actualizar el usuario.";
            $usuario = Usuario::getById($id);
            $this->view('usuarios/editar', compact('error', 'usuario'));
        }
    } else {
        $usuario = Usuario::getById($id);
        $this->view('usuarios/editar', compact('usuario'));
    }
}

public function eliminar($id) {
    if (Usuario::delete($id)) {
        $this->redirect('usuarios');
    } else {
        $error = "Error al eliminar el usuario.";
        $usuarios = Usuario::getAll();
        $this->view('usuarios/index', compact('error', 'usuarios'));
    }
}

}
