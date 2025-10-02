<section class="card">
    <h2>Editar Cliente API</h2>
    <p class="muted">Edita los datos del cliente.</p>
    <form method="post">
        <?= \Csrf::field() ?>
        <div class="form-row two-cols">
            <div class="col">
                <label>RUC</label>
                <input class="input" type="text" name="ruc" value="<?= htmlspecialchars($cliente['ruc']) ?>" required>
            </div>
            <div class="col">
                <label>Razón Social</label>
                <input class="input" type="text" name="razon_social" value="<?= htmlspecialchars($cliente['razon_social']) ?>" required>
            </div>
        </div>
        <div class="form-row two-cols">
            <div class="col">
                <label>Teléfono</label>
                <input class="input" type="text" name="telefono" value="<?= htmlspecialchars($cliente['telefono']) ?>">
            </div>
            <div class="col">
                <label>Correo</label>
                <input class="input" type="email" name="correo" value="<?= htmlspecialchars($cliente['correo']) ?>">
            </div>
        </div>
        <div class="form-row">
            <div class="col-12">
                <button class="btn primary">Guardar</button>
                <a class="btn" href="<?= BASE_URL ?>client_api">Cancelar</a>
            </div>
        </div>
    </form>
</section>
