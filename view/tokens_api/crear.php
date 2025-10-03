
<section class="card">
    <h2>Nuevo Token API</h2>
    <p class="muted">Selecciona el cliente, el token se generará automáticamente.</p>
    <form method="post">
        <?= \Csrf::field() ?>
        <div class="form-row">
            <div class="col">
                <label>Cliente</label>
                <select class="input" name="id_client_api" required>
                    <?php foreach ($clientes as $cliente): ?>
                        <option value="<?= $cliente['id'] ?>"><?= $cliente['razon_social'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="col-12">
                <button class="btn primary">Guardar</button>
                <a class="btn" href="<?= BASE_URL ?>tokens_api">Cancelar</a>
            </div>
        </div>
    </form>
</section>

