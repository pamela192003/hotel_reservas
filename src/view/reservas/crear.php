<section class="card">
  <h2>Nueva reserva</h2>
  <p class="muted">Ingresa los datos de la reserva.</p>
  <form method="post">
    <?= \Csrf::field() ?>

<div class="form-row two-cols">
  <div class="col">
    <label>Hotel</label>
    <select class="input" name="hotel" required>
      <option value="">Seleccione un hotel</option>
      <?php foreach($hoteles as $h): ?>
        <option value="<?= htmlspecialchars($h['id']) ?>">
          <?= htmlspecialchars($h['nombre']) ?>
        </option>
      <?php endforeach; ?>
    </select>
  </div>
</div>


    <div class="form-row two-cols">
      <div class="col">
        <label>Habitación</label>
        <input class="input" type="number" min="1" name="id_habitacion" placeholder="Ej. 204" required>
      </div>

      <div class="col">
        <label>Monto total</label>
        <input class="input" type="number" step="0.01" min="0" name="monto_total" placeholder="Ej. 120.00" required>
      </div>
    </div>

    <div class="form-row two-cols">
      <div class="col">
        <label>Fecha inicio</label>
        <input class="date" type="date" name="fecha_inicio" required>
      </div>

      <div class="col">
        <label>Fecha fin</label>
        <input class="date" type="date" name="fecha_fin" required>
      </div>
    </div>

    <div class="form-row">
      <div class="col-12">
        <button class="btn primary">Guardar</button>
        <a class="btn" href="<?= BASE_URL ?>panel">Cancelar</a>
      </div>
    </div>
  </form>
</section>