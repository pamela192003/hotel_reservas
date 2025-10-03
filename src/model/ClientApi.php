<?php
require_once __DIR__."/../../library/Conexion.php";

class ClientApi {
    public static function all() {
        $db = Conexion::getConexion();
        return $db->query("SELECT * FROM client_api ORDER BY fecha_registro DESC")->fetchAll();
    }

    public static function create($data) {
        $db = Conexion::getConexion();
        $st = $db->prepare("INSERT INTO client_api(ruc, razon_social, telefono, correo) VALUES(?, ?, ?, ?)");
        $st->execute([$data['ruc'], $data['razon_social'], $data['telefono'], $data['correo']]);
        return $db->lastInsertId();
    }

    public static function find($id) {
        $db = Conexion::getConexion();
        $st = $db->prepare("SELECT * FROM client_api WHERE id = ?");
        $st->execute([$id]);
        return $st->fetch();
    }

    public static function update($id, $data) {
        $db = Conexion::getConexion();
        $st = $db->prepare("UPDATE client_api SET ruc=?, razon_social=?, telefono=?, correo=? WHERE id=?");
        return $st->execute([$data['ruc'], $data['razon_social'], $data['telefono'], $data['correo'], $id]);
    }

    public static function updateEstado($id, $estado) {
        $db = Conexion::getConexion();
        $st = $db->prepare("UPDATE client_api SET estado=? WHERE id=?");
        return $st->execute([$estado, $id]);
    }

    public static function delete($id) {
        $db = Conexion::getConexion();
        $st = $db->prepare("DELETE FROM client_api WHERE id=?");
        return $st->execute([$id]);
    }

    // 🔹 Nueva función: obtener reservas por nombre de cliente
    public static function verReservasApiByNombre($nombre) {
        $db = Conexion::getConexion();
        $st = $db->prepare("
            SELECT r.*, c.razon_social, c.ruc
            FROM reservas r
            INNER JOIN client_api c ON r.id_client_api = c.id
            WHERE c.razon_social LIKE ?
            ORDER BY r.fecha_reserva DESC
        ");
        $st->execute(['%' . $nombre . '%']);
        return $st->fetchAll();
    }
}
?>
