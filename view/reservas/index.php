<section>
  <h2 style="margin:0 0 8px;font-size:28px">Mis reservas</h2>
  <div class="card" style="padding:0">
    <div style="padding:14px 16px;border-bottom:1px solid #e5e7eb;display:flex;justify-content:space-between;align-items:center">
      <strong>Listado</strong>
      <a class="btn primary" href="<?= BASE_URL ?>reservas/crear">Nueva</a>
    </div>
    <div style="padding:16px; overflow:auto">
      <table class="table">
        <thead><tr><th>#</th><th>Habitación</th><th>Hotel</th><th>Inicio</th><th>Fin</th><th>Estado</th><th>Monto</th></tr></thead>
        <tbody>
        <?php foreach($reservas as $r): ?>
          <tr>
            <td><?= $r['id_reserva'] ?></td>
            <td><?= $r['id_habitacion'] ?></td>
            <td><?= $r['id_hotel'] ?></td>
            <td><?= $r['fecha_inicio'] ?></td>
            <td><?= $r['fecha_fin'] ?></td>
            <td><span class="badge <?= $r['estado'] ?>"><?= $r['estado'] ?></span></td>
            <td>S/. <?= number_format($r['monto_total'],2) ?></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</section>