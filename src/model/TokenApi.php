<?php
require_once __DIR__."/../../library/Conexion.php";

class TokenApi {
    public static function all() {
        $db = Conexion::getConexion();
        return $db->query("SELECT t.*, c.ruc, c.razon_social FROM tokens_api t INNER JOIN client_api c ON t.id_client_api = c.id ORDER BY t.fecha_registro DESC")->fetchAll();
    }

    public static function create($data) {
        $db = Conexion::getConexion();
        $st = $db->prepare("INSERT INTO tokens_api(id_client_api, token) VALUES(?, ?)");
        $st->execute([$data['id_client_api'], $data['token']]);
        return $db->lastInsertId();
    }

    public static function find($id) {
        $db = Conexion::getConexion();
        $st = $db->prepare("SELECT * FROM tokens_api WHERE id = ?");
        $st->execute([$id]);
        return $st->fetch();
    }

    public static function update($id, $data) {
        $db = Conexion::getConexion();
        $st = $db->prepare("UPDATE tokens_api SET id_client_api=?, token=? WHERE id=?");
        return $st->execute([$data['id_client_api'], $data['token'], $id]);
    }

    public static function updateEstado($id, $estado) {
        $db = Conexion::getConexion();
        $st = $db->prepare("UPDATE tokens_api SET estado=? WHERE id=?");
        return $st->execute([$estado, $id]);
    }

    public static function delete($id) {
        $db = Conexion::getConexion();
        $st = $db->prepare("DELETE FROM tokens_api WHERE id=?");
        return $st->execute([$id]);
    }
}
?>
