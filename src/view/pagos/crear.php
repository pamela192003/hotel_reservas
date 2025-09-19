<section class="card">
  <h2>Nuevo Pago</h2>
  <p class="muted">Ingresa los datos del pago</p>
  <form method="post">
    <?= \Csrf::field() ?>
<div class="form-row two-cols">
      <div class="col">
        <label>ID Reserva</label>
        <input class="input" type="number" min="1" name="id_reserva" placeholder="Ej. 13" required>
      </div>

      <div class="col">
        <label>Monto</label>
        <input class="input" type="number" step="0.01" min="0" name="monto" placeholder="Ej. 150.00" required>
      </div>
    </div>

    <div class="form-row two-cols">
      <div class="col">
        <label>Fecha de pago</label>
        <input class="date" type="date" name="fecha_pago" required>
      </div>

      <div class="col">
        <label>Método de pago</label>
        <select class="input" name="metodo" required>
          <option value="">-- Selecciona --</option>
          <option value="tarjeta">Tarjeta</option>
          <option value="efectivo">Efectivo</option>
          <option value="transferencia">Transferencia</option>
        </select>
      </div>
    </div>

    <div class="form-row two-cols">
      <div class="col">
        <label>Estado</label>
        <select class="input" name="estado" required>
          <option value="pendiente">Pendiente</option>
          <option value="completado">Completado</option>
          <option value="fallido">Fallido</option>
        </select>
      </div>

      <div class="col">
        <label>ID Transacción</label>
        <input class="input" type="text" name="transaccion_id" placeholder="Ej. TXN12345">
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