<?php
require_once __DIR__."/../../library/Conexion.php";

class Pago {
  public static function create($data){
    $db = Conexion::getConexion();
    $st = $db->prepare("INSERT INTO pagos(id_reserva,fecha_pago,monto,metodo,estado,transaccion_id) VALUES(?,?,?,?,?,?)");
    return $st->execute([
      $data['id_reserva'], $data['fecha_pago'], $data['monto'], $data['metodo'], $data['estado'], $data['transaccion_id']
    ]);
  }
  public static function byReserva($id_reserva){
    $db = Conexion::getConexion();
    $st = $db->prepare("SELECT * FROM pagos WHERE id_reserva=? ORDER BY fecha_pago DESC");
    $st->execute([$id_reserva]);
    return $st->fetchAll();
  }
}