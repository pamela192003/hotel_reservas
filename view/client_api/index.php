<section>
    <h2 style="margin:0 0 8px;font-size:28px">Clientes API</h2>
    <div class="card" style="padding:0">
        <div style="padding:14px 16px;border-bottom:1px solid #e5e7eb;display:flex;justify-content:space-between;align-items:center">
            <strong>Listado</strong>
            <a class="btn primary" href="<?= BASE_URL ?>client_api/crear">Nuevo</a>
        </div>
        <div style="padding:16px; overflow:auto">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>RUC</th>
                        <th>Razón Social</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clientes as $cliente): ?>
                        <tr>
                            <td><?= $cliente['id'] ?></td>
                            <td><?= $cliente['ruc'] ?></td>
                            <td><?= $cliente['razon_social'] ?></td>
                            <td><?= $cliente['telefono'] ?></td>
                            <td><?= $cliente['correo'] ?></td>
                            <td><span class="badge <?= $cliente['estado'] ? 'active' : 'inactive' ?>"><?= $cliente['estado'] ? 'Activo' : 'Inactivo' ?></span></td>
                            <td>
                                <a class="btn small" href="<?= BASE_URL ?>client_api/editar?id=<?= $cliente['id'] ?>">Editar</a>
                                <form method="post" action="<?= BASE_URL ?>client_api/cambiar_estado" style="display:inline-block;">
                                    <?= \Csrf::field() ?>
                                    <input type="hidden" name="id" value="<?= $cliente['id'] ?>">
                                    <input type="hidden" name="estado" value="<?= $cliente['estado'] ? 0 : 1 ?>">
                                    <button type="submit" class="btn small"><?= $cliente['estado'] ? 'Desactivar' : 'Activar' ?></button>
                                </form>
                                <!--<form method="post" action="<?= BASE_URL ?>client_api/eliminar" style="display:inline-block;">
                                    <?= \Csrf::field() ?>
                                    <input type="hidden" name="id" value="<?= $cliente['id'] ?>">
                                    <button type="submit" class="btn small danger">Eliminar</button>
                                </form>-->
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
