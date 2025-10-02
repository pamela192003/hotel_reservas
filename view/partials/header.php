<?php $user = $_SESSION['user'] ?? null; ?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Reservas de Hotel</title>
  <link rel="stylesheet" href="<?= BASE_URL ?>/../assets/css/app.css">
</head>
<body class="<?= !empty($is_login) ? 'auth-bg' : '' ?>">
<?php if(empty($is_login)): ?>
  <div class="app-shell">
    <aside class="sidebar">
      <div class="brand">
        <div class="logo"></div>
        <div style="font-weight:800">RESERVAS</div>
      </div>
      <nav class="side-nav">
        <a class="side-link <?= ($_GET['url'] ?? '')=='' || strpos($_GET['url'] ?? '','panel')===0 ? 'active' : '' ?>" href="<?= BASE_URL ?>panel">📊 <span>Dashboard</span></a>
        <a class="side-link <?= strpos($_GET['url'] ?? '','reservas')===0 ? 'active' : '' ?>" href="<?= BASE_URL ?>reservas">🗂️ <span>Reservas</span></a>
        <a class="side-link <?= strpos($_GET['url'] ?? '','usuarios')===0 ? 'active' : '' ?>" href="<?= BASE_URL ?>usuarios">👥 <span>Usuarios</span></a>

        <!-- Nuevos enlaces para client_api y tokens_api -->
       <a class="side-link <?= strpos($_GET['url'] ?? '', 'client_api') === 0 ? 'active' : '' ?>" href="<?= BASE_URL ?>client_api">🏢 <span>Clientes API</span></a>
<a class="side-link <?= strpos($_GET['url'] ?? '', 'tokens_api') === 0 ? 'active' : '' ?>" href="<?= BASE_URL ?>tokens_api">🔑 <span>Tokens API</span></a>

        <a class="side-link" href="<?= BASE_URL ?>reservas/crear">➕ <span>Nueva</span></a>
        <a class="side-link" href="<?= BASE_URL ?>/../auth/logout">🚪 <span>Salir</span></a>
      </nav>
    </aside>
    <main class="main">
      <div class="topbar">
        <div style="font-weight:800;color:#0f172a">RESERVAS DE HOTEL · Panel</div>
        <div><?= $user ? '👤 '.htmlspecialchars($user['nombre']) : '' ?></div>
      </div>
      <div class="main-content">
<?php endif; ?>
