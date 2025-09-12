<?php
require_once __DIR__."/src/config/config.php";
require_once __DIR__."/library/BaseController.php";

// Simple router
$url = $_GET['url'] ?? '';
$parts = array_values(array_filter(explode('/', $url)));
$controller = $parts[0] ?? 'panel';
$action = $parts[1] ?? 'index';

function loadAndRun($ctrlName, $action) {
    global $parts;
    $map = [
        'auth' => ['file' => __DIR__.'/src/control/AuthController.php', 'class'=>'AuthController'],
        'reservas' => ['file' => __DIR__.'/src/control/ReservasController.php', 'class'=>'ReservasController'],
        'pagos' => ['file' => __DIR__.'/src/control/PagosController.php', 'class'=>'PagosController'],
        'panel' => ['file' => __DIR__.'/src/control/PanelController.php', 'class'=>'PanelController'],
        'usuarios' => ['file' => __DIR__.'/src/control/UsuariosController.php', 'class'=>'UsuariosController']
    ];

    if(!isset($map[$ctrlName])) {
        http_response_code(404);
        echo "404";
        return;
    }

    require_once $map[$ctrlName]['file'];
    $class = $map[$ctrlName]['class'];
    $instance = new $class();

    // Extrae los parámetros adicionales de la URL (ej: usuarios/editar/5)
    $params = array_slice($parts, 2);

    if(!method_exists($instance, $action)) {
        $action = 'index';
    }

    // Llama al método con los parámetros extraídos
    call_user_func_array([$instance, $action], $params);
}


if($controller==='auth' && $action==='registrar'){
  // simple registration page in-line to keep minimal
  require_once __DIR__.'/model/Usuario.php';
  require_once __DIR__.'/library/Csrf.php';
  include __DIR__.'/view/partials/header.php';
  if($_SERVER['REQUEST_METHOD']==='POST'){
    if(($_POST['csrf']??'') !== ($_SESSION['csrf']??'')) die("CSRF inválido");
    Usuario::create($_POST['nombre'],$_POST['apellido'],$_POST['usuario'],$_POST['telefono'],$_POST['password']);
    echo '<section class="card"><div class="alert ok">Cuenta creada, ahora inicia sesión.</div><a class="btn" href="'.BASE_URL.'auth/login">Ir al login</a></section>';
  } else {
    echo '<section class="card"><h2>Registro</h2><form method="post">'.\Csrf::field().'
      <div class="form-row">
        <div class="col-6"><label>Nombre</label><input class="input" name="nombre" required></div>
        <div class="col-6"><label>Apellido</label><input class="input" name="apellido" required></div>
        <div class="col-6"><label>Usuario</label><input class="input" name="usuario" required></div>
        <div class="col-6"><label>Teléfono</label><input class="input" name="telefono"></div>
        <div class="col-6"><label>Contraseña</label><input class="input" type="password" name="password" required></div>
        <div class="col-12"><button class="btn primary">Crear</button> <a class="btn" href="'.BASE_URL.'auth/login">Cancelar</a></div>
      </div></form></section>';
  }
  include __DIR__.'/view/partials/footer.php';
  exit;
}

loadAndRun($controller,$action);