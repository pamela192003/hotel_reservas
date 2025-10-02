<section class="card">
    <h2>Editar Token API</h2>
    <p class="muted">Edita los datos del token.</p>
    <form method="post">
        <?= \Csrf::field() ?>
        <div class="form-row">
            <div class="col">
                <label>Cliente</label>
                <select class="input" name="id_client_api" required>
                    <?php foreach ($clientes as $cliente): ?>
                        <option value="<?= $cliente['id'] ?>" <?= $cliente['id'] == $token['id_client_api'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($cliente['razon_social']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <label>Token</label>
                <input class="input" type="text" name="token" value="<?= htmlspecialchars($token['token']) ?>" required>
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
