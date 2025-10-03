<?php
require_once __DIR__."/../../library/BaseController.php";
require_once __DIR__."/../model/ClientApi.php";
require_once __DIR__."/../model/Reserva.php"; // <-- Asegúrate de tener este modelo
require_once __DIR__."/../../library/Csrf.php";

class ClientApiController extends BaseController {

    public function index() {
        $this->needAuth();
        $clientes = ClientApi::all();
        $this->view('client_api/index', compact('clientes'));
    }

    public function crear() {
        $this->needAuth();
        if ($this->isPost()) {
            $this->verify_csrf();
            $data = [
                'ruc' => $_POST['ruc'] ?? '',
                'razon_social' => $_POST['razon_social'] ?? '',
                'telefono' => $_POST['telefono'] ?? '',
                'correo' => $_POST['correo'] ?? ''
            ];
            $id = ClientApi::create($data);
            $this->redirect('client_api');
        } else {
            $this->view('client_api/crear');
        }
    }

    public function editar() {
        $this->needAuth();
        $id = (int)($_GET['id'] ?? 0);
        $cliente = ClientApi::find($id);

        if ($this->isPost()) {
            $this->verify_csrf();
            $data = [
                'ruc' => $_POST['ruc'] ?? '',
                'razon_social' => $_POST['razon_social'] ?? '',
                'telefono' => $_POST['telefono'] ?? '',
                'correo' => $_POST['correo'] ?? ''
            ];
            ClientApi::update($id, $data);
            $this->redirect('client_api');
        } else {
            $this->view('client_api/editar', compact('cliente'));
        }
    }

    public function cambiar_estado() {
        $this->needAuth();
        if ($this->isPost()) {
            $this->verify_csrf();
            $id = (int)($_POST['id'] ?? 0);
            $estado = (int)($_POST['estado'] ?? 0);
            ClientApi::updateEstado($id, $estado);
        }
        $this->redirect('client_api');
    }

    public function eliminar() {
        $this->needAuth();
        if ($this->isPost()) {
            $this->verify_csrf();
            $id = (int)($_POST['id'] ?? 0);
            ClientApi::delete($id);
        }
        $this->redirect('client_api');
    }

    // 🔹 Nueva función: ver reservas por nombre de cliente
    public function verReservasApiByNombre() {
        $this->needAuth();
        $nombre = $_GET['nombre'] ?? '';

        if (!empty($nombre)) {
            $reservas = ClientApi::verReservasApiByNombre($nombre);
            $this->view('reservas/ver_por_cliente', compact('reservas', 'nombre'));
        } else {
            $this->redirect('reservas');
        }
    }
}
