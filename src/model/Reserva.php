<?php
require_once __DIR__."/../../library/Conexion.php";

class Reserva {
  public static function allByUser($userId){
    $db = Conexion::getConexion();
    $st = $db->prepare("SELECT * FROM reservas WHERE id_usuario = ? ORDER BY fecha_creacion DESC");
    $st->execute([$userId]);
    return $st->fetchAll();
  }
  public static function all(){
    $db = Conexion::getConexion();
    return $db->query("SELECT r.*, u.nombre, u.apellido FROM reservas r INNER JOIN usuarios u ON u.id_usuario=r.id_usuario ORDER BY fecha_creacion DESC")->fetchAll();
  }
  public static function create($data){
    $db = Conexion::getConexion();
    $st = $db->prepare("INSERT INTO reservas(id_usuario,id_habitacion,fecha_inicio,fecha_fin,estado,monto_total) VALUES(?,?,?,?,?,?)");
    $st->execute([
      $data['id_usuario'],$data['id_habitacion'],$data['fecha_inicio'],$data['fecha_fin'],'pendiente',$data['monto_total']
    ]);
    return $db->lastInsertId();
  }
  public static function updateEstado($id,$estado){
    $db = Conexion::getConexion();
    $st = $db->prepare("UPDATE reservas SET estado=? WHERE id_reserva=?");
    return $st->execute([$estado,$id]);
  }
  public static function find($id){
    $db = Conexion::getConexion();
    $st = $db->prepare("SELECT * FROM reservas WHERE id_reserva=?");
    $st->execute([$id]);
    return $st->fetch();
  }
  public static function delete($id){
    $db = Conexion::getConexion();
    $st = $db->prepare("DELETE FROM reservas WHERE id_reserva=?");
    return $st->execute([$id]);
  }
}