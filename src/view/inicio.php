  <style>
      section {
            margin-left: 200px;
            margin-top: 70px;
            padding: 32px;
            flex-grow: 1;
        }

        .badge-confirmada {
            background-color: #dcfce7;
            color: #166534;
        }

        .badge-cancelada {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .badge-finalizada {
            background-color: #e0e7ff;
            color: #3730a3;
        }

        .badge-pendiente {
            background-color: #fef3c7;
            color: #92400e;
        }

        .btn-edit {
            background-color: #dbeafe;
            color: #1e40af;
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .btn-edit:hover {
            background-color: #bfdbfe;
        }

        .btn-delete {
            background-color: #fee2e2;
            color: #991b1b;
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .btn-delete:hover {
            background-color: #fecaca;
        }

        .estado-select {
            padding: 6px 10px;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            font-size: 13px;
            background: white;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .estado-select:hover {
            border-color: #d1d5db;
        }

        .estado-select:focus {
            outline: none;
            border-color: #6366f1;
            box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.1);
        }

        .table-container {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            border: 1px solid #e5e7eb;
        }

        table thead {
            background: #f9fafb;
            border-bottom: 1px solid #e5e7eb;
        }

        table th {
            font-weight: 600;
            color: #6b7280;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        table tbody tr:hover {
            background: #f9fafb;
        }
  </style>
  
  
  <!-- CONTENIDO PRINCIPAL -->
    <section>
        <h1 class="mb-4">Dashboard</h1>

        <!-- CARDS DE ESTADÍSTICAS -->
        <div class="row mb-4">
            <div class="col-md-6 col-lg-3 mb-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <small class="text-muted text-uppercase fw-bold">Total Reservas</small>
                        <h2 class="mt-2 mb-2">9</h2>
                        <small class="text-muted">Todas las reservas</small>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <small class="text-muted text-uppercase fw-bold">Pendientes</small>
                        <h2 class="mt-2 mb-2">2</h2>
                        <small class="text-muted">A la espera de pago/confirmación</small>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <small class="text-muted text-uppercase fw-bold">Confirmadas</small>
                        <h2 class="mt-2 mb-2">4</h2>
                        <small class="text-muted">Pagadas y activas</small>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <small class="text-muted text-uppercase fw-bold">Canceladas</small>
                        <h2 class="mt-2 mb-2">2</h2>
                        <small class="text-muted">No vigentes</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- TABLA DE RESERVAS -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>Lista de Reservas</h3>
            <button class="btn btn-primary-gradient" data-bs-toggle="modal" data-bs-target="#modalNuevaReserva">
                Nueva
            </button>
        </div>

        <div class="table-container">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Usuario</th>
                            <th>Hab</th>
                            <th>Inicio</th>
                            <th>Fin</th>
                            <th>Estado</th>
                            <th>Monto</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>21</td>
                            <td>Admin Sistema</td>
                            <td>21</td>
                            <td>2025-09-16</td>
                            <td>2025-09-18</td>
                            <td><span class="badge badge-cancelada">cancelada</span></td>
                            <td>S/. 2,112.00</td>
                            <td>
                                <select class="estado-select">
                                    <option>Cancelada</option>
                                </select>
                                <button class="btn-edit">✎</button>
                                <button class="btn-delete">🗑</button>
                            </td>
                        </tr>
                        <tr>
                            <td>20</td>
                            <td>Admin Sistema</td>
                            <td>2</td>
                            <td>0034-04-04</td>
                            <td>2025-04-22</td>
                            <td><span class="badge badge-confirmada">confirmada</span></td>
                            <td>S/. 44.00</td>
                            <td>
                                <select class="estado-select">
                                    <option>Confirmada</option>
                                </select>
                                <button class="btn-edit">✎</button>
                                <button class="btn-delete">🗑</button>
                            </td>
                        </tr>
                        <tr>
                            <td>19</td>
                            <td>Admin Sistema</td>
                            <td>79</td>
                            <td>2025-09-01</td>
                            <td>2025-09-02</td>
                            <td><span class="badge badge-finalizada">finalizada</span></td>
                            <td>S/. 89.00</td>
                            <td>
                                <select class="estado-select">
                                    <option>Finalizada</option>
                                </select>
                                <button class="btn-edit">✎</button>
                                <button class="btn-delete">🗑</button>
                            </td>
                        </tr>
                        <tr>
                            <td>18</td>
                            <td>Admin Sistema</td>
                            <td>57</td>
                            <td>2025-09-10</td>
                            <td>2025-09-25</td>
                            <td><span class="badge badge-confirmada">confirmada</span></td>
                            <td>S/. 40.00</td>
                            <td>
                                <select class="estado-select">
                                    <option>Confirmada</option>
                                </select>
                                <button class="btn-edit">✎</button>
                                <button class="btn-delete">🗑</button>
                            </td>
                        </tr>
                        <tr>
                            <td>17</td>
                            <td>Admin Sistema</td>
                            <td>11</td>
                            <td>2025-09-04</td>
                            <td>2025-09-09</td>
                            <td><span class="badge badge-pendiente">pendiente</span></td>
                            <td>S/. 80.00</td>
                            <td>
                                <select class="estado-select">
                                    <option>Pendiente</option>
                                </select>
                                <button class="btn-edit">✎</button>
                                <button class="btn-delete">🗑</button>
                            </td>
                        </tr>
                        <tr>
                            <td>13</td>
                            <td>Carlos Ramírez</td>
                            <td>101</td>
                            <td>2025-09-15</td>
                            <td>2025-09-18</td>
                            <td><span class="badge badge-confirmada">confirmada</span></td>
                            <td>S/. 360.00</td>
                            <td>
                                <select class="estado-select">
                                    <option>Confirmada</option>
                                </select>
                                <button class="btn-edit">✎</button>
                                <button class="btn-delete">🗑</button>
                            </td>
                        </tr>
                        <tr>
                            <td>14</td>
                            <td>Carlos Ramírez</td>
                            <td>102</td>
                            <td>2025-09-20</td>
                            <td>2025-09-22</td>
                            <td><span class="badge badge-confirmada">confirmada</span></td>
                            <td>S/. 300.00</td>
                            <td>
                                <select class="estado-select">
                                    <option>Confirmada</option>
                                </select>
                                <button class="btn-edit">✎</button>
                                <button class="btn-delete">🗑</button>
                            </td>
                        </tr>
                        <tr>
                            <td>15</td>
                            <td>Lucía Martínez</td>
                            <td>201</td>
                            <td>2025-09-10</td>
                            <td>2025-09-12</td>
                            <td><span class="badge badge-cancelada">cancelada</span></td>
                            <td>S/. 180.00</td>
                            <td>
                                <select class="estado-select">
                                    <option>Cancelada</option>
                                </select>
                                <button class="btn-edit">✎</button>
                                <button class="btn-delete">🗑</button>
                            </td>
                        </tr>
                        <tr>
                            <td>16</td>
                            <td>Pedro González</td>
                            <td>202</td>
                            <td>2025-09-25</td>
                            <td>2025-09-30</td>
                            <td><span class="badge badge-pendiente">pendiente</span></td>
                            <td>S/. 800.00</td>
                            <td>
                                <select class="estado-select">
                                    <option>Pendiente</option>
                                </select>
                                <button class="btn-edit">✎</button>
                                <button class="btn-delete">🗑</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>


    
    <!-- MODAL DE NUEVA RESERVA -->
    <div class="modal fade" id="modalNuevaReserva" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Nueva Reserva</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="usuario" class="form-label">Usuario</label>
                            <input type="text" class="form-control" id="usuario" placeholder="Ingrese el nombre de usuario" required>
                        </div>
                        <div class="mb-3">
                            <label for="habitacion" class="form-label">Habitación</label>
                            <input type="number" class="form-control" id="habitacion" placeholder="Número de habitación" required>
                        </div>
                        <div class="mb-3">
                            <label for="fechaInicio" class="form-label">Fecha de Inicio</label>
                            <input type="date" class="form-control" id="fechaInicio" required>
                        </div>
                        <div class="mb-3">
                            <label for="fechaFin" class="form-label">Fecha de Fin</label>
                            <input type="date" class="form-control" id="fechaFin" required>
                        </div>
                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <select class="form-select" id="estado" required>
                                <option value="">Seleccione un estado</option>
                                <option value="pendiente">Pendiente</option>
                                <option value="confirmada">Confirmada</option>
                                <option value="cancelada">Cancelada</option>
                                <option value="finalizada">Finalizada</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="monto" class="form-label">Monto</label>
                            <input type="number" class="form-control" id="monto" placeholder="S/. 0.00" step="0.01" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary-gradient">Guardar Reserva</button>
                </div>
            </div>
        </div>
    </div>