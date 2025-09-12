
<div class="card">
    <h2>Crear Usuario</h2>
    <?php if (!empty($error)): ?>
        <div class="alert err"><?= $error ?></div>
    <?php endif; ?>
    <form method="post">
        <?= \Csrf::field() ?>
        <div class="form-row">
            <div class="col-6">
                <label>Nombre</label>
                <input class="input" type="text" name="nombre" required>
            </div>
            <div class="col-6">
                <label>Apellido</label>
                <input class="input" type="text" name="apellido" required>
            </div>
            <div class="col-6">
                <label>Usuario</label>
                <input class="input" type="text" name="usuario" required>
            </div>
            <div class="col-6">
                <label>Teléfono</label>
                <input class="input" type="text" name="telefono">
            </div>
            <div class="col-6">
                <label>Contraseña</label>
                <input class="input" type="password" name="password" required>
            </div>
            <div class="col-6">
                <label>Rol</label>
                <select class="input" name="rol">
                    <option value="cliente">Cliente</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div class="col-12">
                <button class="btn primary" type="submit">Guardar</button>
                <a class="btn" href="<?= BASE_URL ?>usuarios">Cancelar</a>
            </div>
        </div>
    </form>
</div>
<?php include __DIR__."/../partials/footer.php"; ?>
