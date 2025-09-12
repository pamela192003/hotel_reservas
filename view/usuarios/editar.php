
<div class="card">
    <h2>Editar Usuario</h2>
    <?php if (!empty($error)): ?>
        <div class="alert err"><?= $error ?></div>
    <?php endif; ?>
    <form method="post">
        <?= \Csrf::field() ?>
        <input type="hidden" name="id" value="<?= $usuario['id_usuario'] ?>">
        <div class="form-row">
            <div class="col-6">
                <label>Nombre</label>
                <input class="input" type="text" name="nombre" value="<?= htmlspecialchars($usuario['nombre']) ?>" required>
            </div>
            <div class="col-6">
                <label>Apellido</label>
                <input class="input" type="text" name="apellido" value="<?= htmlspecialchars($usuario['apellido']) ?>" required>
            </div>
            <div class="col-6">
                <label>Usuario</label>
                <input class="input" type="text" name="usuario" value="<?= htmlspecialchars($usuario['usuario']) ?>" required>
            </div>
            <div class="col-6">
                <label>Teléfono</label>
                <input class="input" type="text" name="telefono" value="<?= htmlspecialchars($usuario['telefono']) ?>">
            </div>
            <div class="col-6">
                <label>Rol</label>
                <select class="input" name="rol">
                    <option value="cliente" <?= $usuario['rol'] === 'cliente' ? 'selected' : '' ?>>Cliente</option>
                    <option value="admin" <?= $usuario['rol'] === 'admin' ? 'selected' : '' ?>>Administrador</option>
                </select>
            </div>
            <div class="col-12">
                <button class="btn primary" type="submit">Actualizar</button>
                <a class="btn" href="<?= BASE_URL ?>usuarios">Cancelar</a>
            </div>
        </div>
    </form>
</div>
<?php include __DIR__."/../partials/footer.php"; ?>
