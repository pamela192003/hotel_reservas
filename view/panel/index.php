<section>
  <h2 style="margin:0 0 8px;font-size:28px">Dashboard</h2>
  <div class="kpis">
    <div class="kpi-card">
      <div class="kpi-title">Total reservas</div>
      <div class="kpi-value"><?= count($reservas) ?></div>
      <div class="kpi-foot">Todas las reservas</div>
    </div>
    <div class="kpi-card">
      <div class="kpi-title">Pendientes</div>
      <div class="kpi-value"><?= count(array_filter($reservas, fn($r)=>$r['estado']==='pendiente')) ?></div>
      <div class="kpi-foot">A la espera de pago/confirmación</div>
    </div>
    <div class="kpi-card">
      <div class="kpi-title">Confirmadas</div>
      <div class="kpi-value"><?= count(array_filter($reservas, fn($r)=>$r['estado']==='confirmada')) ?></div>
      <div class="kpi-foot">Pagadas y activas</div>
    </div>
    <div class="kpi-card">
      <div class="kpi-title">Canceladas</div>
      <div class="kpi-value"><?= count(array_filter($reservas, fn($r)=>$r['estado']==='cancelada')) ?></div>
      <div class="kpi-foot">No vigentes</div>
    </div>
  </div>

  <div class="card" style="padding:0">
    <div style="padding:14px 16px;border-bottom:1px solid #e5e7eb;display:flex;justify-content:space-between;align-items:center">
      <strong>Lista de Reservas</strong>
      <a class="btn primary" href="<?= BASE_URL ?>reservas/crear">Nueva</a>
    </div>
    <div style="padding:16px; overflow:auto">
      <table class="table">
        <thead><tr>
          <th>#</th>
          <?php if($user['rol']==='admin'): ?><th>Usuario</th><?php endif; ?>
          <th>Hab</th><th>Inicio</th><th>Fin</th><th>Estado</th><th>Monto</th><th>Acciones</th>
        </tr></thead>
        <tbody>
        <?php foreach($reservas as $r): ?>
          <tr>
            <td><?= $r['id_reserva'] ?></td>
            <?php if($user['rol']==='admin'): ?>
              <td><?= htmlspecialchars(($r['nombre'] ?? $user['nombre']).' '.($r['apellido'] ?? '')) ?></td>
            <?php endif; ?>
            <td><?= $r['id_habitacion'] ?></td>
            <td><?= $r['fecha_inicio'] ?></td>
            <td><?= $r['fecha_fin'] ?></td>
            <td><span class="badge <?= $r['estado'] ?>"><?= $r['estado'] ?></span></td>
            <td>S/. <?= number_format($r['monto_total'],2) ?></td>
            <td class="table-actions">
              <form method="post" action="<?= BASE_URL ?>reservas/cambiar_estado">
                <?= \Csrf::field() ?>
                <input type="hidden" name="id_reserva" value="<?= $r['id_reserva'] ?>">
                <select class="input" name="estado" onchange="this.form.submit()">
                  <?php foreach(['pendiente','confirmada','cancelada','finalizada'] as $e): ?>
                    <option value="<?= $e ?>" <?= $e===$r['estado']?'selected':'' ?>><?= ucfirst($e) ?></option>
                  <?php endforeach; ?>
                </select>
              </form>
              <form method="post" action="<?= BASE_URL ?>pagos/registrar">
                <?= \Csrf::field() ?>
                <input type="hidden" name="id_reserva" value="<?= $r['id_reserva'] ?>">
                <input type="hidden" name="monto" value="<?= $r['monto_total'] ?>">
                <input type="hidden" name="metodo" value="efectivo">
                <button class="btn icon pay" title="Marcar pagado">💳</button>
              </form>
              <form method="post" action="<?= BASE_URL ?>reservas/eliminar" onsubmit="return confirm('¿Eliminar?')">
                <?= \Csrf::field() ?>
                <input type="hidden" name="id_reserva" value="<?= $r['id_reserva'] ?>">
                <button class="btn icon delete" title="Eliminar">🗑️</button>

                
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</section>

<div class="card" style="padding:0">
  <div style="padding:14px 16px;border-bottom:1px solid #e5e7eb;display:flex;justify-content:space-between;align-items:center">
    <strong>Lista de Pagos</strong>
    <a class="btn primary" href="<?= BASE_URL ?>pagos/crear">Nueva</a>
  </div>
  <div style="padding:16px; overflow:auto">
    <table class="table">
      <thead>
        <tr>
          <th>#</th>
          <?php if($user['rol']==='admin'): ?><th>Usuario</th><?php endif; ?>
          <th>Reserva</th>
          <th>Fecha</th>
          <th>Monto</th>
          <th>Método</th>
          <th>Estado</th>
          <th>Transacción</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach($pagos as $p): ?>
        <tr>
          <td><?= $p['id_pago'] ?></td>

          <?php if($user['rol']==='admin'): ?>
            <td><?= htmlspecialchars(($p['nombre'] ?? '').' '.($p['apellido'] ?? '')) ?></td>
          <?php endif; ?>

          <td>#<?= $p['id_reserva'] ?></td>
          <td><?= $p['fecha_pago'] ?></td>
          <td>S/. <?= number_format($p['monto'],2) ?></td>
          <td><?= ucfirst($p['metodo']) ?></td>
          <td><span class="badge <?= $p['estado'] ?>"><?= $p['estado'] ?></span></td>
          <td><?= $p['transaccion_id'] ?: '-' ?></td>

          <td class="table-actions">
            <!-- Cambiar estado de pago -->
            <form method="post" action="<?= BASE_URL ?>pagos/cambiar_estado">
              <?= \Csrf::field() ?>
              <input type="hidden" name="id_pago" value="<?= $p['id_pago'] ?>">
              <select class="input" name="estado" onchange="this.form.submit()">
                <?php foreach(['pendiente','completado','fallido'] as $e): ?>
                  <option value="<?= $e ?>" <?= $e===$p['estado']?'selected':'' ?>><?= ucfirst($e) ?></option>
                <?php endforeach; ?>
              </select>
            </form>

          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
