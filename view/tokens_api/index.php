
<section>
    <h2 style="margin:0 0 8px;font-size:28px">Tokens API</h2>
    <div class="card" style="padding:0">
        <div style="padding:14px 16px;border-bottom:1px solid #e5e7eb;display:flex;justify-content:space-between;align-items:center">
            <strong>Listado</strong>
            <a class="btn primary" href="<?= BASE_URL ?>tokens_api/crear">Nuevo</a>
        </div>
        <div style="padding:16px; overflow:auto">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Cliente</th>
                        <th>Token</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($tokens as $token): ?>
                    <tr>
                        <td><?= $token['id'] ?></td>
                        <td><?= htmlspecialchars($token['razon_social']) ?></td>
                        <td>
                            <?= substr(htmlspecialchars($token['token']), 0, 10) . '...' ?>
                            <button type="button" class="btn small" onclick="navigator.clipboard.writeText('<?= htmlspecialchars($token['token']) ?>')">Copiar</button>
                        </td>
                        <td>
                            <span class="badge <?= $token['estado'] ? 'active' : 'inactive' ?>">
                                <?= $token['estado'] ? 'Activo' : 'Inactivo' ?>
                            </span>
                        </td>
                        <td>
                            <a class="btn small" href="<?= BASE_URL ?>tokens_api/editar?id=<?= $token['id'] ?>">Editar</a>

                            <form method="post" action="<?= BASE_URL ?>tokens_api/cambiar_estado" style="display:inline-block;">
                                <?= \Csrf::field() ?>
                                <input type="hidden" name="id" value="<?= $token['id'] ?>">
                                <input type="hidden" name="estado" value="<?= $token['estado'] ? 0 : 1 ?>">
                                <button type="submit" class="btn small"><?= $token['estado'] ? 'Desactivar' : 'Activar' ?></button>
                            </form>

                            <form method="post" action="<?= BASE_URL ?>tokens_api/eliminar" style="display:inline-block;">
                                <?= \Csrf::field() ?>
                                <input type="hidden" name="id" value="<?= $token['id'] ?>">
                                <button type="submit" class="btn small danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

