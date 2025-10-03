
<?php
require_once __DIR__."/../../library/BaseController.php";
require_once __DIR__."/../model/TokenApi.php";
require_once __DIR__."/../model/ClientApi.php";
require_once __DIR__."/../../library/Csrf.php";

class TokenApiController extends BaseController {

    public function index() {
        $this->needAuth();
        $tokens = TokenApi::all();
        $this->view('tokens_api/index', compact('tokens'));
    }

    public function crear() {
        $this->needAuth();
        if ($this->isPost()) {
            $this->verify_csrf();
            $data = [
                'id_client_api' => (int)($_POST['id_client_api'] ?? 0)
                // Ya no pedimos el token, se genera en el modelo
            ];
            $result = TokenApi::create($data);

            // Si quieres mostrar el token generado después de crear:
            // $_SESSION['mensaje'] = "Token generado: " . $result['token'];

            $this->redirect('tokens_api');
        } else {
            $clientes = ClientApi::all();
            $this->view('tokens_api/crear', compact('clientes'));
        }
    }

    public function editar() {
        $this->needAuth();
        $id = (int)($_GET['id'] ?? 0);
        $token = TokenApi::find($id);

        if ($this->isPost()) {
            $this->verify_csrf();
            $data = [
                'id_client_api' => (int)($_POST['id_client_api'] ?? 0)
                // Token también se genera en el modelo al actualizar
            ];
            TokenApi::update($id, $data);
            $this->redirect('tokens_api');
        } else {
            $clientes = ClientApi::all();
            $this->view('tokens_api/editar', compact('token', 'clientes'));
        }
    }

    public function cambiar_estado() {
        $this->needAuth();
        if ($this->isPost()) {
            $this->verify_csrf();
            $id = (int)($_POST['id'] ?? 0);
            $estado = (int)($_POST['estado'] ?? 0);
            TokenApi::updateEstado($id, $estado);
        }
        $this->redirect('tokens_api');
    }

    public function eliminar() {
        $this->needAuth();
        if ($this->isPost()) {
            $this->verify_csrf();
            $id = (int)($_POST['id'] ?? 0);
            TokenApi::delete($id);
        }
        $this->redirect('tokens_api');
    }
}
?>

