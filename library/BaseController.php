<?php
session_start();
require_once __DIR__ . '/Csrf.php';

class BaseController {
  protected function view($path, $data = []){
    extract($data);
    $is_login = ($path === 'auth/login');
    include __DIR__ . '/../src/view/partials/header.php';
    include __DIR__ . '/../src/view/'.$path.'.php';
    include __DIR__ . '/../src/view/partials/footer.php';
  }
  protected function redirect($to){
    header("Location: ".BASE_URL.$to);
    exit;
  }
  protected function isPost(){ return $_SERVER['REQUEST_METHOD'] === 'POST'; }
  protected function needAuth(){
    if(empty($_SESSION['user'])){
      $this->redirect('auth/login');
    }
  }
  protected function csrf_token(){
    if(empty($_SESSION['csrf'])) $_SESSION['csrf']=bin2hex(random_bytes(32));
    return $_SESSION['csrf'];
  }
  protected function verify_csrf(){
    if(empty($_POST['csrf']) || $_POST['csrf'] !== ($_SESSION['csrf']??'')){
      die("CSRF token inválido.");
    }
  }
}