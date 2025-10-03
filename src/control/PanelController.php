<?php
require_once __DIR__."/../../library/BaseController.php";
require_once __DIR__."/../model/Reserva.php";

class PanelController extends BaseController {
  public function index(){
    $this->needAuth();
    $user = $_SESSION['user'];
    $reservas = $user['rol']==='admin' ? Reserva::all() : Reserva::allByUser($user['id']);
    $this->view('panel/index', compact('reservas','user'));
  }
}