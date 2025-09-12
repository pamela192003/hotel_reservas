<?php
require_once __DIR__."/../../library/BaseController.php";
require_once __DIR__."/../model/Reserva.php";
require_once __DIR__."/../../library/Csrf.php";

class ReservasController extends BaseController {
  public function index(){
    $this->needAuth();
    $user = $_SESSION['user'];
    $reservas = $user['rol']==='admin' ? Reserva::all() : Reserva::allByUser($user['id']);
    $this->view('reservas/index', compact('reservas','user'));
  }
  public function crear(){
    $this->needAuth();
    if($this->isPost()){
      $this->verify_csrf();
      $user = $_SESSION['user'];
      $data = [
        'id_usuario' => $user['id'],
        'id_habitacion' => (int)($_POST['id_habitacion']??0),
        'fecha_inicio' => $_POST['fecha_inicio']??'',
        'fecha_fin' => $_POST['fecha_fin']??'',
        'monto_total' => (float)($_POST['monto_total']??0)
      ];
      $id = Reserva::create($data);
      $this->redirect('reservas');
    } else {
      $this->view('reservas/crear');
    }
  }
  public function cambiar_estado(){
    $this->needAuth();
    if($this->isPost()){
      $this->verify_csrf();
      $id = (int)($_POST['id_reserva']??0);
      $estado = $_POST['estado']??'pendiente';
      Reserva::updateEstado($id, $estado);
    }
    $this->redirect('reservas');
  }
  public function eliminar(){
    $this->needAuth();
    if($this->isPost()){
      $this->verify_csrf();
      $id = (int)($_POST['id_reserva']??0);
      Reserva::delete($id);
    }
    $this->redirect('reservas');
  }
}