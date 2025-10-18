  <style>
        /* ==================== CSS PARA ESPACIOS (HEADER Y SIDEBAR) ==================== */
        body {
            margin: 0;
            padding: 0;
        }

        section {
            margin-left: 200px;
            margin-top: 70px;
            padding: 32px;
            min-height: calc(100vh - 70px);
            background-color: #f5f7fa;
        }

        @media (max-width: 768px) {
            section {
                margin-left: 60px;
            }
        }
    </style>

      <section>
        <!-- ENCABEZADO CON TÍTULO Y BOTÓN -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 fw-bold">Usuarios</h1>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalNuevoUsuario">
                <i class="bi bi-person-plus"></i> Crear Usuario
            </button>
        </div>

        <!-- FILTROS Y BÚSQUEDA -->
        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-12 col-md-6 col-lg-3">
                        <label for="buscar" class="form-label fw-bold">Buscar</label>
                        <input type="text" class="form-control" id="buscar" placeholder="Nombre o correo...">
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <label for="rol-filtro" class="form-label fw-bold">Rol</label>
                        <select class="form-select" id="rol-filtro">
                            <option value="">Todos</option>
                            <option value="admin">Administrador</option>
                            <option value="recepcionista">Recepcionista</option>
                            <option value="gerente">Gerente</option>
                            <option value="cliente">Cliente</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <label for="estado-filtro" class="form-label fw-bold">Estado</label>
                        <select class="form-select" id="estado-filtro">
                            <option value="">Todos</option>
                            <option value="activo">Activo</option>
                            <option value="inactivo">Inactivo</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <label class="form-label fw-bold">&nbsp;</label>
                        <button class="btn btn-outline-primary w-100" type="button">
                            <i class="bi bi-search"></i> Filtrar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- TABLA DE USUARIOS -->
        <div class="card border-0 shadow-sm">
            <div class="table-responsive">
                <table class="table table-hover mb-0" id="tbl_users">
                    <thead class="table-light">
                        <tr>
                            <th class="fw-bold">#</th>
                            <th class="fw-bold">Nombre</th>
                            <th class="fw-bold">apellido</th>
                            <th class="fw-bold">usuario</th>
                            <th class="fw-bold">Rol</th>
                            <th class="fw-bold">Teléfono</th>
                            <th class="fw-bold">Estado</th>
                            <th class="fw-bold">Fecha Registro</th>
                            <th class="fw-bold">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tbody_users">
<!--                         <tr>
                            <td class="fw-bold">1</td>
                            <td>Admin Sistema</td>
                            <td>apellido</td>
                            <td>user</td>
                            <td><span class="badge bg-danger">Administrador</span></td>
                            <td>+51 987 654 321</td>
                            <td><span class="badge bg-success">Activo</span></td>
                            <td>2025-01-15</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary" title="Ver detalles">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-warning" title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger" title="Eliminar">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr> -->
                    </tbody>
                </table>
            </div>

            <!-- PAGINACIÓN -->
            <div class="card-footer bg-white border-top">
                <div class="d-flex justify-content-between align-items-center">
                    <small class="text-muted">Mostrando 1-9 de 9 registros</small>
                    <nav aria-label="Page navigation">
                        <ul class="pagination pagination-sm mb-0">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Anterior</a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item disabled">
                                <a class="page-link" href="#">Siguiente</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- MODAL DE NUEVO USUARIO -->
    <div class="modal fade" id="modalNuevoUsuario" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white border-0">
                    <h5 class="modal-title" id="modalLabel">
                        <i class="bi bi-person-plus"></i> Crear Nuevo Usuario
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="frm_registrar_user">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nombre" class="form-label fw-bold">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre completo" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="apellido" class="form-label fw-bold">Apellido</label>
                                <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="usuario" class="form-label fw-bold">usuario</label>
                                <input type="email" class="form-control" id="usuario" name="usuario" placeholder="correo@ejemplo.com" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="telefono" class="form-label fw-bold">Teléfono</label>
                                <input type="tel" class="form-control" id="telefono" name="telefono" placeholder="+51 987 654 321" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="rol" class="form-label fw-bold">Rol</label>
                                <select class="form-select" id="rol" name="rol" required>
                                    <option value="">Seleccione un rol</option>
                                    <option value="admin">Administrador</option>
                                    <option value="cliente">Cliente</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="contrasena" class="form-label fw-bold">Contraseña</label>
                                <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="••••••••" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="confirmarContrasena" class="form-label fw-bold">Confirmar Contraseña</label>
                                <input type="password" class="form-control" id="confirmarContrasena" placeholder="••••••••" required>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-top-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="registrar_usuario()">
                        <i class="bi bi-check-circle"></i> Crear Usuario
                    </button>
                </div>
            </div>
        </div>
    </div>

   <!--  modal de editar usuario -->
    <div class="modal fade" id="modalEditarUsuario" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white border-0">
                    <h5 class="modal-title" id="modalLabel">
                        <i class="bi bi-person-plus"></i> Actualizar Usuario
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="frm_act_user">
                        <div class="row">
                            <input type="hidden" name="data" value="" id="data">
                            <div class="col-md-6 mb-3">
                                <label for="nombre-n" class="form-label fw-bold">Nombre</label>
                                <input type="text" class="form-control" id="nombre-n" name="nombre-n" placeholder="Nombre completo" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="apellido-n" class="form-label fw-bold">Apellido</label>
                                <input type="text" class="form-control" id="apellido-n" name="apellido-n" placeholder="Apellido" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="usuario-n" class="form-label fw-bold">usuario</label>
                                <input type="email" class="form-control" id="usuario-n" name="usuario-n" placeholder="correo@ejemplo.com" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="telefono-n" class="form-label fw-bold">Teléfono</label>
                                <input type="tel" class="form-control" id="telefono-n" name="telefono-n" placeholder="+51 987 654 321" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="rol-n" class="form-label fw-bold">Rol</label>
                                <select class="form-select" id="rol-n" name="rol-n" required>
                                    <option value="">Seleccione un rol</option>
                                    <option value="admin">Administrador</option>
                                    <option value="cliente">Cliente</option>
                                </select>
                            </div>
                             <div class="col-md-6 mb-3">
                                <label for="estado-n" class="form-label fw-bold">Estado</label>
                                <select class="form-select" id="estado-n" name="estado-n" required>
                                    <option value="1">Activo</option>
                                    <option value="0">Inactivo</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-top-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="actualizarUser()">
                        <i class="bi bi-check-circle"></i> Actualizar usuario
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo BASE_URL;?>src/view/js/usuarios.js"></script>
