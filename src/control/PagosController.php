<?php
require_once __DIR__."/../../library/BaseController.php";
require_once __DIR__."/../model/Pago.php";
require_once __DIR__."/../model/Reserva.php";
require_once __DIR__."/../../library/Csrf.php";

class PagosController extends BaseController {
  public function registrar(){
    $this->needAuth();
    if($this->isPost()){
      $this->verify_csrf();
      $id_reserva = (int)($_POST['id_reserva']??0);
      $reserva = Reserva::find($id_reserva);
      if(!$reserva){
        $error="Reserva no encontrada";
        $this->view('panel/index', compact('error'));
        return;
      }
      $ok = Pago::create([
        'id_reserva'=>$id_reserva,
        'fecha_pago'=>date('Y-m-d'),
        'monto'=> (float)($_POST['monto']??$reserva['monto_total']),
        'metodo'=> $_POST['metodo']??'efectivo',
        'estado'=>'completado',
        'transaccion_id'=> 'LOCAL-'.uniqid()
      ]);
      if($ok) Reserva::updateEstado($id_reserva,'confirmada');
      $this->redirect('panel');
    }
  }
}