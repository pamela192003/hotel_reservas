
<?php
require_once __DIR__."/../../library/Conexion.php";

class TokenApi {
    // Listar todos los tokens con datos del cliente
    public static function all() {
        $db = Conexion::getConexion();
        return $db->query("SELECT t.*, c.ruc, c.razon_social 
                           FROM tokens_api t 
                           INNER JOIN client_api c ON t.id_client_api = c.id 
                           ORDER BY t.fecha_registro DESC")->fetchAll();
    }

    // Crear un token nuevo (se genera automáticamente)
    public static function create($data) {
        $db = Conexion::getConexion();

        $fecha_registro = date("Ymd"); // ejemplo: 20251003
        $id_cliente = (int)$data['id_client_api'];

        // Generar token aleatorio seguro de 64 caracteres
        $token = bin2hex(random_bytes(32));

        // Concatenar con fecha e id de cliente
        $token = $token . '-' . $fecha_registro . '-' . $id_cliente;

        $st = $db->prepare("INSERT INTO tokens_api(id_client_api, token) VALUES(?, ?)");
        $st->execute([$id_cliente, $token]);

        return [
            "id" => $db->lastInsertId(),
            "token" => $token
        ];
    }

    // Buscar un token por su ID
    public static function find($id) {
        $db = Conexion::getConexion();
        $st = $db->prepare("SELECT * FROM tokens_api WHERE id = ?");
        $st->execute([$id]);
        return $st->fetch();
    }

    // Actualizar datos de un token (regenerando el token con fecha e id cliente)
    public static function update($id, $data) {
        $db = Conexion::getConexion();

        $fecha_registro = date("Ymd");
        $id_cliente = (int)$data['id_client_api'];

        // Generar un nuevo token al actualizar
        $token = bin2hex(random_bytes(32)) . '-' . $fecha_registro . '-' . $id_cliente;

        $st = $db->prepare("UPDATE tokens_api SET id_client_api=?, token=? WHERE id=?");
        return $st->execute([$id_cliente, $token, $id]);
    }

    // Cambiar estado de un token
    public static function updateEstado($id, $estado) {
        $db = Conexion::getConexion();
        $st = $db->prepare("UPDATE tokens_api SET estado=? WHERE id=?");
        return $st->execute([$estado, $id]);
    }

    // Eliminar un token
    public static function delete($id) {
        $db = Conexion::getConexion();
        $st = $db->prepare("DELETE FROM tokens_api WHERE id=?");
        return $st->execute([$id]);
    }
}
?>
