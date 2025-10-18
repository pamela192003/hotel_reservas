 
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
            <h1 class="h3 fw-bold">Clientes API</h1>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalNuevoCliente">
                <i class="bi bi-plus-circle"></i> Crear Cliente
            </button>
        </div>

        <!-- FILTROS Y BÚSQUEDA -->
        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-12 col-md-6 col-lg-4">
                        <label for="buscar" class="form-label fw-bold">Buscar</label>
                        <input type="text" class="form-control" id="buscar" placeholder="Nombre o empresa...">
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <label for="estado-filtro" class="form-label fw-bold">Estado</label>
                        <select class="form-select" id="estado-filtro">
                            <option value="">Todos</option>
                            <option value="activo">Activo</option>
                            <option value="inactivo">Inactivo</option>
                            <option value="suspendido">Suspendido</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <label class="form-label fw-bold">&nbsp;</label>
                        <button class="btn btn-outline-primary w-100" type="button">
                            <i class="bi bi-search"></i> Filtrar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- TABLA DE CLIENTES API -->
        <div class="card border-0 shadow-sm">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="fw-bold">#</th>
                            <th class="fw-bold">Nombre Cliente</th>
                            <th class="fw-bold">Empresa</th>
                            <th class="fw-bold">Email</th>
                            <th class="fw-bold">Teléfono</th>
                            <th class="fw-bold">Estado</th>
                            <th class="fw-bold">Tokens</th>
                            <th class="fw-bold">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="fw-bold">1</td>
                            <td>Tech Solutions S.A.</td>
                            <td>Tech Solutions</td>
                            <td>contact@techsolutions.com</td>
                            <td>+51 987 654 001</td>
                            <td><span class="badge bg-success">Activo</span></td>
                            <td><span class="badge bg-info text-dark">3 tokens</span></td>
                            <td>
                                <button class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#modalGestionTokens" title="Gestionar Tokens">
                                    <i class="bi bi-key"></i>
                                </button>
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
                        </tr>
                        <tr>
                            <td class="fw-bold">2</td>
                            <td>Digital Innovations</td>
                            <td>Digital Innovations LLC</td>
                            <td>api@digitalinnovations.com</td>
                            <td>+51 987 654 002</td>
                            <td><span class="badge bg-success">Activo</span></td>
                            <td><span class="badge bg-info text-dark">2 tokens</span></td>
                            <td>
                                <button class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#modalGestionTokens" title="Gestionar Tokens">
                                    <i class="bi bi-key"></i>
                                </button>
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
                        </tr>
                        <tr>
                            <td class="fw-bold">3</td>
                            <td>Cloud Services Pro</td>
                            <td>Cloud Services Pro</td>
                            <td>info@cloudservicespro.com</td>
                            <td>+51 987 654 003</td>
                            <td><span class="badge bg-success">Activo</span></td>
                            <td><span class="badge bg-info text-dark">5 tokens</span></td>
                            <td>
                                <button class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#modalGestionTokens" title="Gestionar Tokens">
                                    <i class="bi bi-key"></i>
                                </button>
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
                        </tr>
                        <tr>
                            <td class="fw-bold">4</td>
                            <td>Enterprise Systems</td>
                            <td>Enterprise Systems Inc</td>
                            <td>enterprise@systemsinc.com</td>
                            <td>+51 987 654 004</td>
                            <td><span class="badge bg-warning text-dark">Inactivo</span></td>
                            <td><span class="badge bg-secondary">1 token</span></td>
                            <td>
                                <button class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#modalGestionTokens" title="Gestionar Tokens">
                                    <i class="bi bi-key"></i>
                                </button>
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
                        </tr>
                        <tr>
                            <td class="fw-bold">5</td>
                            <td>Mobile First Development</td>
                            <td>Mobile First Dev</td>
                            <td>dev@mobilefirst.com</td>
                            <td>+51 987 654 005</td>
                            <td><span class="badge bg-success">Activo</span></td>
                            <td><span class="badge bg-info text-dark">4 tokens</span></td>
                            <td>
                                <button class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#modalGestionTokens" title="Gestionar Tokens">
                                    <i class="bi bi-key"></i>
                                </button>
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
                        </tr>
                        <tr>
                            <td class="fw-bold">6</td>
                            <td>Data Analytics Corp</td>
                            <td>Data Analytics</td>
                            <td>analytics@datacorp.com</td>
                            <td>+51 987 654 006</td>
                            <td><span class="badge bg-danger">Suspendido</span></td>
                            <td><span class="badge bg-secondary">0 tokens</span></td>
                            <td>
                                <button class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#modalGestionTokens" title="Gestionar Tokens">
                                    <i class="bi bi-key"></i>
                                </button>
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
                        </tr>
                        <tr>
                            <td class="fw-bold">7</td>
                            <td>Web Design Studio</td>
                            <td>Web Design Studio</td>
                            <td>studio@webdesign.com</td>
                            <td>+51 987 654 007</td>
                            <td><span class="badge bg-success">Activo</span></td>
                            <td><span class="badge bg-info text-dark">2 tokens</span></td>
                            <td>
                                <button class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#modalGestionTokens" title="Gestionar Tokens">
                                    <i class="bi bi-key"></i>
                                </button>
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
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- PAGINACIÓN -->
            <div class="card-footer bg-white border-top">
                <div class="d-flex justify-content-between align-items-center">
                    <small class="text-muted">Mostrando 1-7 de 7 registros</small>
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

    <!-- MODAL DE NUEVO CLIENTE API -->
    <div class="modal fade" id="modalNuevoCliente" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white border-0">
                    <h5 class="modal-title" id="modalLabel">
                        <i class="bi bi-plus-circle"></i> Crear Nuevo Cliente API
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nombreCliente" class="form-label fw-bold">Nombre del Cliente</label>
                                <input type="text" class="form-control" id="nombreCliente" placeholder="Nombre de la empresa" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="empresaCliente" class="form-label fw-bold">Empresa</label>
                                <input type="text" class="form-control" id="empresaCliente" placeholder="Nombre empresa" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="emailCliente" class="form-label fw-bold">Email</label>
                                <input type="email" class="form-control" id="emailCliente" placeholder="correo@empresa.com" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="telefonoCliente" class="form-label fw-bold">Teléfono</label>
                                <input type="tel" class="form-control" id="telefonoCliente" placeholder="+51 987 654 321" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="estadoCliente" class="form-label fw-bold">Estado</label>
                                <select class="form-select" id="estadoCliente" required>
                                    <option value="activo">Activo</option>
                                    <option value="inactivo">Inactivo</option>
                                    <option value="suspendido">Suspendido</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="limitRequests" class="form-label fw-bold">Límite de Requests</label>
                                <input type="number" class="form-control" id="limitRequests" placeholder="10000" min="100" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label fw-bold">Descripción / Notas</label>
                            <textarea class="form-control" id="descripcion" rows="3" placeholder="Información adicional del cliente..."></textarea>
                        </div>
                        <div class="alert alert-info" role="alert">
                            <i class="bi bi-info-circle"></i>
                            <strong>Nota:</strong> Después de crear el cliente podrás generar sus tokens API.
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-top-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i> Crear Cliente
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL DE GESTIÓN DE TOKENS -->
    <div class="modal fade" id="modalGestionTokens" tabindex="-1" aria-labelledby="modalTokensLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-info text-white border-0">
                    <h5 class="modal-title" id="modalTokensLabel">
                        <i class="bi bi-key"></i> Gestión de Tokens - Tech Solutions S.A.
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- SECCIÓN GENERAR TOKEN -->
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3">Generar Nuevo Token</h6>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Nombre del token (ej: Production, Development)...">
                            <button class="btn btn-success" type="button">
                                <i class="bi bi-plus-circle"></i> Generar Token
                            </button>
                        </div>
                    </div>

                    <hr>

                    <!-- SECCIÓN LISTADO DE TOKENS -->
                    <div>
                        <h6 class="fw-bold mb-3">Tokens del Cliente</h6>
                        <div class="table-responsive">
                            <table class="table table-sm table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th class="fw-bold">Nombre</th>
                                        <th class="fw-bold">Token</th>
                                        <th class="fw-bold">Estado</th>
                                        <th class="fw-bold">Fecha Creación</th>
                                        <th class="fw-bold">Último Uso</th>
                                        <th class="fw-bold">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="fw-bold">Production Token</td>
                                        <td>
                                            <code class="text-muted">sk_live_abc123def456...</code>
                                            <button class="btn btn-sm btn-link p-0 ms-2" title="Copiar">
                                                <i class="bi bi-clipboard"></i>
                                            </button>
                                        </td>
                                        <td><span class="badge bg-success">Activo</span></td>
                                        <td>2025-01-15</td>
                                        <td>2025-10-17 14:30</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-warning" title="Desactivar">
                                                <i class="bi bi-toggle-on"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger" title="Eliminar">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Development Token</td>
                                        <td>
                                            <code class="text-muted">sk_test_ghi789jkl012...</code>
                                            <button class="btn btn-sm btn-link p-0 ms-2" title="Copiar">
                                                <i class="bi bi-clipboard"></i>
                                            </button>
                                        </td>
                                        <td><span class="badge bg-success">Activo</span></td>
                                        <td>2025-02-20</td>
                                        <td>2025-10-10 09:15</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-warning" title="Desactivar">
                                                <i class="bi bi-toggle-on"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger" title="Eliminar">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Staging Token</td>
                                        <td>
                                            <code class="text-muted">sk_test_mno345pqr678...</code>
                                            <button class="btn btn-sm btn-link p-0 ms-2" title="Copiar">
                                                <i class="bi bi-clipboard"></i>
                                            </button>
                                        </td>
                                        <td><span class="badge bg-secondary">Inactivo</span></td>
                                        <td>2025-03-10</td>
                                        <td>-</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-success" title="Activar">
                                                <i class="bi bi-toggle-off"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger" title="Eliminar">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <small class="text-muted d-block mt-2">
                            <i class="bi bi-info-circle"></i> Total: 3 tokens
                        </small>
                    </div>
                </div>
                <div class="modal-footer border-top-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo BASE_URL;?>src/view/js/clients_api.js"></script>
    <script src="<?php echo BASE_URL;?>src/view/js/tokens_api.js"></script>
