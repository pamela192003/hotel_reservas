<section>
  <h2 style="margin:0 0 8px;font-size:28px">Mis pagos</h2>
  <div class="card" style="padding:0">
    <div style="padding:14px 16px;border-bottom:1px solid #e5e7eb;display:flex;justify-content:space-between;align-items:center">
      <strong>Listado</strong>
      <a class="btn primary" href="<?= BASE_URL ?>pagos/crear">Nuevo</a>
    </div>
    <div style="padding:16px; overflow:auto">
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Reserva</th>
            <th>Fecha pago</th>
            <th>Monto</th>
            <th>Método</th>
            <th>Estado</th>
            <th>Transacción</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach($pagos as $p): ?>
          <tr>
            <td><?= $p['id_pago'] ?></td>
            <td>#<?= $p['id_reserva'] ?></td>
            <td><?= $p['fecha_pago'] ?></td>
            <td>S/. <?= number_format($p['monto'],2) ?></td>
            <td><?= ucfirst($p['metodo']) ?></td>
            <td><span class="badge <?= $p['estado'] ?>"><?= $p['estado'] ?></span></td>
            <td><?= $p['transaccion_id'] ?: '-' ?></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</section>
