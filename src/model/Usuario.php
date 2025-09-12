<?php
require_once __DIR__."/../../library/Conexion.php";

class Usuario {
  public static function byUsuario($usuario){
    $db = Conexion::getConexion();
    $st = $db->prepare("SELECT * FROM usuarios WHERE usuario = ? AND activo = 1 LIMIT 1");
    $st->execute([$usuario]);
    return $st->fetch();
  }
  public static function create($nombre, $apellido, $usuario, $telefono, $password, $rol = 'cliente') {
    $db = Conexion::getConexion();
    $hash = password_hash($password, PASSWORD_BCRYPT);
    $st = $db->prepare("
        INSERT INTO usuarios(nombre, apellido, usuario, telefono, password, rol)
        VALUES(?, ?, ?, ?, ?, ?)
    ");
    return $st->execute([$nombre, $apellido, $usuario, $telefono, $hash, $rol]);
}

  public static function getAll() {
    $db = Conexion::getConexion();
    $st = $db->prepare("SELECT * FROM usuarios WHERE activo = 1");
    $st->execute();
    return $st->fetchAll();
}

public static function getById($id) {
    $db = Conexion::getConexion();
    $st = $db->prepare("SELECT * FROM usuarios WHERE id_usuario = ? AND activo = 1 LIMIT 1");
    $st->execute([$id]);
    return $st->fetch();
}

public static function update($id, $nombre, $apellido, $usuario, $telefono, $rol) {
    $db = Conexion::getConexion();
    $st = $db->prepare("UPDATE usuarios SET nombre = ?, apellido = ?, usuario = ?, telefono = ?, rol = ? WHERE id_usuario = ?");
    return $st->execute([$nombre, $apellido, $usuario, $telefono, $rol, $id]);
}

public static function delete($id) {
    $db = Conexion::getConexion();
    $st = $db->prepare("UPDATE usuarios SET activo = 0 WHERE id_usuario = ?");
    return $st->execute([$id]);
}


}