 
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
                            <th class="fw-bold">RUC</th>
                            <th class="fw-bold">Empresa</th>
                            <th class="fw-bold">Teléfono</th>
                            <th class="fw-bold">Correo</th>                           
                            <th class="fw-bold">Estado</th>
                            <th class="fw-bold">Tokens</th>
                            <th class="fw-bold">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tbody_clientsApi">
<!--                         <tr>
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
                        </tr>   -->           
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
                    <form id="new_clienteApi">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="ruc" class="form-label fw-bold">Ruc</label>
                                <input type="text" class="form-control" id="ruc" name="ruc" placeholder="Nombre de la empresa" required>
                                <span class=" text-secondary"> *11 digitos</span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="empresaCliente" class="form-label fw-bold">Empresa</label>
                                <input type="text" class="form-control" id="empresaCliente" name="empresaCliente" placeholder="Nombre empresa" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="emailCliente" class="form-label fw-bold">Email</label>
                                <input type="email" class="form-control" id="emailCliente" name="emailCliente" placeholder="correo@empresa.com" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="telefonoCliente" class="form-label fw-bold">Teléfono</label>
                                <input type="tel" class="form-control" id="telefonoCliente" name="telefonoCliente" placeholder="+51 987 654 321" required>
                            </div>
                        </div>
<!--                         <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="estadoCliente" class="form-label fw-bold">Estado</label>
                                <select class="form-select" id="estadoCliente" required>
                                    <option value="activo">Activo</option>
                                    <option value="inactivo">Inactivo</option>
                                    <option value="suspendido">Suspendido</option>
                                </select>
                            </div>
                        </div> -->
                        <div class="alert alert-info" role="alert">
                            <i class="bi bi-info-circle"></i>
                            <strong>Nota:</strong> Después de crear el cliente podrás generar sus tokens API.
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-top-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="registrarCliente();">
                        <i class="bi bi-check-circle"></i> Crear Cliente
                    </button>
                </div>
            </div>
        </div>
    </div>

        <!-- MODAL DE actualizar CLIENTE API -->
    <div class="modal fade" id="modalEditarCliente" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white border-0">
                    <h5 class="modal-title" id="modalLabel">
                        <i class="bi bi-plus-circle"></i>actualizar Cliente API
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="act_clienteApi">
                        <div class="row">
                            <input type="hidden" name="data" id="data" value="">
                            <div class="col-md-6 mb-3">
                                <label for="ruc-n" class="form-label fw-bold">Ruc</label>
                                <input type="text" class="form-control" id="ruc-n" name="ruc-n" placeholder="Nombre de la empresa" required>
                                <span class=" text-secondary"> *11 digitos</span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="empresaCliente-n" class="form-label fw-bold">Empresa</label>
                                <input type="text" class="form-control" id="empresaCliente-n" name="empresaCliente-n" placeholder="Nombre empresa" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="emailCliente-n" class="form-label fw-bold">Email</label>
                                <input type="email" class="form-control" id="emailCliente-n" name="emailCliente-n" placeholder="correo@empresa.com" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="telefonoCliente-n" class="form-label fw-bold">Teléfono</label>
                                <input type="tel" class="form-control" id="telefonoCliente-n" name="telefonoCliente-n" placeholder="+51 987 654 321" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="estadoCliente-n" class="form-label fw-bold">Estado</label>
                                <select class="form-select" id="estadoCliente-n" name="estadoCliente-n" required>
                                    <option value="1">Activo</option>
                                    <option value="0">Inactivo</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-top-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="actualizarCliente();">
                        <i class="bi bi-check-circle"></i> Actualizar Cliente
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
                        <i class="bi bi-key"></i> Gestión de Tokens
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                    <!-- SECCIÓN GENERAR TOKEN -->
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3">Generar Nuevo Token</h6>
                        <div class="input-group">
                            <button class="btn btn-success" type="button" onclick="generarToken();">
                                <i class="bi bi-plus-circle"></i> Generar Token
                            </button>
                        </div>
                    </div>
                    <input type="hidden" id="dataToken" name="dataToken" value="">

                    <hr>

                    <!-- SECCIÓN LISTADO DE TOKENS -->
                    <div>
                        <h6 class="fw-bold mb-3">Tokens del Cliente</h6>
                        <div class="table-responsive">
                            <table class="table table-sm table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th class="fw-bold">#</th>
                                        <th class="fw-bold">Token</th>
                                        <th class="fw-bold">Estado</th>
                                        <th class="fw-bold">Fecha Creación</th>
                                        <th class="fw-bold">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_tokens">
<!--                                     <tr>
                                        <td>
                                            <code class="text-muted">sk_live_abc123def456...</code>
                                            <button class="btn btn-sm btn-link p-0 ms-2" title="Copiar">
                                                <i class="bi bi-clipboard"></i>
                                            </button>
                                        </td>
                                        <td><span class="badge bg-success">Activo</span></td>
                                        <td>2025-01-15</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-warning" title="Desactivar">
                                                <i class="bi bi-toggle-on"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger" title="Eliminar">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr> -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo BASE_URL;?>src/view/js/clients_api.js"></script>
