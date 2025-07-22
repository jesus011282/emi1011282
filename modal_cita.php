<div class="modal fade" id="modalCita" tabindex="-1" aria-labelledby="modalCitaLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="formCita">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCitaLabel">Actualizar Cita</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="cita_id">
          
          <div class="mb-3">
            <label for="cita_fecha" class="form-label">Fecha</label>
            <input type="date" class="form-control" name="fecha" id="cita_fecha" required>
          </div>

          <div class="mb-3">
            <label for="cita_hora" class="form-label">Hora</label>
            <select class="form-select" name="hora" id="cita_hora" required>
              <option value="">Seleccione una hora</option>
              <?php
              for ($i = 8; $i <= 24; $i++) {
                  $display = $i <= 12 ? $i . " AM" : ($i-12) . " PM";
                  echo "<option value=\"$i\">$display</option>";
              }
              ?>
            </select>
          </div>

          <div class="mb-3">
            <label for="cita_estado" class="form-label">Estado</label>
            <input type="text" class="form-control" name="estado" id="cita_estado" required>
          </div>

          <div class="mb-3">
            <label for="cita_id_paciente" class="form-label">ID Paciente</label>
            <input type="number" class="form-control" name="id_paciente" id="cita_id_paciente" required>
          </div>

          <div class="mb-3">
            <label for="cita_id_medico" class="form-label">ID Médico</label>
            <input type="number" class="form-control" name="id_medico" id="cita_id_medico" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Actualizar</button>
        </div>
      </form>
    </div>
  </div>
</div>
            <!--Se realiza la mejora del modal de citas -->