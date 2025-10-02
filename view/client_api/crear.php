<section class="card">
    <h2>Nuevo Cliente API</h2>
    <p class="muted">Ingresa los datos del cliente.</p>
    <form method="post">
        <?= \Csrf::field() ?>
        <div class="form-row two-cols">
            <div class="col">
                <label>RUC</label>
                <input class="input" type="text" name="ruc" placeholder="Ej. 12345678901" required>
            </div>
            <div class="col">
                <label>Razón Social</label>
                <input class="input" type="text" name="razon_social" placeholder="Ej. Empresa XYZ" required>
            </div>
        </div>
        <div class="form-row two-cols">
            <div class="col">
                <label>Teléfono</label>
                <input class="input" type="text" name="telefono" placeholder="Ej. 987654321">
            </div>
            <div class="col">
                <label>Correo</label>
                <input class="input" type="email" name="correo" placeholder="Ej. contacto@empresa.com">
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
