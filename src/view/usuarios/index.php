
<div class="card">
    <h2>Listado de Usuarios</h2>
    <a class="btn primary" href="<?= BASE_URL ?>usuarios/crear">Crear Usuario</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Usuario</th>
                <th>Teléfono</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <td><?= $usuario['id_usuario'] ?></td>
                <td><?= htmlspecialchars($usuario['nombre']) ?></td>
                <td><?= htmlspecialchars($usuario['apellido']) ?></td>
                <td><?= htmlspecialchars($usuario['usuario']) ?></td>
                <td><?= htmlspecialchars($usuario['telefono']) ?></td>
                <td><?= htmlspecialchars($usuario['rol']) ?></td>
                <td>
    <a class="btn small" href="<?= BASE_URL ?>usuarios/editar/<?= $usuario['id_usuario'] ?>">Editar</a>
    <a class="btn small danger" href="<?= BASE_URL ?>usuarios/eliminar/<?= $usuario['id_usuario'] ?>" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">Eliminar</a>
</td>

            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php include __DIR__."/../partials/footer.php"; ?>
