<?php /* $is_login is set in BaseController */ ?>
<div class="auth-card-simple">
  <h1 class="auth-title-simple">Iniciar sesión</h1>
  <?php if(!empty($error)): ?><div class="alert err" style="border-radius:12px"><?= $error ?></div><?php endif; ?>
  <form method="post" style="display:grid; gap:16px; margin-top:12px">
    <?= \Csrf::field() ?>
    <div class="field">
      <label class="label">Usuario</label>
      <input class="input-light" type="text" name="usuario" placeholder="Ingrese usuario" required>
    </div>
    <div class="field">
      <label class="label">Contraseña</label>
      <input class="input-light" type="password" name="password" placeholder="Ingrese contraseña" required>
    </div>
    <button class="btn-gradient" type="submit">Entrar</button>
  </form>
</div>