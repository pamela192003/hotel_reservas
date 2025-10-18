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
            <h1 class="h3 fw-bold">Reservas</h1>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalNuevaReserva">
                <i class="bi bi-plus-circle"></i> Registrar Reserva
            </button>
        </div>

        <!-- FILTROS Y BÚSQUEDA -->
        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-12 col-md-6 col-lg-3">
                        <label for="buscar" class="form-label fw-bold">Buscar</label>
                        <input type="text" class="form-control" id="buscar" placeholder="Nombre de usuario o habitación...">
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <label for="estado-filtro" class="form-label fw-bold">Estado</label>
                        <select class="form-select" id="estado-filtro">
                            <option value="">Todos</option>
                            <option value="pendiente">Pendiente</option>
                            <option value="confirmada">Confirmada</option>
                            <option value="cancelada">Cancelada</option>
                            <option value="finalizada">Finalizada</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <label for="fecha-desde" class="form-label fw-bold">Desde</label>
                        <input type="date" class="form-control" id="fecha-desde">
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <label for="fecha-hasta" class="form-label fw-bold">Hasta</label>
                        <input type="date" class="form-control" id="fecha-hasta">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <button class="btn btn-outline-primary" type="button">
                            <i class="bi bi-search"></i> Filtrar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- TABLA DE RESERVAS -->
        <div class="card border-0 shadow-sm">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="fw-bold">#</th>
                            <th class="fw-bold">Usuario</th>
                            <th class="fw-bold">Habitación</th>
                            <th class="fw-bold">Hotel</th>
                            <th class="fw-bold">Fecha Inicio</th>
                            <th class="fw-bold">Fecha Fin</th>
                            <th class="fw-bold">Estado</th>
                            <th class="fw-bold">Monto</th>
                            <th class="fw-bold">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tbody-reservas">
<!--                         <tr>
                            <td class="fw-bold">21</td>
                            <td>Admin Sistema</td>
                            <td><span class="badge bg-info text-dark">21</span></td>
                            <td>tres dilan</td>
                            <td>2025-09-16</td>
                            <td>2025-09-18</td>
                            <td><span class="badge bg-danger">Cancelada</span></td>
                            <td class="fw-bold text-success">S/. 2,112.00</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary" title="Ver">
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

    <!-- MODAL DE NUEVA RESERVA -->
    <div class="modal fade" id="modalNuevaReserva" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white border-0">
                    <h5 class="modal-title" id="modalLabel">
                        <i class="bi bi-plus-circle"></i> Nueva Reserva
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="frm_new_reserva">
    <!--                     <div class="mb-3">
                            <label for="usuario" class="form-label fw-bold">Usuario</label>
                            <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Ingrese el nombre de usuario" required>
                        </div> -->
                        <div class="mb-3">
                            <label for="habitacion" class="form-label fw-bold">Habitación</label>
                            <input type="number" class="form-control" id="habitacion" name="habitacion" placeholder="Número de habitación" required>
                        </div>
                        <div class="mb-3">
                            <label for="hotel" class="form-label fw-bold">Hotel</label>
                            <input type="number" class="form-control" id="hotel" name="hotel" placeholder="hotel id" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="fechaInicio" class="form-label fw-bold">Fecha de Inicio</label>
                                <input type="date" class="form-control" id="fechaInicio" name="fechaInicio" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="fechaFin" class="form-label fw-bold">Fecha de Fin</label>
                                <input type="date" class="form-control" id="fechaFin" name="fechaFin" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="monto" class="form-label fw-bold">Monto</label>
                                <input type="number" class="form-control" id="monto" name="monto" placeholder="S/. 0.00" step="0.01" required>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-top-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="registrarReserva();">
                        <i class="bi bi-check-circle"></i> Guardar Reserva
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo BASE_URL;?>src/view/js/reservas.js"></script>