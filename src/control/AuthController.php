<?php
require_once __DIR__."/../../library/BaseController.php";
require_once __DIR__."/../model/Usuario.php";
require_once __DIR__."/../../library/Csrf.php";

class AuthController extends BaseController {
  public function login(){
    if($this->isPost()){
      $this->verify_csrf();
      $usuario = trim($_POST['usuario'] ?? '');
      $password = trim($_POST['password'] ?? '');
      $user = Usuario::byUsuario($usuario);
      if($user && (password_verify($password, $user['password']) || $password === $user['password'])){
        $_SESSION['user'] = [
          'id' => $user['id_usuario'],
          'nombre' => $user['nombre'],
          'rol' => $user['rol']
        ];
        $this->redirect('panel');
      } else {
        $error = "Usuario o contraseña incorrectos.";
        $this->view('auth/login', compact('error'));
        return;
      }
    } else {
      $this->view('auth/login');
    }
  }
  public function logout(){
    session_destroy();
    $this->redirect('auth/login');
  }
}